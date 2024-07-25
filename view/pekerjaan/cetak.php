<?php
require_once '../../koneksi.php'; // Ensure this file includes your $conn

// Include PhpSpreadsheet
require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Dewan Komputer')
    ->setLastModifiedBy('Dewan Komputer')
    ->setTitle('Office 2007 XLSX Dewan Komputer')
    ->setSubject('Office 2007 XLSX Dewan Komputer')
    ->setDescription('Test document for Office 2007 XLSX Dewan Komputer.')
    ->setKeywords('office 2007 openxml php Dewan Komputer')
    ->setCategory('Test result file Dewan Komputer');

// Merge cells and set title
$spreadsheet->getActiveSheet()->mergeCells('A1:G1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Cara Ekspor Laporan/Data dari Database MySQL ke dalam Excel (.xlsx) dengan plugin PHPOffice pada PHP');

// Set header styles
$spreadsheet->getActiveSheet()->getStyle('A3:G3')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
$spreadsheet->getActiveSheet()->getStyle('A3:G3')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

// Set table headers
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A3', 'NO')
    ->setCellValue('B3', 'NAMA')
    ->setCellValue('C3', 'JENIS PEKERJAAN')
    ->setCellValue('D3', 'SEKTOR')
    ->setCellValue('E3', 'PENGHASILAN')
    ->setCellValue('F3', 'NIK')
    ->setCellValue('G3', 'STATUS PEKERJAAN');

// Fetch data from the database
$i = 4;
$no = 1;
$query = "SELECT * FROM pekerjaan ORDER BY nama ASC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $i, $no)
        ->setCellValue('B' . $i, $row['nama'])
        ->setCellValue('C' . $i, $row['jenis_pekerjaan'])
        ->setCellValue('D' . $i, $row['sektor'])
        ->setCellValue('E' . $i, $row['penghasilan'])
        ->setCellValue('F' . $i, $row['nik'])
        ->setCellValue('G' . $i, $row['status_pekerjaan']);
    $i++;
    $no++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Report Excel ' . date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client's web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report_Excel.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

// Write file to the output
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>
