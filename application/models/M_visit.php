<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_visit extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function dataVisitAll()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		}

		return $query;
	}

	public function TotalKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}

	public function TotalKunjunganProspek()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prospek');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prospek');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}

	public function TotalKunjunganPrognosa()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}

	public function TotalKunjunganClose()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('m_visit_status', 'Close Po');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('m_visit_status', 'Close Po');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}

	public function TambahKunjungan($m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long)
	{
		date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
		$now1 = date('Y-m-d', strtotime($m_visit_tgl));
		$ref_date = strtotime($now1);
		$week_of_year = date('W', $ref_date);
		$now = date('Y-m-d H:i:s');
		$this->db->trans_start();
		$data = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => ucwords($m_visit_agenda),
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Add'
		];
		$this->db->insert('m_visit', $data);
		$id_visit = $this->db->insert_id();

		$data2 = [
			'm_visit_id'           	 => $id_visit,
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => ucwords($m_visit_agenda),
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Add'
		];
		$this->db->insert('m_visit_history', $data2);
		$id_visit_history = $this->db->insert_id();

		$this->db->insert('m_visit_group', array(
			'history'   => $id_visit_history,
			'visit'  			=> $id_visit,
		));

		$result = array();
		foreach ($peserta_nama as $key => $val) {
			$result[] = array(
				'peserta_nama'  	=> $peserta_nama[$key],
				'peserta_jabatan' => $peserta_jabatan[$key],
				'peserta_phone'   => $peserta_phone[$key],
				'id_users'      	=> $this->session->userdata('id_user'),
				'id_visit'      	=> $id_visit,
				'id_visit_history' => $id_visit_history,
				'created_at'    	=> time(),
			);
		}
		$this->db->insert_batch('m_visit_peserta', $result);

		$this->db->where('m_visit_id', $id_visit);
		$dataid = [
			'm_visit_history_id' => $id_visit_history,
		];
		$this->db->update('m_visit', $dataid);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal!'));
		} else {
			helper_log("add", "Tambah Kunjungan Baru");
			return json_encode(array('success' => true, 'msg' => 'Input data berhasil!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_visit', array('m_visit_id' => $id));
		$this->db->delete('m_visit_history', array('m_visit_id' => $id));
		$this->db->delete('m_visit_peserta', array('id_visit' => $id));
		$this->db->delete('m_visit_group', array('visit' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Data Gagal!'));
		} else {
			helper_log("delete", "Hapus Kunjungan");
			return json_encode(array('success' => true, 'msg' => 'Hapus Data Berhasil!'));
		}
	}

	public function PreviewdataVisit($m_visit_history_id)
	{
		$this->db->where('m_visit_history_id', $m_visit_history_id);
		$this->db->where('YEAR(m_visit_tgl)', date('Y'));
		$this->db->from('m_visit_history as a');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function PreviewdataPeserta($m_visit_history_id)
	{
		$this->db->where('id_visit_history', $m_visit_history_id);
		return $this->db->get('m_visit_peserta');
	}

	public function PreviewdataUpdateVisit($m_visit_id)
	{
		$this->db->where('m_visit_history_id', $m_visit_id);
		$this->db->where('YEAR(m_visit_tgl)', date('Y'));
		$this->db->from('m_visit_history as a');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function PreviewdataUpdatePeserta($m_visit_history_id)
	{
		$this->db->where('id_visit_history', $m_visit_history_id);
		return $this->db->get('m_visit_peserta');
	}

	public function TambahPeserta($m_visit_id, $m_visit_history_id, $m_visit_user_id, $peserta_nama, $peserta_jabatan, $peserta_phone)
	{
		$this->db->trans_start();
		$this->db->insert('m_visit_peserta', array(
			'id_users'  			=> $m_visit_user_id,
			'peserta_nama'      	=> ucwords($peserta_nama),
			'peserta_jabatan'		=> $peserta_jabatan,
			'peserta_phone' 		=> $peserta_phone,
			'id_visit'   			=> $m_visit_id,
			'id_visit_history' 	=> $m_visit_history_id,
			'created_at' 			=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Peserta gagal!'));
		} else {
			helper_log("add", "Tambah Peserta Kunjungan");
			return json_encode(array('success' => true, 'msg' => 'Tambah Peserta Berhasil!'));
		}
	}

	public function DeletePeserta($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_visit_peserta', array('id_peserta' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Peserta Gagal!'));
		} else {
			helper_log("delete", "Hapus Peserta id : $id");
			return json_encode(array('success' => true, 'msg' => 'Hapus Peserta Berhasil!'));
		}
	}

	public function ViewPeserta($id)
	{
		$this->db->where('id_peserta', $id);
		$query  = $this->db->get('m_visit_peserta');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				'id_peserta'    	=> $row->id_peserta,
				'peserta_nama'    => $row->peserta_nama,
				'peserta_jabatan' => $row->peserta_jabatan,
				'peserta_phone'   => $row->peserta_phone,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function EditPeserta($id_peserta, $m_visit_id, $m_visit_history_id, $m_visit_user_id, $peserta_nama, $peserta_jabatan, $peserta_phone)
	{
		$this->db->trans_start();
		$this->db->where('id_peserta', $id_peserta);
		$this->db->update('m_visit_peserta', array(
			'id_users'  			=> $m_visit_user_id,
			'peserta_nama'      	=> ucwords($peserta_nama),
			'peserta_jabatan'		=> $peserta_jabatan,
			'peserta_phone' 		=> $peserta_phone,
			'id_visit'   			=> $m_visit_id,
			'id_visit_history' 	=> $m_visit_history_id,
			'updated_at' 			=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Peserta gagal!'));
		} else {
			helper_log("edit", "Edit Peserta");
			return json_encode(array('success' => true, 'msg' => 'Update Peserta Berhasil!'));
		}
	}

	public function EditKunjungan($visit, $history, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long)
	{
		$this->db->trans_start();
		$data = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => ucwords($m_visit_agenda),
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => $m_visit_koor_lat,
			'm_visit_koor_long'      => $m_visit_koor_long,
			'm_visit_date_updated'   => time(),
		];
		$this->db->where('m_visit_id', $visit);
		$this->db->update('m_visit', $data);

		$data2 = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => ucwords($m_visit_agenda),
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => $m_visit_koor_lat,
			'm_visit_koor_long'      => $m_visit_koor_long,
			'm_visit_date_updated'   => time(),
		];
		$this->db->where('m_visit_history_id', $history);
		$this->db->update('m_visit_history', $data2);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Edit Data Gagal!'));
		} else {
			helper_log("edit", "Edit Kunjungan");
			return json_encode(array('success' => true, 'msg' => 'Edit Data Berhasil!'));
		}
	}

	public function PreviewdataHistory($m_visit_id)
	{
		$this->db->where('m_visit_id', $m_visit_id);
		$this->db->where('YEAR(m_visit_tgl)', date('Y'));
		$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		return $this->db->get('m_visit_history');
	}

	public function ViewModalHistoryKunjungan($id)
	{
		$this->db->where('m_visit_history_id', $id);
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->join('m_visit_peserta', 'id_visit_history=m_visit_history_id', 'left');
		$query  = $this->db->get('m_visit_history');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         		=> true,
				'm_visit_history_id'    => $row->m_visit_history_id,
				'm_visit_agenda'    		=> $row->m_visit_agenda,
				'm_visit_tgl'    			=> date('d F Y', strtotime($row->m_visit_tgl)),
				'm_visit_jam_mulai' 		=> $row->m_visit_jam_mulai,
				'm_visit_jam_selesai'   => $row->m_visit_jam_selesai,
				'm_visit_instansi'   	=> $row->instansi_nama,
				'instansi_alamat'   		=> $row->instansi_alamat,
				'kab_nama'   				=> $row->kab_nama,
				'prov_nama'   				=> $row->prov_nama,
				'name_user'   				=> $row->name_user,
				'm_visit_note'   			=> $row->m_visit_note,
				'm_visit_anggaran_BUMN' => number_format($row->m_visit_anggaran_BUMN, 0, '.', '.'),
				'm_visit_prospek'   		=> number_format($row->m_visit_prospek, 0, '.', '.'),
				'm_visit_prognosa'   	=> number_format($row->m_visit_prognosa, 0, '.', '.'),
				'm_visit_po'   			=> number_format($row->m_visit_po, 0, '.', '.'),
				'm_visit_estimasi_order' => $row->m_visit_estimasi_order,
				'm_visit_estimasi_tahun' => $row->m_visit_estimasi_tahun,
				'm_visit_status'   		=> $row->m_visit_status,
				'm_visit_koor_lat'   	=> str_replace(",", ".", $row->m_visit_koor_lat),
				'm_visit_koor_long'   	=> str_replace(",", ".", $row->m_visit_koor_long),
				'id_peserta'   			=> $row->id_peserta,
				'peserta_nama'   			=> $row->peserta_nama,
				'peserta_jabatan'   		=> $row->peserta_jabatan,
				'peserta_phone'   		=> $row->peserta_phone,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function viewPesertaTable($id)
	{
		$this->db->where('id_visit_history', $id);
		$query  = $this->db->get('m_visit_peserta');


		$data = array();
		foreach ($query->result() as $row) {
			array_push($data, $row);
		}

		$result = array();
		$result['rows']  = $data;


		return json_encode($result);
	}

	public function UpdateKunjungan($id, $id_history, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long)
	{
		date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
		$now1 = date('Y-m-d', strtotime($m_visit_tgl));
		$ref_date = strtotime($now1);
		$week_of_year = date('W', $ref_date);
		$now = date('Y-m-d H:i:s');

		$this->db->trans_start();
		$data = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Update'
		];
		$this->db->where('m_visit_id', $id);
		$this->db->update('m_visit', $data);

		$data2 = [
			'm_visit_id'           	 => $id,
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Update'
		];

		$this->db->insert('m_visit_history', $data2);
		$id_visit_history = $this->db->insert_id();

		$this->db->insert('m_visit_group', array(
			'history'   => $id_visit_history,
			'visit'  	=> $id,
		));

		$this->db->where('m_visit_id', $id);
		$dataid = [
			'm_visit_history_id' => $id_visit_history,
		];

		$this->db->update('m_visit', $dataid);

		$result = array();
		foreach ($peserta_nama as $key => $val) {
			$result[] = array(
				'peserta_nama'  	=> $peserta_nama[$key],
				'peserta_jabatan' => $peserta_jabatan[$key],
				'peserta_phone'   => $peserta_phone[$key],
				'id_users'      	=> $this->session->userdata('id_user'),
				'id_visit'      	=> $id,
				'id_visit_history' => $id_visit_history,
				'created_at'    	=> time(),
			);
		}
		$this->db->insert_batch('m_visit_peserta', $result);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update data gagal!'));
		} else {
			helper_log("update", "Update Kunjungan");
			return json_encode(array('success' => true, 'msg' => 'Update data berhasil!'));
		}
	}
}