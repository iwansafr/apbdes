<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($admin_templates))
{
	$this->load->view('admin/templates/'.$admin_templates.'/logo');
}