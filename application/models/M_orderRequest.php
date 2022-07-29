<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_orderRequest extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function totalRequest()
	{
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		return $this->db->get('t_order_request')->num_rows();
	}

	public function totalNewRequest()
	{
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->where('t_req_status', 'Request');
		return $this->db->get('t_order_request')->num_rows();
	}

	public function totalRequestClose()
	{
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->where('t_req_status', 'Close PO');
		return $this->db->get('t_order_request')->num_rows();
	}


	public function DataTable()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(t_req_tgl)', date('Y'));
			$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
			$this->db->join('users', 'id_user=t_req_user', 'left');
			$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('t_req_id', 'desc');
			$query = $this->db->get('t_order_request');
		} else {
			$this->db->where('t_req_user', $this->session->userdata('id_user'));
			$this->db->where('YEAR(t_req_tgl)', date('Y'));
			$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
			$this->db->join('users', 'id_user=t_req_user', 'left');
			$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('t_req_id', 'desc');
			$query = $this->db->get('t_order_request');
		}
		return $query;
	}

	public function dataVisitAll()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		}

		return $query;
	}

	public function DataKunjunganrequest($id)
	{
		$this->db->where('m_visit_history_id', $id);
		$this->db->join('users', 'id_user=m_visit_user_id', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->order_by('m_visit_history_id', 'desc');
		$query = $this->db->get('m_visit_history');
		return $query->row_array();
	}

	public function DataOrganisasi()
	{
		return $this->db->get('m_organisasi');
	}

	public function DataKodeRequest()
	{
		$this->db->select('RIGHT(t_order_request.t_req_kode,4) as kodereq', FALSE);
		$this->db->order_by('t_req_kode', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_order_request');  //cek dulu apakah ada sudah ada kode di tabel.
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia
			$data = $query->row();
			$kode = intval($data->kodereq) + 1;
		} else {
			$kode = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('y');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodetampil = "REQ" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function TambahOrderRequest($t_req_kode, $t_req_visit, $t_req_history_visit, $t_req_perusahaan, $t_req_kategori, $t_req_konsumen, $t_req_phone, $t_req_alamat)
	{
		$this->db->trans_start();
		$this->db->insert('t_order_request', array(
			't_req_kode' 				=> $t_req_kode,
			't_req_kategori'     	=> ucwords($t_req_kategori),
			't_req_visit'     		=> $t_req_visit,
			't_req_history_visit' 	=> $t_req_history_visit,
			't_req_perusahaan'  		=> $t_req_perusahaan,
			't_req_user'  				=> $this->session->userdata('id_user'),
			't_req_tgl'     			=> date('Y-m-d'),
			't_req_konsumen'     	=> ucwords($t_req_konsumen),
			't_req_alamat'     		=> ucwords($t_req_alamat),
			't_req_phone'  			=> $t_req_phone,
			't_req_status'  			=> "Request",
			'created_at'     			=> time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Request Order gagal kirim!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Request Order Berhasil dikirim!'));
		}
	}

	public function getDataTableRequest($id)
	{
		$this->db->where('t_req_id', $id);
		$this->db->join('m_organisasi', 'org_id=t_req_perusahaan', 'left');
		$this->db->join('users', 'id_user=t_req_user', 'left');
		$this->db->join('m_visit', 'm_visit_id=t_req_visit', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->order_by('t_req_id', 'desc');
		return $this->db->get('t_order_request')->row_array();
	}

	public function EditOrderRequest($t_req_kode, $t_req_tgl, $t_req_user, $t_req_visit, $t_req_history_visit, $t_req_perusahaan, $t_req_kategori, $t_req_konsumen, $t_req_phone, $t_req_alamat)
	{
		$this->db->trans_start();
		$this->db->where('t_req_kode', $t_req_kode);
		$this->db->update('t_order_request', array(
			't_req_kategori'     	=> ucwords($t_req_kategori),
			't_req_visit'     		=> $t_req_visit,
			't_req_history_visit' 	=> $t_req_history_visit,
			't_req_perusahaan'  		=> $t_req_perusahaan,
			't_req_user'  				=> $t_req_user,
			't_req_tgl'     			=> $t_req_tgl,
			't_req_konsumen'     	=> ucwords($t_req_konsumen),
			't_req_alamat'     		=> ucwords($t_req_alamat),
			't_req_phone'  			=> $t_req_phone,
			't_req_status'  			=> "Request",
			'updated_at'     			=> time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Edit Request Order gagal kirim!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Edit Request Order Berhasil dikirim!'));
		}
	}

	public function DeleteRequest($id)
	{
		$this->db->trans_start();
		$this->db->delete('t_order_request', array('t_req_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Request Order Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Request Order Berhasil!'));
		}
	}
}
