<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterModel extends CI_Model {
	public function getCount($tables = ''){
		$table = getTable($tables);
		$where = active;
		$query = $this->db->query("select * from $table $where");
		return $query->num_rows();
	}

	public function getRows($limit = 0, $start = 0, $tables = ''){
		$table = getTable($tables);
		$where = active;
		$order = urut;
		$batas = ($limit == 0) ? "" : "limit $start, $limit";
		$query = $this->db->query("select * from $table $where $order $batas");
		return $query->result();
	}

	public function act($tables = '', $act = '', $id = 0){
		$table = getTable($tables);
		if($act === 'save'){
			$nama = addslashes(trim($nama = $this->input->post('nama')));
			$data = array('nama' => $nama);
			$this->db->insert($table, $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		elseif ($act === 'get') {
			$where = active;
			$query = $this->db->query("select * from $table $where and id = $id");
			$data = array( 'num' => $query->num_rows(), 'rows' => $query->row());
			return $data;
		}
		elseif($act === 'upd'){
			$idx  = addslashes(trim($nama = $this->input->post('id')));
			$nama = addslashes(trim($nama = $this->input->post('nama')));
			$data = array('nama' => $nama);
			$this->db->where('id', $idx);
			$this->db->update($table, $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		elseif($act === 'del'){
			$data = array('active' => 0);
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}
}
