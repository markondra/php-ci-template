<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paging {
	$config['base_url'] 		= site_url('master/unit');
    $config['total_rows'] 		= $this->masterModel->getCount('ms_unit');
    $config['per_page'] 		= 10;
    $config["uri_segment"] 		= 3;
    $choice 					= $config["total_rows"] / $config["per_page"];
    //$config["num_links"] 		= 5;

    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination pagination-sm no-margin">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li><span>';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="active"><span>';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li><span>';
    $config['next_tag_close']   = '</span></li>';
    $config['prev_tag_open']    = '<li><span>';
    $config['prev_tag_close']   = '</span></li>';
    $config['first_tag_open']   = '<li><span>';
    $config['first_tag_close']  = '</span></li>';
    $config['last_tag_open']    = '<li><span>';
    $config['last_tag_close']   = '</span></li>';

    $this->pagination->initialize($config);
    $data['page'] 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['rows'] 				= $this->masterModel->getRows($config["per_page"], $data['page'], 'ms_unit');           
    $data['pagination'] 		= $this->pagination->create_links();*
}