<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LandImportController extends BaseController
{
    public function index()
    {
        // Load your upload form view
        return view('dashboard/iport_land_details');
    }

    public function importExcel()
    {
        $file = $this->request->getFile('excel_file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid Excel file'
            ]);
        }

        try {
            // Load Excel
            $spreadsheet = IOFactory::load($file->getTempName());
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to read Excel file: ' . $e->getMessage()
            ]);
        }

        $rows = $spreadsheet->getActiveSheet()->toArray();

        $db = \Config\Database::connect();
        $builder = $db->table('land_records');

        $db->transBegin();

        $success = 0;
        $failed = [];

        foreach ($rows as $i => $row) {
            // Skip header row
            if ($i === 0) continue;

            try {
                // Mandatory checks
                if (empty($row[1]) || empty($row[3])) {
                    throw new \Exception("Khata No or LP Number missing");
                }

                // Duplicate check
                $exists = $builder
                    ->where('khata_no', trim($row[1]))
                    ->where('lp_number', trim($row[3]))
                    ->countAllResults();

                if ($exists > 0) {
                    throw new \Exception("Duplicate record");
                }

                // Prepare insert data
                $insertData = [
                    'serial_no'               => trim($row[0]),
                    'khata_no'                => trim($row[1]),
                    'pattadar_name'           => trim($row[2]), // Telugu supported
                    'lp_number'               => trim($row[3]),
                    'old_survey_no'           => trim($row[4]),
                    'ulpin'                   => trim($row[5]),
                    'land_nature'             => trim($row[6]),
                    'land_sub_nature'         => trim($row[7]),
                    'land_classification'     => trim($row[8]),
                    'land_sub_classification' => trim($row[9]),
                    'lp_extent'               => (float)$row[10],
                    'possession_type'         => trim($row[11]),
                    'contact_details'         => trim($row[12]),
                    'remarks'                 => trim($row[13]),
                ];

                $builder->insert($insertData);
                $success++;

            } catch (\Exception $e) {
                $failed[] = [
                    'row' => $i + 1,
                    'error' => $e->getMessage()
                ];
            }
        }

        // Commit or rollback
        if ($db->transStatus() === false) {
            $db->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Database error occurred'
            ]);
        }

        $db->transCommit();

        return $this->response->setJSON([
            'status' => 'success',
            'imported' => $success,
            'failed' => $failed
        ]);
    }

    public function landList()
    {
        $db = \Config\Database::connect();

        // 🔹 Get distinct Pattadar Names
        $pattadarList = $db->table('land_records')
            ->select('pattadar_name')
            ->distinct()
            ->orderBy('pattadar_name', 'ASC')
            ->get()
            ->getResultArray();

        // 🔹 Main query
        $builder = $db->table('land_records');

        $pattadar = $this->request->getPost('pattadar_name');
        $khata    = $this->request->getPost('khata_no');
        $survey   = $this->request->getPost('survey_no');

        if (!empty($pattadar)) {
            $builder->where('pattadar_name', $pattadar);
        }

        if (!empty($khata)) {
            $builder->like('khata_no', $khata);
        }

        if (!empty($survey)) {
            $builder->like('old_survey_no', $survey);
        }

        $data['records'] = $builder->orderBy('id', 'DESC')->get()->getResultArray();
        $data['pattadarList'] = $pattadarList;

        return view('dashboard/land_data_list', $data);
    }


    public function landListView()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('land_records');

        $data = $builder->orderBy('id', 'DESC')->get()->getResultArray();
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function createform()
    {
        return view('dashboard/add_land_data');
    }

public function saveLandData()
{
    $db = \Config\Database::connect();
    $builder = $db->table('land_records');

    // ===== Common fields (single) =====
    $khataNo      = trim($this->request->getPost('khata_no'));
    $pattadarName = trim($this->request->getPost('pattadar_name'));

    // ===== Multiple row fields =====
    $lpNumbers  = $this->request->getPost('lp_number');
    $surveyNos = $this->request->getPost('old_survey_no');
    $ulpins    = $this->request->getPost('ulpin');
    $extents   = $this->request->getPost('lp_extent');
    $taxAmounts = $this->request->getPost('tax_amount');

    // ===== Checkbox values =====
    $landNature        = implode(' / ', (array)$this->request->getPost('land_nature'));
    $subNature         = implode(' / ', (array)$this->request->getPost('land_sub_nature'));
    $classification    = implode(' / ', (array)$this->request->getPost('land_classification'));
    $subClassification = implode(' / ', (array)$this->request->getPost('land_sub_classification'));
    $possessionType    = implode(' / ', (array)$this->request->getPost('possession_type'));
    
    // ===== Other fields =====
    $contactDetails = trim($this->request->getPost('contact_details'));
    $remarks        = trim($this->request->getPost('remarks'));

    // ===== Mandatory validation =====
    if ($khataNo === '' || $pattadarName === '') {
        return redirect()->back()->with(
            'error',
            'ఖాతా నంబర్ మరియు పట్టాదారు పేరు తప్పనిసరి'
        );
    }

    foreach ($lpNumbers as $i => $lpNo) {

        $lpNo = trim($lpNo);
        if ($lpNo === '') {
            continue; // Skip empty rows
        }

        // ===== Duplicate check (Khata + LP) =====
        $exists = $builder
            ->where('khata_no', $khataNo)
            ->where('lp_number', $lpNo)
            ->countAllResults();

        if ($exists > 0) {
            return redirect()->back()->with(
                'error',
                "ఖాతా నం {$khataNo} కు LP నం {$lpNo} ఇప్పటికే నమోదు అయింది"
            );
        }

        // ===== Insert data (MATCHING YOUR DB COLUMNS) =====
        $insertData = [
            'serial_no'               => $i + 1,
            'khata_no'                => $khataNo,
            'pattadar_name'           => $pattadarName,
            'lp_number'               => $lpNo,
            'old_survey_no'           => trim($surveyNos[$i] ?? ''),
            'ulpin'                   => trim($ulpins[$i] ?? ''),
            'land_nature'             => $landNature,
            'land_sub_nature'         => '-/-',
            'land_classification'     => $subNature,
            'land_sub_classification' => $subClassification,
            'lp_extent'               => (float)($extents[$i] ?? 0),
            'possession_type'         => $possessionType,
            'contact_details'         => $contactDetails,
            'remarks'                 => $remarks,
            'tax_amount'              => (float)($taxAmounts[$i] ?? 0),
        ];

        $builder->insert($insertData);
    }

    return redirect()->to('land/list')
        ->with('success', 'భూమి వివరాలు విజయవంతంగా నమోదు చేయబడ్డాయి');
}


}
