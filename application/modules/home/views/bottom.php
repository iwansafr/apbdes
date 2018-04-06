<?php defined('BASEPATH') OR exit('No direct script access allowed');
$bottom_value  = $this->db->get_where('config', "name = 'header_bottom'", 1)->row_array();
$bottom_value  = json_decode($bottom_value['value'],1);
$contact_value = $this->db->get_where('config', "name = 'contact'", 1)->row_array();
$contact_value = json_decode($contact_value['value'],1);

if(!empty($bottom_value))
{
	$data['bottom_value'] = $bottom_value;
	$data['contact_value'] = @$contact_value;
	$this->load->view('home/'.$active_template.'/bottom', $data);
}