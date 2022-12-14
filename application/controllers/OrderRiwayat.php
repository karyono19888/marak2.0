<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderRiwayat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_orderRiwayat', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 					= 'Order Riwayat | Marak 2.0';
		$data['totalClose'] 				= $this->record->TotalClose();
		$data['totalClosebyAmmount'] 	= $this->record->TotalClosebyAmmount();
		$data['namaProduk'] 				= $this->record->DataNamaProduk();
		$this->load->view('OrderRiwayat/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] = $this->record->DataTable();
		$this->load->view('OrderRiwayat/v_table', $data);
	}

	public function ShowDataPreview()
	{
		$id 				= $this->input->post('id');
		$data['data'] 	= $this->record->DataTablePreview($id);
		$this->load->view('OrderRiwayat/v_preview', $data);
	}

	public function ShowTableProduk($kode)
	{
		$data['data'] 			= $this->record->DataTableProdukPreview($kode);
		$this->load->view('OrderRiwayat/v_tableProdukPreview', $data);
	}

	public function ShowTableEditProduk($kode)
	{
		$data['data'] 			= $this->record->DataTableProdukPreview($kode);
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderRiwayat/v_tableProdukPreviewEdit', $data);
	}

	public function ShowDataEdit()
	{
		$id 			= $this->input->post('id');
		$data['a'] 	= $this->record->DataTablePreviewEdit($id);
		$this->load->view('OrderRiwayat/v_editOrder', $data);
	}

	public function TambahProduk()
	{
		$t_produk_order_kode = $this->input->post('t_produk_order_kode');
		$t_produk_nama 		= $this->input->post('t_produk_nama');
		$t_produk_qty 			= $this->input->post('t_produk_qty');
		$t_produk_harga 		= $this->input->post('t_produk_harga');
		$t_produk_ongkir 		= $this->input->post('t_produk_ongkir');
		$t_produk_catatan 	= $this->input->post('t_produk_catatan');

		$tambahProdukBAru =  $this->record->TambahProduk($t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan);

		$data['data']  		= $tambahProdukBAru;
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderRiwayat/v_tableProdukPreviewEdit', $data);
	}

	public function EditProduk()
	{
		$t_produk_id 			= $this->input->post('t_produk_id');
		$t_produk_order_kode = $this->input->post('t_produk_order_kode');
		$t_produk_nama 		= $this->input->post('t_produk_nama');
		$t_produk_qty 			= $this->input->post('t_produk_qty');
		$t_produk_harga 		= $this->input->post('t_produk_harga');
		$t_produk_ongkir 		= $this->input->post('t_produk_ongkir');
		$t_produk_catatan 	= $this->input->post('t_produk_catatan');

		$tambahProdukBAru =  $this->record->EditProduk($t_produk_id, $t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan);

		$data['data']  		= $tambahProdukBAru;
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderRiwayat/v_tableProdukPreviewEdit', $data);
	}

	public function DeleteProduk()
	{
		$id 	= $this->input->post('id');
		$kode = $this->input->post('kode');
		$DeleteProduk = $this->record->DeleteProduk($id, $kode);

		$data['data']  		= $DeleteProduk;
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderRiwayat/v_tableProdukPreviewEdit', $data);
	}

	public function EditOrderComplete()
	{
		$t_order_kode 					= $this->input->post('t_order_kode');
		$t_order_paket_id 			= $this->input->post('t_order_paket_id');
		$t_order_perusahaan 			= $this->input->post('t_order_perusahaan');
		$t_order_kategori 			= $this->input->post('t_order_kategori');
		$t_order_visit_history_id 	= $this->input->post('t_order_visit_history_id');
		$t_order_visit_id 			= $this->input->post('t_order_visit_id');
		$t_order_tgl_req 				= $this->input->post('t_order_tgl_req');
		$t_order_tgl_order 			= $this->input->post('t_order_tgl_order');
		$t_order_tgl_kirim 			= $this->input->post('t_order_tgl_kirim');
		$t_order_subtotal 			= $this->input->post('t_order_subtotal');
		$t_order_ppn 					= $this->input->post('t_order_ppn');
		$t_order_pajak 				= $this->input->post('t_order_pajak');
		$t_order_grandtotal 			= $this->input->post('t_order_grandtotal');
		$t_order_user 					= $this->input->post('t_order_user');
		$t_req_kode 					= $this->input->post('t_req_kode');

		echo $this->record->EditOrderComplete($t_order_kode, $t_order_paket_id, $t_order_perusahaan, $t_order_kategori, $t_order_visit_history_id, $t_order_visit_id, $t_order_tgl_req, $t_order_tgl_order, $t_order_tgl_kirim, $t_order_subtotal, $t_order_ppn, $t_order_pajak, $t_order_grandtotal, $t_order_user, $t_req_kode);
	}

	public function ViewProduk()
	{
		$id = $this->input->post('id');
		echo $this->record->ViewProduk($id);
	}
}