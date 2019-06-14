<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('apiModel');
    }

	public function kab() {
		$key = $this->input->get('term');
		$data = $this->apiModel->kab($key);
		foreach ($data as $key => $value) {
			$result[] = array(
				'id'	=> $value->id,
				'value'		=> $value->nama_kabupaten." - ".$value->nama_propinsi,
				'label'		=> $value->nama_kabupaten." - ".$value->nama_propinsi
			);
		}
		echo json_encode($result);
	}

	public function pend() {
		$key = $this->input->get('term');
		$data = $this->apiModel->pend($key);
		foreach ($data as $key => $value) {
			$result[] = array(
				'id'	=> $value->pendidikan,
				'value'		=> $value->pendidikan,
				'label'		=> $value->pendidikan
			);
		}
		echo json_encode($result);
	}

	public function sek() {
		$key = $this->input->get('term');
		$data = $this->apiModel->sek($key);
		foreach ($data as $key => $value) {
			$result[] = array(
				'id'	=> $value->asal_sekolah,
				'value'		=> $value->asal_sekolah,
				'label'		=> $value->asal_sekolah
			);
		}
		echo json_encode($result);
	}

	public function umur(){
		$tgl = $this->input->post('tgl');
		//$birthday = $px->tgl_lahir;
		$birthday = new DateTime($tgl);
		$today = new DateTime("2018-06-30");
		$diff = $today->diff($birthday);
		$umur_thn = $diff->y;
		$umur_bln = $diff->m;
		$umur_tgl = $diff->d;
		$result = array(
			'umur_thn' => $umur_thn,
			'umur_bln' => $umur_bln,
			'umur_tgl' => $umur_tgl
		);
		echo json_encode($result);
	}
}
