<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApiModel extends CI_Model {

	public function kab($key){
		$this->db->like('nama_kabupaten',$key);
		return $this->db->get('m_kabupaten')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function pend($key){
		$this->db->select('pendidikan');
		$this->db->like('pendidikan',$key);
		return $this->db->get('m_pelamar')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function sek($key){
		$this->db->select('asal_sekolah');
		$this->db->like('asal_sekolah',$key);
		return $this->db->get('m_pelamar')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('pegawai', $data);
	}
}
