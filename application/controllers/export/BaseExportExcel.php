<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BaseExportExcel extends CI_Controller
{
    protected $spreadsheet;
    protected $sheet;
    protected $row = 1;

    public function __construct() {
        parent::__construct();

        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    protected function printExcel($filename = 'list')
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($this->spreadsheet);
        $writer->save('php://output');
    }

    protected function row($arr = null)
    {
        $alfa = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        if ($arr && !empty($arr)) {
            foreach ($arr as $k => $v) {
                $this->sheet->setCellValue($alfa[$k].$this->row, $v);
            }
        }
        else {
            $this->sheet->setCellValue($alfa[0].$this->row, '');
        }

        $this->row++;
    }

    protected function DateIndo($date) {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;

        return($result);
    }
}
