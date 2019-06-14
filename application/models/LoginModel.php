<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model{

	function auth($username,$password){
		$query = $this->db->query("select mu.id,mu.nama,mu.unit_id,mu.level,ifnull(mun.nama, 'no-data') unit 
								from m_user mu 
								left join m_unit mun on mun.id = mu.unit_id and mun.active = 1
								where mu.username = '$username' and mu.password = md5('$password') and mu.active = 1");
		$row = $query->num_rows();
		$data = $query->row();
		$result = array(
			'ishas' => $row,
			'data'  => $data
		);
		$result = array('isHas' => $row,'data' => $data);
		return $result;
	}

}