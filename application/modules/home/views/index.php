<?php defined('BASEPATH') OR exit('No direct script access allowed');

$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();
$slug        = $this->uri->segment(1);
$slug        = slug($slug);
$content     = ($mod['name'] == 'home' && $mod['task'] == 'index') ? 'home/content': $mod['name'].'/'.$mod['task'];
if(empty($mod['name']))
{
	$content = 'home/notfound';
}
if(!empty($slug)&&empty($mod['name']))
{
	$content = 'content/detail';
}

$data['content'] = $content;
$data['task']    = $mod['task'];
$data['module']  = $mod['name'];

$this->session->__set('link_js','');
$this->session->__set('js_extra','');

$this->db->select('value');
$active_template    = $this->esg->get_config('templates');
if(!empty($active_template))
{
	$active_template = $active_template['templates'];
	$config_name     = $active_template.'_widget';
	$config_template = $this->esg->get_config($config_name);
	if(!empty($config_template))
	{
		$data['config_template'] = $config_template;
		$data['active_template'] = $active_template;
		$this->load->view('home/home',$data);

	}else{
		echo '<h1>WebSite in Maintenance</h1>';
	}
}
