<?php defined('BASEPATH') OR exit('No direct script access allowed');
$header_value = $this->db->get_where('config',"name = 'header'")->row_array();
$header_value = json_decode($header_value['value'], 1);

$contact_value = $this->db->get_where('config', "name = 'contact'", 1)->row_array();
$contact_value = json_decode($contact_value['value'],1);

if(!empty($header_value))
{
	$data['header_value'] = $header_value;
	$data['contact_value'] = $contact_value;
	$this->load->view('home/'.$active_template.'/header', $data);
}
