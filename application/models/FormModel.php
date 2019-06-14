<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormModel extends CI_Model {

	public function akreditasi(){
		return $this->db->get('m_akreditasi')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function formasi(){
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->query("select mf.id,mf.kode,mf.nama,mf.jenis 
									from m_formasi mf inner join m_group mg on mg.formasi_id = mf.id
									where mg.user_id = $user_id");
		return $query->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('pegawai', $data);
	}

	public function save(){
		$formasi_id = $this->input->post('formasi_id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kabupaten_id = $this->input->post('kabupaten_id');
		$hp = $this->input->post('hp');
		$sex = $this->input->post('sex');
		$tempat = $this->input->post('tempat');
		$tanggal = $this->input->post('tanggal');
		$tingkat = $this->input->post('tingkat');
		$pendidikan = $this->input->post('pendidikan');
		$asal_sekolah = $this->input->post('asal_sekolah');
		$jenis_sekolah = $this->input->post('jenis_sekolah');
		$akreditasi_id = $this->input->post('akreditasi_id');
		$umur_thn = $this->input->post('umur_thn');
		$umur_bln = $this->input->post('umur_bln');
		$umur_tgl = $this->input->post('umur_tgl');
		$ktp = $this->input->post('ktp');
		$surat_lamaran = $this->input->post('surat_lamaran');
		$foto = $this->input->post('foto');
		$cv = $this->input->post('cv');
		$no_str = $this->input->post('no_str');
		$ijazah = $this->input->post('ijazah');
		$pendamping = $this->input->post('pendamping');
		$shift = $this->input->post('shift');
		$nilai = $this->input->post('nilai');
		$skor_nilai = $this->input->post('skor_nilai');
		$skor_area = $this->input->post('skor_area');
		$skor_sertifikat = $this->input->post('skor_sertifikat');
		$skor_pengalaman = $this->input->post('skor_pengalaman');
		$jumlah = $this->input->post('jumlah');
		$hasil = $this->input->post('hasil');
		/*
		if($formasi_id == 3 or $formasi_id == 4){
			$skor_sertifikat = $this->input->post('sertifikat_perawat');
		}
		else if($formasi_id == 5){
			$skor_sertifikat = $this->input->post('sertifikat_bidan');	
		}
		else{
			$skor_sertifikat = $this->input->post('sertifikat_bidan');
		}
		$choice = $this->input->post('choice');
		if($choice == 1){
			$skor_pengalaman = $this->input->post('pengalaman_kesehatan');
		}
		else{
			$skor_pengalaman = $this->input->post('pengalaman_non');
		}
		if($tingkat === 'S'){
			if($nilai > 8.5){
				$skor_nilai = 10;
			}
			else if($nilai >= 8.3 and $nilai <= 8.5){
				$skor_nilai = 5;
			}
			else if($nilai < 8.3){
				$skor_nilai = 2;
			}
			else{
				$skor_nilai = 0;
			}
		}
		else if($tingkat === 'P'){
			if($jenis_sekolah == 1){
				if($nilai > 3.25){
					$skor_nilai = 10;
				}
				else if($nilai >= 3 and $nilai <= 3.25){
					$skor_nilai = 5;	
				}
				else{
					$skor_nilai = 0;
				}
			}
			else if($jenis_sekolah == 2){
				if($nilai > 3){
					$skor_nilai = 10;
				}
				else if($nilai >= 2.75 and $nilai <= 3){
					$skor_nilai = 5;	
				}
				else{
					$skor_nilai = 0;
				}
			}
			else if($jenis_sekolah == 0){
				$skor_nilai = 0;
			}
		}
		*
		$jumlah = $skor_nilai + $skor_area + $skor_sertifikat + $skor_pengalaman;
		*/
		$data_pelamar = array(
			'formasi_id' => $formasi_id,
			'nama' => $nama,
			'alamat' => $alamat,
			'kabupaten_id' => $kabupaten_id,
			'hp' => $hp,
			'sex' => $sex,
			'tempat' => $tempat,
			'tanggal' => $tanggal,
			'tingkat' => $tingkat,
			'pendidikan' => $pendidikan,
			'asal_sekolah' => $asal_sekolah,
			'jenis_sekolah' => $jenis_sekolah,
			'akreditasi_id' => $akreditasi_id
		);
		$this->db->insert('m_pelamar', $data_pelamar);
		$last_id = $this->db->insert_id();
		if($last_id > 0){
			$data_adm = array(
				'pelamar_id' => $last_id,
				'umur_thn' => $umur_thn,
				'umur_bln' => $umur_bln,
				'umur_tgl' => $umur_tgl,
				'ktp' => $ktp,
				'surat_lamaran' => $surat_lamaran,
				'foto' => $foto,
				'cv' => $cv,
				'no_str' => $no_str,
				'ijazah' => $ijazah,
				'pendamping' => $pendamping,
				'shift' => $shift,
				'hasil' => $hasil
			);
			$this->db->insert('t_syarat_adm', $data_adm);
			$aff_adm = $this->db->affected_rows();
			if($aff_adm > 0){
				$data_skor = array(
					'pelamar_id' => $last_id,
					'nilai' => $nilai,
					'skor_nilai' => $skor_nilai,
					'skor_area' => $skor_area,
					'skor_sertifikat' => $skor_sertifikat,
					'skor_pengalaman' => $skor_pengalaman,
					'jumlah' => $jumlah
				);
				$this->db->insert('t_skorsing', $data_skor);
				$aff_skor = $this->db->affected_rows();
				if($aff_skor > 0){
					return 'good job';
				}
				else{
					return 'gagal insert skor';
				}
			}
			else{
				return 'gagal insert admn';
			}
		}
		else{
			return 'gagal insert pelamar';
		}
	}
}
