<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderMasuk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_orderMasuk', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 		= 'Order Masuk | Marak 2.0';
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['kode']  		= $this->record->DataKodePo();
		$this->load->view('OrderMasuk/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] 	= $this->record->DataTable();
		$this->load->view('OrderMasuk/v_table', $data);
	}

	public function ShowDataPreview()
	{
		$id = $this->input->post('id');
		$data['data'] 	= $this->record->DataTablePreview($id);
		$this->load->view('OrderMasuk/v_preview', $data);
	}

	public function ShowCompliteOrder()
	{
		$id = $this->input->post('id');
		$data['data'] 		= $this->record->DataTablePreview($id);
		$data['kode']  	= $this->record->DataKodePo();
		$this->load->view('OrderMasuk/v_completeOrder', $data);
	}

	public function ShowTableProduk($kode)
	{
		$data['data'] 			= $this->record->DataTableProduk($kode);
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['kode']  		= $this->record->DataKodePo();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderMasuk/v_tableProduk', $data);
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
		$data['kode']  		= $this->record->DataKodePo();
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderMasuk/v_tableProduk', $data);
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
		$data['kode']  		= $this->record->DataKodePo();
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderMasuk/v_tableProduk', $data);
	}

	public function ViewProduk()
	{
		$id = $this->input->post('id');
		echo $this->record->ViewProduk($id);
	}

	public function DeleteProduk()
	{
		$id 	= $this->input->post('id');
		$kode = $this->input->post('kode');
		$DeleteProduk = $this->record->DeleteProduk($id, $kode);

		$data['data']  		= $DeleteProduk;
		$data['kode']  		= $this->record->DataKodePo();
		$data['namaProduk'] 	= $this->record->DataNamaProduk();
		$data['pajak'] 	   = $this->record->DataPajak();
		$this->load->view('OrderMasuk/v_tableProduk', $data);
	}
}
