<?php

namespace App\Controllers;

// use App\Models\VisitorRequestModel;
// use App\Models\VisitorLogModel;
// use App\Models\SecurityGateLogModel;
// use App\Models\VisitorRequestHeaderModel;

use Dompdf\Dompdf;
use Dompdf\Options;
require_once APPPATH . 'ThirdParty/tcpdf/tcpdf.php';
use TCPDF;

class Dashboard extends BaseController
{
    // protected $visitorModel;
    // protected $logModel;
    // protected $SecurityGateLogModel;
    // protected $VisitorRequestHeaderModel;

    

    public function __construct()
    {
        // $this->visitorModel = new VisitorRequestModel();
        // $this->logModel     = new VisitorLogModel();
        // $this->SecurityGateLogModel     = new SecurityGateLogModel();
        // $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

   public function index()
{
    $db = \Config\Database::connect();

    // 🔹 Pattadar dropdown
    $pattadarList = $db->table('land_records')
        ->select('pattadar_name')
        ->distinct()
        ->orderBy('pattadar_name', 'ASC')
        ->get()
        ->getResultArray();

    $records = []; // IMPORTANT: default empty

    // 🔹 Check if search button submitted
    if ($this->request->getMethod() === 'post') {

        $pattadar = trim($this->request->getPost('pattadar_name'));
        $khata    = trim($this->request->getPost('khata_no'));

        // 🔹 Only query when at least one filter is filled
        if ($pattadar !== '' || $khata !== '') {

            $builder = $db->table('land_records');

            if ($pattadar !== '') {
                $builder->where('pattadar_name', $pattadar);
            }

            if ($khata !== '') {
                $builder->where('khata_no', $khata);
            }

            $records = $builder->orderBy('id')->get()->getResultArray();
        }
    }

    return view('dashboard/dashboard', [
        'records'      => $records,
        'pattadarList' => $pattadarList
    ]);
}

   

public function pattadarDetails()
{
    $db = \Config\Database::connect();

    // 🔹 Pattadar dropdown (distinct)
    $pattadarList = $db->table('land_records')
        ->select('pattadar_name')
        ->distinct()
        ->orderBy('pattadar_name', 'ASC')
        ->get()
        ->getResultArray();

    // 🔹 Filters
    $pattadar = $this->request->getPost('pattadar_name');
    $khata    = $this->request->getPost('khata_no');

    $builder = $db->table('land_records');

    if ($pattadar) {
        $builder->where('pattadar_name', $pattadar);
    }
    if ($khata) {
        $builder->where('khata_no', $khata);
    }

    $records = [];
    if ($pattadar || $khata) {
        $records = $builder->orderBy('id', 'DESC')->get()->getResultArray();
    }

    return view('dashboard/dashboard', [
        'pattadarList' => $pattadarList,
        'records'      => $records
    ]);
}



public function payUpdate()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request'
        ]);
    }

    $db = \Config\Database::connect();
    $session = session();

    $data = $this->request->getJSON(true);

    $id     = $data['id'] ?? null;
    $amount = $data['amount'] ?? null;

    if (!$id || !$amount) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Missing data'
        ]);
    }

    // Indian time
    $indiaTime = new \DateTime('now', new \DateTimeZone('Asia/Kolkata'));

    $updated = $db->table('land_records')
        ->where('id', $id)
        ->where('pay_status !=', 'Paid')
        ->update([
            'pay_amount' => $amount,
            'pay_status' => 'Paid',
            'payed_at'   => $indiaTime->format('Y-m-d H:i:s'),
            'payed_by'   => $session->get('user_id')
        ]);

    if ($updated) {
        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Already paid or failed'
    ]);
}


public function receipt($id)
{
     require_once APPPATH . 'ThirdParty/tcpdf/tcpdf.php';

    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('Land System');
    $pdf->SetAuthor('Government');
    $pdf->SetTitle('భూమి పన్ను రశీదు');

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();

    // Telugu supported font
    $pdf->SetFont('freeserif', '', 12, '', true);

    $html = <<<HTML
<h2 style="text-align:center;">భూమి పన్ను చెల్లింపు రశీదు</h2>

<table cellpadding="6" border="1">
<tr><td>ఖాతా నెం</td><td>7531</td></tr>
<tr><td>పట్టాదారు పేరు</td><td>Golla Philip / Golla Anjineyulu</td></tr>
<tr><td>సర్వే నెం</td><td>123-S</td></tr>
<tr><td>విస్తీర్ణం</td><td>0.20</td></tr>
<tr><td>చెల్లించిన మొత్తం</td><td>₹ 100.00</td></tr>
<tr><td>చెల్లించిన తేదీ</td><td>2025-12-24</td></tr>
</table>

<p style="text-align:center;">
ఇది కంప్యూటర్ ద్వారా తయారైన రశీదు. సంతకం అవసరం లేదు.
</p>
HTML;

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('receipt.pdf', 'I');
    exit;

    // $db = \Config\Database::connect();

    // $record = $db->table('land_records')
    //     ->where('id', $id)
    //     ->where('pay_status', 'Paid')
    //     ->get()
    //     ->getRowArray();

    // if (!$record) {
    //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Receipt not found');
    // }

    // // Load view
    // $html = view('dashboard/receipt_pdf', ['r' => $record]);

    // // Dompdf options
    // $options = new Options();
    // $options->set('defaultFont', 'DejaVu Sans');

    // $dompdf = new Dompdf($options);
    // $dompdf->loadHtml($html);
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();

    // // File name
    // $filename = 'Land_Tax_Receipt_'.$record['id'].'.pdf';

    // // Download
    // return $this->response
    //     ->setHeader('Content-Type', 'application/pdf')
    //     ->setHeader('Content-Disposition', 'attachment; filename="'.$filename.'"')
    //     ->setBody($dompdf->output());
}



}
