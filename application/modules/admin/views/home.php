<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($admin_templates))
{
	// $data['content']         = $content;
	// $data['task']            = $task;
	// $data['module']          = $module;
	// $data['admin_templates'] = $admin_templates;
	$this->load->view('admin/templates/'.$admin_templates.'/home');
}