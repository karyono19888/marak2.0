<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_laporanMarketing', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Laporan | Marak 2.0';
		$this->load->view('Laporan/v_index', $data);
	}

	public function ShowDataLaporanKunjungan()
	{
		$start = $this->input->post('date_start_laporan');
		$end 	 = $this->input->post('date_end_laporan');
		$data['title'] = 'Laporan Data Kunjungan <br> <small class="text-muted"><i>Periode Tanggal</i></small> <b>' . $start . '</b> <small class="text-muted"><i>s.d</i></small> <b>' . $end . '</b>';
		$data['data']  = $this->record->getDataShowKunjungan($start, $end);
		$data['start'] = $start;
		$data['end']  	= $end;
		$this->load->view('Laporan/v_showdatakunjungan', $data);
	}

	public function ShowDataSummaryOrder()
	{
		$start = $this->input->post('date_start_summary');
		$end 	 = $this->input->post('date_end_summary');

		$data['title'] = 'Summary Order <br> <small class="text-muted"><i>Periode Tanggal</i></small> <b>' . $start . '</b> <small class="text-muted"><i>s.d</i></small> <b>' . $end . '</b>';
		$data['data']  = $this->record->getDataShowSummaryOrder($start, $end);
		$data['start'] = $start;
		$data['end']  	= $end;
		$this->load->view('Laporan/v_showdatasummaryorder', $data);
	}

	public function DownloadDataLaporanKunjungan()
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
		$nama_user 	= $this->db->get_where('users', ['id_user' => $this->session->userdata('id_user')])->row_array();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Laporan Kunjungan Marketing');
		$sheet->setCellValue('A3', 'date_created : ' . $now . '');
		$sheet->setCellValue('A4', 'user 		  : ' . $nama_user['name_user'] . '');
		$sheet->setCellValue('A5', 'date 		  : ' . $start . ' s/d ' . $end . '');
		$sheet->setCellValue('A7', 'Satuan dalam milyar');
		$spreadsheet->getActiveSheet()
			->getStyle('A7')
			->getFont()
			->setItalic('A7')
			->setSize(8);

		$sheet->setCellValue('A8', 'No');
		$sheet->setCellValue('B8', 'Tanggal');
		$sheet->setCellValue('C8', 'Jam Mulai');
		$sheet->setCellValue('D8', 'Jam Selesai');
		$sheet->setCellValue('E8', 'Nama Instansi');
		$sheet->setCellValue('F8', 'Alamat');
		$sheet->setCellValue('G8', 'Agenda');
		$sheet->setCellValue('H8', 'Notulensi');
		$sheet->setCellValue('I8', 'APBN/D/P');
		$sheet->setCellValue('J8', 'Prospek');
		$sheet->setCellValue('K8', 'Prognosa');
		$sheet->setCellValue('L8', 'PO');
		$sheet->setCellValue('M8', 'Estimsi Order');
		$sheet->setCellValue('N8', 'Estimsi Tahun');
		$sheet->setCellValue('O8', 'Status');
		$sheet->setCellValue('P8', 'Jenis Kunjungan');

		$sheet->getStyle('A8')->applyFromArray($style_col);
		$sheet->getStyle('B8')->applyFromArray($style_col);
		$sheet->getStyle('C8')->applyFromArray($style_col);
		$sheet->getStyle('D8')->applyFromArray($style_col);
		$sheet->getStyle('E8')->applyFromArray($style_col);
		$sheet->getStyle('F8')->applyFromArray($style_col);
		$sheet->getStyle('G8')->applyFromArray($style_col);
		$sheet->getStyle('H8')->applyFromArray($style_col);
		$sheet->getStyle('I8')->applyFromArray($style_col);
		$sheet->getStyle('J8')->applyFromArray($style_col);
		$sheet->getStyle('K8')->applyFromArray($style_col);
		$sheet->getStyle('L8')->applyFromArray($style_col);
		$sheet->getStyle('M8')->applyFromArray($style_col);
		$sheet->getStyle('N8')->applyFromArray($style_col);
		$sheet->getStyle('O8')->applyFromArray($style_col);
		$sheet->getStyle('P8')->applyFromArray($style_col);

		$writer = new Xlsx($spreadsheet);
		$data = $this->record->getDownloadDataLaporanKunjunganMarketing($start, $end);
		$index = 9;
		$i = 1;
		foreach ($data as $a) :
			if ($a->m_visit_history === 'update') {
				$b = "Kunjungan Ulang";
			} else {
				$b = "Baru";
			}

			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $i++)
				->setCellValue('B' . $index, $a->m_visit_tgl)
				->setCellValue('C' . $index, $a->m_visit_jam_mulai)
				->setCellValue('D' . $index, $a->m_visit_jam_selesai)
				->setCellValue('E' . $index, $a->instansi_nama)
				->setCellValue('F' . $index, $a->instansi_alamat)
				->setCellValue('G' . $index, $a->m_visit_agenda)
				->setCellValue('H' . $index, $a->m_visit_note)
				->setCellValue('I' . $index, $a->m_visit_anggaran_BUMN)
				->setCellValue('J' . $index, $a->m_visit_prospek)
				->setCellValue('K' . $index, $a->m_visit_prognosa)
				->setCellValue('L' . $index, $a->m_visit_po)
				->setCellValue('M' . $index, $a->m_visit_estimasi_order)
				->setCellValue('N' . $index, $a->m_visit_estimasi_tahun)
				->setCellValue('O' . $index, $a->m_visit_status)
				->setCellValue('P' . $index, $b);

			$sheet->getStyle('A' . $index)->applyFromArray($style_row);
			$sheet->getStyle('B' . $index)->applyFromArray($style_row);
			$sheet->getStyle('C' . $index)->applyFromArray($style_row);
			$sheet->getStyle('D' . $index)->applyFromArray($style_row);
			$sheet->getStyle('E' . $index)->applyFromArray($style_row);
			$sheet->getStyle('F' . $index)->applyFromArray($style_row);
			$sheet->getStyle('G' . $index)->applyFromArray($style_row);
			$sheet->getStyle('H' . $index)->applyFromArray($style_row);
			$sheet->getStyle('I' . $index)->applyFromArray($style_row);
			$sheet->getStyle('J' . $index)->applyFromArray($style_row);
			$sheet->getStyle('K' . $index)->applyFromArray($style_row);
			$sheet->getStyle('L' . $index)->applyFromArray($style_row);
			$sheet->getStyle('M' . $index)->applyFromArray($style_row);
			$sheet->getStyle('N' . $index)->applyFromArray($style_row);
			$sheet->getStyle('O' . $index)->applyFromArray($style_row);
			$sheet->getStyle('P' . $index)->applyFromArray($style_row);

			$sheet->getStyle('G' . $index)->getAlignment()->setWrapText(true);
			$sheet->getStyle('H' . $index)->getAlignment()->setWrapText(true);
			$index++;
		endforeach;

		$spreadsheet->getActiveSheet()->setTitle('laporan_kunjungan_' . $nama_user['name_user'] . '' . date('dmY') . '');

		$filename = 'laporan_kunjungan_' . $nama_user['name_user'] . '' . date('dmY') . '';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
