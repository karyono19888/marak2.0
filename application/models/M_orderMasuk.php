<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_orderMasuk extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function TotalNewPo()
	{
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->where('t_req_status', 'Request');
		$query = $this->db->get('t_order_request');
		return $query->num_rows();
	}



	public function DataTable()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(t_req_tgl)', date('Y'));
			$this->db->where('t_req_status', 'Request');
			$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
			$this->db->join('users', 'id_user=t_req_user', 'left');
			$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('t_req_id', 'desc');
			$query = $this->db->get('t_order_request');
		} else {
			// $this->db->where('t_req_user', $this->session->userdata('id_user'));
			$this->db->where('YEAR(t_req_tgl)', date('Y'));
			$this->db->where('t_req_status', 'Request');
			$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
			$this->db->join('users', 'id_user=t_req_user', 'left');
			$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('t_req_id', 'desc');
			$query = $this->db->get('t_order_request');
		}
		return $query;
	}

	public function DataTablePreview($id)
	{
		$this->db->where('t_req_id', $id);
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
		$this->db->join('users', 'id_user=t_req_user', 'left');
		$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->order_by('t_req_id', 'desc');
		$query = $this->db->get('t_order_request');
		return $query->row_array();
	}

	public function DataKodePo()
	{
		$this->db->select('RIGHT(t_order_po.t_order_kode,4) as kodePo', FALSE);
		$this->db->order_by('t_order_kode', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_order_po');  //cek dulu apakah ada sudah ada kode di tabel.
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia
			$data = $query->row();
			$kode = intval($data->kodePo) + 1;
		} else {
			$kode = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('y');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodetampil = "PO" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function DataNamaProduk()
	{
		$this->db->order_by('m_prod_id', 'desc');
		return $this->db->get('m_product_pm');
	}

	public function DataTableProduk($kode)
	{
		$this->db->where('t_order_produk_kode', $kode);
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_order_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function TambahProduk($t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan)
	{
		$this->db->insert('t_order_produk', array( //update to insert
			't_order_produk_nama'       => $t_produk_nama,
			't_order_produk_qty'        => $t_produk_qty,
			't_order_produk_harga'      => str_replace(",", "", $t_produk_harga),
			't_order_produk_ongkir'     => str_replace(",", "", $t_produk_ongkir),
			't_produk_subtotal'   		 => $t_produk_qty * str_replace(",", "", $t_produk_harga) + str_replace(",", "", $t_produk_ongkir),
			't_order_produk_catatan'    => $t_produk_catatan,
			't_order_produk_kode' 		 => $t_produk_order_kode,
		));

		$this->db->where('t_order_produk_kode', $t_produk_order_kode);
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_order_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function EditProduk($t_produk_id, $t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan)
	{
		$this->db->where('t_order_produk_id', $t_produk_id);
		$this->db->update('t_order_produk', array( //update to insert
			't_order_produk_nama'       => $t_produk_nama,
			't_order_produk_qty'        => $t_produk_qty,
			't_order_produk_harga'      => str_replace(",", "", $t_produk_harga),
			't_order_produk_ongkir'     => str_replace(",", "", $t_produk_ongkir),
			't_produk_subtotal'   		 => $t_produk_qty * str_replace(",", "", $t_produk_harga) + str_replace(",", "", $t_produk_ongkir),
			't_order_produk_catatan'    => $t_produk_catatan,
			't_order_produk_kode' 		 => $t_produk_order_kode,
		));

		$this->db->where('t_order_produk_kode', $t_produk_order_kode);
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_order_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function ViewProduk($id)
	{
		$this->db->select('*');
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->where('t_order_produk_id', $id);
		$query  = $this->db->get('t_order_produk');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				't_order_produk_id' 				=> $row->t_order_produk_id,
				't_order_produk_kode' 			=> $row->t_order_produk_kode,
				't_order_produk_qty'       	=> $row->t_order_produk_qty,
				't_order_produk_harga'     	=> $row->t_order_produk_harga,
				't_order_produk_ongkir'    	=> $row->t_order_produk_ongkir,
				't_order_produk_catatan'   	=> $row->t_order_produk_catatan,
				'm_prod_id'       				=> $row->m_prod_id,
				'm_prod_kode'       				=> $row->m_prod_kode,
				'm_prod_nama'       				=> $row->m_prod_nama,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function DeleteProduk($id, $kode)
	{
		$this->db->trans_start();
		$this->db->delete('t_order_produk', array('t_order_produk_id' => $id));
		$this->db->trans_complete();

		$this->db->where('t_order_produk_kode', $kode);
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_order_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function DataPajak()
	{
		$this->db->order_by('m_pajak_id', 'desc');
		return $this->db->get('m_pajak');
	}

	public function TambahOrderComplete($t_order_kode, $t_order_paket_id, $t_order_perusahaan, $t_order_kategori, $t_order_visit_history_id, $t_order_visit_id, $t_order_tgl_req, $t_order_tgl_order, $t_order_tgl_kirim, $t_order_subtotal, $t_order_ppn, $t_order_pajak, $t_order_grandtotal, $t_order_user, $t_req_kode)
	{
		$this->db->trans_start();
		$getJumlahPOBefore = $this->db->get_where('m_visit', ['m_visit_id' => $t_order_visit_id])->row_array();
		if ($t_order_grandtotal < 1000000) {
			$konversi   = $t_order_grandtotal;
		} else {
			$konversi   = round($t_order_grandtotal / 1000000);
		}

		$totalPo    = $konversi + $getJumlahPOBefore['m_visit_po'];

		$this->db->insert('t_order_po', array(
			't_order_kode'  				=> $t_order_kode,
			't_order_kodeReq'  			=> $t_req_kode,
			't_order_id_pket'				=> $t_order_paket_id,
			't_order_prh' 					=> $t_order_perusahaan,
			't_order_kategori'   		=> $t_order_kategori,
			't_order_visit_history_id' => $t_order_visit_history_id,
			't_order_visit_id'      	=> $t_order_visit_id,
			't_order_tgl_req'      		=> $t_order_tgl_req,
			't_order_tgl'      			=> $t_order_tgl_order,
			't_order_tgl_kirim'      	=> $t_order_tgl_kirim,
			't_order_subtotal'      	=> $t_order_subtotal,
			't_order_ppn'      			=> $t_order_ppn,
			'm_pjk_id'      				=> $t_order_pajak,
			't_order_grandtotal'      	=> $t_order_grandtotal,
			't_order_user_id'      		=> $t_order_user,
			't_order_status' 				=> 'Close Po',
			'date_created' 				=> time()
		));



		$this->db->where('m_visit_id', $t_order_visit_id);
		$this->db->update('m_visit', array(
			'm_visit_order_id'  	=> $t_order_kode,
			'm_visit_po'  			=> $totalPo,
			'm_visit_status'  	=> 'Close Po',
		));

		$this->db->where('m_visit_history_id', $t_order_visit_history_id);
		$this->db->update('m_visit_history', array(
			'm_visit_order_id'  	=> $t_order_kode,
			'm_visit_po'  			=> $totalPo,
			'm_visit_status'  	=> 'Close Po',
		));

		$this->db->where('t_req_kode', $t_req_kode);
		$this->db->update('t_order_request', array(
			't_req_status'  		=> 'Close Po',
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Close Order gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Close Order Berhasil!'));
		}
	}
}
