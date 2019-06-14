<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
        if(!$this->session->userdata('logged_In')){
            redirect('admin', 'refresh');
        }
        $this->load->model('masterModel');
        $this->load->library('pagination');
        $this->load->helper(array('app'));
    }

	public function index() {
		redirect('admin', 'refresh');
	}

	public function list($tables = ''){
        $data['rows'] = $this->masterModel->getRows(0, 0, $tables);
		$this->load->view('master/'.$tables, $data);
	}

	public function act($tables = '', $act = '', $id = 0){
		if($act === 'save'){
			$query = $this->masterModel->act($tables, $act);
			if($query){
				$result = array('result' => 1, 'alert' => 'Proses Simpan Berhasil!');
			}
			else{
				$result = array('result' => 0, 'alert' => 'Proses Simpan Gagal!');
			}
		}
		elseif ($act === 'get') {
			$query = $this->masterModel->act($tables, $act, $id);
			if($query['num'] == 1){
				$result = array('result' => 1, 'alert' => 'Data ditemukan!', 'nama' => $query['rows']->nama);
			}
			elseif ($query['num'] == 0) {
				$result = array('result' => 0, 'alert' => 'Data tidak ditemukan!', 'nama' => '');
			}
			else{
				$result = array('result' => 0, 'alert' => 'Data Error!', 'nama' => '');
			}
		}
		elseif($act === 'upd'){
			$query = $this->masterModel->act($tables, $act);
			if($query){
				$result = array('result' => 1, 'alert' => 'Proses Simpan Berhasil!');
			}
			else{
				$result = array('result' => 0, 'alert' => 'Proses Simpan Gagal!');
			}
		}
		elseif($act === 'del'){
			$query = $this->masterModel->act($tables, $act, $id);
			if($query){
				$result = array('result' => 1, 'alert' => 'Proses Hapus Berhasil!');
			}
			else{
				$result = array('result' => 0, 'alert' => 'Proses Hapus Gagal!');
			}
		}
		echo json_encode($result);
	}

	public function load($table = ''){
		$rows = $this->masterModel->getRows(0, 0, $table);
		$no = 1;
        foreach ($rows as $key => $value) {
          ?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $value->nama;?></td>
				<td>
              		<button type="button" onclick="edit(<?php echo $value->id;?>);" class="btn btn-sm bg-teal-active">
                        <i class="fa fa-pencil-square-o"></i> Edit</button> 
                	<button type="button" onclick="hapus(<?php echo $value->id;?>);" class="btn btn-sm bg-red-active">
                        <i class="fa fa-trash-o"></i> Hapus</button>
            	</td>
			</tr>
        <?php
        }
	}
}
