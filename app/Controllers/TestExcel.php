<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TestExcel extends Controller
{
    public function index()
    {
        return view('welcome_message');
    }

    public function loadExcel()
    {
       $file = 'C:/Users/mahes/OneDrive/Desktop/BoomiData1.xlsx';

if (!file_exists($file)) {
    return 'File not found';
}

$spreadsheet = IOFactory::load($file);
$rows = $spreadsheet->getActiveSheet()->toArray();

echo '<pre>';
print_r($rows);
echo '</pre>';

    }
}
