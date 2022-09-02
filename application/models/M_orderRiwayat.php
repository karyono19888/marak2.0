<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_orderRiwayat extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function DataTable()
	{
		$this->db->where('YEAR(t_order_tgl)', date('Y'));
		$this->db->where('t_order_status', 'Close PO');
		$this->db->join('m_organisasi', 'org_id=t_order_prh', 'left');
		$this->db->join('users', 'id_user=t_order_agent', 'left');
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('t_order_request', 't_req_kode=t_order_kodeReq', 'left');
		$this->db->order_by('t_order_id', 'desc');
		$query = $this->db->get('t_order_po');
		return $query;
	}

	public function DataTablePreview($id)
	{
		$this->db->where('t_order_kode', $id);
		$this->db->join('m_organisasi', 'org_id=t_order_prh', 'left');
		$this->db->join('users', 'id_user=t_order_agent', 'left');
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('t_order_request', 't_req_kode=t_order_kodeReq', 'left');
		$this->db->order_by('t_order_id', 'desc');
		$query = $this->db->get('t_order_po');
		return $query->row_array();
	}

	public function DataTableProdukPreview($kode)
	{
		$this->db->where('t_order_produk_kode', $kode);
		$this->db->join('t_order_po', 't_order_kode=t_order_produk_kode', 'left');
		$this->db->join('m_pajak', 'm_pajak_id=m_pjk_id', 'left');
		$this->db->join('m_product_pm', 'm_prod_id=t_order_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_order_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function DataNamaProduk()
	{
		$this->db->order_by('m_prod_id', 'desc');
		return $this->db->get('m_product_pm');
	}

	public function DataPajak()
	{
		$this->db->order_by('m_pajak_id', 'desc');
		return $this->db->get('m_pajak');
	}

	public function TambahProduk($t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan)
	{
		$this->db->insert('t_order_produk', array( //update to insert
			't_produk_nama'       => $t_produk_nama,
			't_produk_qty'        => $t_produk_qty,
			't_produk_harga'      => str_replace(",", "", $t_produk_harga),
			't_produk_ongkir'     => str_replace(",", "", $t_produk_ongkir),
			't_produk_subtotal'   => $t_produk_qty * str_replace(",", "", $t_produk_harga) + str_replace(",", "", $t_produk_ongkir),
			't_produk_catatan'    => $t_produk_catatan,
			't_produk_order_kode' => $t_produk_order_kode,
		));

		$this->db->where('t_produk_order_kode', $t_produk_order_kode);
		$this->db->join('t_order_po', 't_order_kode=t_produk_order_kode', 'left');
		$this->db->join('m_pajak', 'm_pajak_id=t_order_pajak', 'left');
		$this->db->join('m_product_pm', 'm_prod_id=t_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function EditProduk($t_produk_id, $t_produk_order_kode, $t_produk_nama, $t_produk_qty, $t_produk_harga, $t_produk_ongkir, $t_produk_catatan)
	{
		$this->db->where('t_produk_id', $t_produk_id);
		$this->db->update('t_order_produk', array( //update to insert
			't_produk_nama'       => $t_produk_nama,
			't_produk_qty'        => $t_produk_qty,
			't_produk_harga'      => str_replace(",", "", $t_produk_harga),
			't_produk_ongkir'     => str_replace(",", "", $t_produk_ongkir),
			't_produk_subtotal'   => $t_produk_qty * str_replace(",", "", $t_produk_harga) + str_replace(",", "", $t_produk_ongkir),
			't_produk_catatan'    => $t_produk_catatan,
			't_produk_order_kode' => $t_produk_order_kode,
		));

		$this->db->where('t_produk_order_kode', $t_produk_order_kode);
		$this->db->join('t_order_po', 't_order_kode=t_produk_order_kode', 'left');
		$this->db->join('m_pajak', 'm_pajak_id=t_order_pajak', 'left');
		$this->db->join('m_product_pm', 'm_prod_id=t_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function DeleteProduk($id, $kode)
	{
		$this->db->trans_start();
		$this->db->delete('t_order_produk', array('t_produk_id' => $id));
		$this->db->trans_complete();

		$this->db->where('t_produk_order_kode', $kode);
		$this->db->join('t_order_po', 't_order_kode=t_produk_order_kode', 'left');
		$this->db->join('m_pajak', 'm_pajak_id=t_order_pajak', 'left');
		$this->db->join('m_product_pm', 'm_prod_id=t_produk_nama', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('t_produk_id', 'desc');
		return $this->db->get('t_order_produk');
	}

	public function EditOrderComplete($t_order_kode, $t_order_paket_id, $t_order_perusahaan, $t_order_kategori, $t_order_visit_history_id, $t_order_visit_id, $t_order_tgl_req, $t_order_tgl_order, $t_order_tgl_kirim, $t_order_subtotal, $t_order_ppn, $t_order_pajak, $t_order_grandtotal, $t_order_user, $t_req_kode)
	{
		$this->db->trans_start();
		if ($t_order_grandtotal < 1000000) {
			$konversi   = $t_order_grandtotal;
		} else {
			$konversi   = round($t_order_grandtotal / 1000000);
		}

		$totalPo    = $konversi;

		$this->db->where('t_order_kode', $t_order_kode);
		$this->db->update('t_order_po', array(
			't_order_kode'  				=> $t_order_kode,
			't_order_kodeReq'  			=> $t_req_kode,
			't_order_paket_id'			=> $t_order_paket_id,
			't_order_perusahaan' 		=> $t_order_perusahaan,
			't_order_kategori'   		=> $t_order_kategori,
			't_order_visit_history_id' => $t_order_visit_history_id,
			't_order_visit_id'      	=> $t_order_visit_id,
			't_order_tgl_req'      		=> $t_order_tgl_req,
			't_order_tgl_order'      	=> $t_order_tgl_order,
			't_order_tgl_kirim'      	=> $t_order_tgl_kirim,
			't_order_subtotal'      	=> $t_order_subtotal,
			't_order_ppn'      			=> $t_order_ppn,
			't_order_pajak'      		=> $t_order_pajak,
			't_order_grandtotal'      	=> $t_order_grandtotal,
			't_order_user'      			=> $t_order_user,
			't_order_status' 				=> 'Close Po',
			'created_at' 					=> time()
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
			return json_encode(array('success' => false, 'msg' => 'Edit Close Order gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Edit Close Order Berhasil!'));
		}
	}
}
