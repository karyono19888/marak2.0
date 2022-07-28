<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_product extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function totalProduct()
	{
		$query = $this->db->get('m_product_pm');
		return $query->num_rows();
	}

	public function totalProductEcataloge()
	{
		$this->db->where('m_prod_category', 'E-catalog');
		$query = $this->db->get('m_product_pm');
		return $query->num_rows();
	}

	public function totalProductNon()
	{
		$this->db->where('m_prod_category', 'Non E-catalog');
		$query = $this->db->get('m_product_pm');
		return $query->num_rows();
	}

	public function DataTable()
	{
		$this->db->join('m_tipe', 'm_tipe_id=m_prod_type', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('m_prod_id', 'desc');
		return $this->db->get('m_product_pm');
	}

	public function GetUom($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('m_uom_status', "Aktif");
		$this->db->where("m_uom_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('m_uom_id', 'asc');
		$fetched_records = $this->db->get('m_uom');
		$datauom = $fetched_records->result_array();
		$data = array();
		foreach ($datauom as $uom) {
			$data[] = array(
				"id"   => $uom['m_uom_id'],
				"text" => $uom['m_uom_nama']
			);
		}
		return $data;
	}

	public function GetTipe($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('m_tipe_status', "Aktif");
		$this->db->where("m_tipe_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('m_tipe_id', 'asc');
		$fetched_records = $this->db->get('m_tipe');
		$datatipe = $fetched_records->result_array();
		$data = array();
		foreach ($datatipe as $tipe) {
			$data[] = array(
				"id"   => $tipe['m_tipe_id'],
				"text" => $tipe['m_tipe_nama']
			);
		}
		return $data;
	}

	public function TambahProduk($m_prod_category, $m_prod_kode, $m_prod_nama, $m_prod_type, $m_prod_uom, $m_prod_status, $m_prod_ket)
	{
		$nama = $this->db->get_where('m_product_pm', ['m_prod_nama' => $m_prod_nama])->num_rows();
		$kode = $this->db->get_where('m_product_pm', ['m_prod_kode' => $m_prod_kode])->num_rows();
		if ($nama > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Produk Gagal, Nama Produk sudah ada!'));
		} else if ($kode > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Produk Gagal, Kode Produk sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('m_product_pm', array(
				'm_prod_category' => $m_prod_category,
				'm_prod_kode'     => strtoupper($m_prod_kode),
				'm_prod_nama'     => ucwords($m_prod_nama),
				'm_prod_type'     => $m_prod_type,
				'm_prod_uom'  		=> $m_prod_uom,
				'm_prod_status'  	=> $m_prod_status,
				'm_prod_ket'     	=> $m_prod_ket,
				'created_at'     	=> time(),
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Produk gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Produk Baru Berhasil!'));
			}
		}
	}

	public function ShowDataEdit($id)
	{
		$this->db->where('m_prod_id', $id);
		$this->db->join('m_tipe', 'm_tipe_id=m_prod_type', 'left');
		$this->db->join('m_uom', 'm_uom_id=m_prod_uom', 'left');
		$this->db->order_by('m_prod_id', 'desc');
		return $this->db->get('m_product_pm')->row_array();
	}

	public function EditProduk($m_prod_id, $m_prod_category, $m_prod_kode, $m_prod_nama, $m_prod_type, $m_prod_uom, $m_prod_status, $m_prod_ket)
	{
		$this->db->trans_start();
		$this->db->where('m_prod_id', $m_prod_id);
		$this->db->update('m_product_pm', array(
			'm_prod_category' => $m_prod_category,
			'm_prod_kode'     => strtoupper($m_prod_kode),
			'm_prod_nama'     => ucwords($m_prod_nama),
			'm_prod_type'     => $m_prod_type,
			'm_prod_uom'  		=> $m_prod_uom,
			'm_prod_status'  	=> $m_prod_status,
			'm_prod_ket'     	=> $m_prod_ket,
			'updated'     		=> time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Edit Produk gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Edit Produk Berhasil !'));
		}
	}

	public function ProductDelete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_product_pm', array('m_prod_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Produk Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Produk Berhasil!'));
		}
	}
}
