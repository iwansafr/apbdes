<?php defined('BASEPATH') OR exit('No direct script access allowed');

$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();

$content = ($mod['name'] == 'home' && $mod['task'] == 'index') ? 'home/content': $mod['name'].'/'.$mod['task'];
if(empty($mod['name']))
{
	$content = 'home/notfound';
}
$data['content'] = $content;
$data['task']    = $mod['task'];
$data['module']  = $mod['name'];

$this->session->__set('link_js','');

if($content == 'home/content')
{
	$data['header']        = $header;
	$data['header_bottom'] = $header_bottom;
	$data['logo']          = $logo;
	$data['site']          = $site;
	$data['contact']       = $contact;
}
$this->load->view('home/home',$data);