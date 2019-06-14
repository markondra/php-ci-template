<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SkorModel extends CI_Model {

	public function formasi($filter = 0){
		$where = "";
		if($filter <> 0){
			$where = "and mf.id = $filter";
		}
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->query("select mf.id,mf.kode,mf.nama,mf.jenis 
									from m_formasi mf inner join m_group mg on mg.formasi_id = mf.id
									where mg.user_id = $user_id $where ");
		return $query->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function view($filter = 0){
		$user_id = $this->session->userdata('user_id');
		$where = "";
		if($filter <> 0){
			$where = "and mf.id = $filter";
		}

		$query = $this->db->query("select mp.id pelId,mp.nama pelNama,mp.alamat pelAlamat,mp.hp pelHp,mp.sex pelSex,mp.tempat pelTempat,
									mp.tanggal pelTanggal,mp.tingkat pelTingkat,mp.pendidikan pelPend,mp.asal_sekolah pelAsal,
									mp.jenis_sekolah pelJenis,mp.akreditasi_id akreditasiId,ma.nama akreditasiNama,mp.formasi_id formasiId,
									mf.kode formasiKode,mf.nama formasiNama,mp.kabupaten_id kabId,mk.nama_kabupaten kabNama,adm.id admId,
									concat(adm.umur_thn,' th ',adm.umur_bln,' bl ',adm.umur_tgl,' hr') pelUmur,
									if(adm.surat_lamaran='Y','ADA','TDK') lamaran,if(adm.foto='Y','ADA','TDK') foto,
									if(adm.cv='Y','ADA','TDK') riwayat,if(adm.ijazah='Y','ADA','TDK') ijazah,
									if(adm.pendamping='Y','ADA','TDK') pendamping,adm.no_str noStr,adm.hasil admHasil,skor.id skorId,
									skor.nilai pelNilai,skor.skor_nilai skorNilai,skor.skor_area skorTinggal,skor.skor_sertifikat skorSertifikat,
									skor.skor_pengalaman skorPengalaman,skor.jumlah skorJumlah
									from m_pelamar mp
									inner join m_akreditasi ma on ma.id = mp.akreditasi_id
									inner join m_kabupaten mk on mk.id = mp.kabupaten_id
									inner join m_formasi mf on mf.id = mp.formasi_id
									inner join t_syarat_adm adm on adm.pelamar_id = mp.id
									inner join t_skorsing skor on skor.pelamar_id = mp.id
									inner join m_group mg on mg.formasi_id = mf.id
									where mg.user_id = $user_id
									$where
									order by adm.hasil desc,skor.jumlah desc,skor.nilai desc,skor.skor_pengalaman desc,skor.skor_sertifikat desc,mf.nama asc,mp.nama asc");
		return $query->result();
	}

}
