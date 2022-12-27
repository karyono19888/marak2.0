<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
class OrderLaporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_orderLaporan', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Laporan | Marak 2.0';
		$this->load->view('OrderLaporan/v_index', $data);
	}

	public function UserMarketing()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->UserMarketing($searchTerm);
		echo json_encode($response);
	}

	public function ShowDataSummaryOrder()
	{
		$start = $this->input->post('date_start_summary');
		$end 	 = $this->input->post('date_end_summary');
		$user  = $this->input->post('user_marketing');

		$nama_marketing = $this->db->get_where('users', ['id_user' => $user])->row_array();
		if ($user == "") {
			$judul = 'Summary Order <br> <small class="text-muted"><i>Periode Tanggal</i></small> <b>' . $start . '</b> <small class="text-muted"><i>s.d</i></small> <b>' . $end . '</b>';
			$db = $this->record->getDataShowSummaryOrderTanggal($start, $end);
		} else {
			$judul = 'Summary Order <br> <small class="text-muted"><i>Periode Tanggal</i></small> <b>' . $start . '</b> <small class="text-muted"><i>s.d</i></small> <b>' . $end . '</b> <small class="text-muted"><i>Marketing</i></small> <b>' . $nama_marketing['name_user'] . '</b>';
			$db = $this->record->getDataShowSummaryOrderMarketing($start, $end, $user);
		}

		$data['title'] = $judul;
		$data['data']  = $db;
		$data['start'] = $start;
		$data['end']  	= $end;
		$data['user']  = $user;
		$this->load->view('OrderLaporan/v_showdatasummaryorder', $data);
	}

	public function DownloadDataSummaryOrder()
	{
		date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
		$now = date('d F Y H:i:s');

		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
		];

		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			]
		];


		$start 		= $this->input->post('start');
		$end 	 		= $this->input->post('end');
		$user 	 	= $this->input->post('user');
		$nama_user 	= $this->db->get_where('users', ['id_user' => $user])->row_array();
		if ($user == "") {
			$nama = 'Data Semua Marketing';
			$fl = "All";
			$db	= $this->record->getDownloadDataLaporanOrderAllMarketing($start, $end);
		} else {
			$nama = $nama_user['name_user'];
			$fl = $nama_user['name_user'];
			$db	= $this->record->getDownloadDataLaporanOrderUserMarketing($start, $end, $user);
		}


		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Laporan Order Marketing');
		$sheet->setCellValue('A3', 'date_created : ' . $now . '');
		$sheet->setCellValue('A4', 'user 		  : ' . $nama . '');
		$sheet->setCellValue('A5', 'date 		  : ' . $start . ' s/d ' . $end . '');
		$sheet->setCellValue('A7', 'Satuan dalam milyar');
		$spreadsheet->getActiveSheet()
			->getStyle('A7')
			->getFont()
			->setItalic('A7')
			->setSize(8);

		$sheet->setCellValue('A8', 'No');
		$sheet->setCellValue('B8', 'User');
		$sheet->setCellValue('C8', 'Tanggal');
		$sheet->setCellValue('D8', 'Kategori');
		$sheet->setCellValue('E8', 'Instansi');
		$sheet->setCellValue('F8', 'Alamat');
		$sheet->setCellValue('G8', 'Total Purchase Order');
		$sheet->setCellValue('H8', 'Status');

		$sheet->getStyle('A8')->applyFromArray($style_col);
		$sheet->getStyle('B8')->applyFromArray($style_col);
		$sheet->getStyle('C8')->applyFromArray($style_col);
		$sheet->getStyle('D8')->applyFromArray($style_col);
		$sheet->getStyle('E8')->applyFromArray($style_col);
		$sheet->getStyle('F8')->applyFromArray($style_col);
		$sheet->getStyle('G8')->applyFromArray($style_col);
		$sheet->getStyle('H8')->applyFromArray($style_col);

		$writer = new Xlsx($spreadsheet);
		$data = $db;
		$index = 9;
		$i = 1;
		foreach ($data as $a) :

			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $i++)
				->setCellValue('B' . $index, $a->name_user)
				->setCellValue('C' . $index, $a->t_order_tgl)
				->setCellValue('D' . $index, $a->t_order_kategori)
				->setCellValue('E' . $index, $a->instansi_nama)
				->setCellValue('F' . $index, $a->instansi_alamat)
				->setCellValue('G' . $index, $a->t_order_grandtotal)
				->setCellValue('H' . $index, $a->t_order_status);

			$sheet->getStyle('A' . $index)->applyFromArray($style_row);
			$sheet->getStyle('B' . $index)->applyFromArray($style_row);
			$sheet->getStyle('C' . $index)->applyFromArray($style_row);
			$sheet->getStyle('D' . $index)->applyFromArray($style_row);
			$sheet->getStyle('E' . $index)->applyFromArray($style_row);
			$sheet->getStyle('F' . $index)->applyFromArray($style_row);
			$sheet->getStyle('G' . $index)->applyFromArray($style_row);
			$sheet->getStyle('H' . $index)->applyFromArray($style_row);
			$index++;
		endforeach;

		$spreadsheet->getActiveSheet()->setTitle('laporan_order_' . $fl . '_' . date('dmY') . '');

		$filename = 'laporan_order_' . $fl . '_' . date('dmY') . '';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}