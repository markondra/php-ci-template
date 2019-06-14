<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		
        if($this->session->userdata('logged_In')){
            redirect('admin', 'refresh');
        }
        $this->load->model('loginModel');
    }

	public function index(){
		$this->load->view('login');
	}
        
	public function login(){
		$username = addslashes($this->input->post('user'));
		$password = addslashes($this->input->post('pass'));
		$response = $this->loginModel->auth($username,$password);

		if($response['isHas'] >= 1){
			$session_array = array(
				'user_id' 		=> $response['data']->id,
				'user_nama' 	=> $response['data']->nama,
				'user_unit_id' 	=> $response['data']->unit_id,
				'user_unit' 	=> $response['data']->unit,
				'user_level' 	=> $response['data']->level,
				'logged_In' 	=> true
			);
			$this->session->set_userdata($session_array);
			$result = array('result' => 1, 'alert' => 'Login Berhasil!');
		}
		else{
			$result = array('result' => 0, 'alert' => 'Login Gagal!');
		}
		echo json_encode($result);
	}
    
}
