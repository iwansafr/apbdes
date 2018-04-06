<?php defined('BASEPATH') OR exit('No direct script access allowed');
$logo_value = $this->db->get_where('config',"name = 'logo'")->row_array();
$logo_value = json_decode($logo_value['value'], 1);

if(!empty($logo_value))
{
	$data['logo_value'] = $logo_value;
	$this->load->view('home/'.$active_template.'/logo', $data);
}