<?php defined('BASEPATH') OR exit('No direct script access allowed');
$esg             = new esg();
$logo_value      = $esg->get_config('logo');
$template_config = $esg->get_config($active_template.'_config');
if(!empty($template_config))
{
	$logo_value['title']  = !empty($template_config['logo_title']) ? $template_config['logo_title'] : $logo_value['title'];
	$logo_value['image']  = !empty($template_config['logo_image']) ? $template_config['logo_image'] : $logo_value['image'];
	$logo_value['width']  = !empty($template_config['logo_width']) ? $template_config['logo_width'] : $logo_value['width'];
	$logo_value['height'] = !empty($template_config['logo_height']) ? $template_config['logo_height'] : $logo_value['height'];
}

if(!empty($logo_value))
{
	$data['logo_value'] = $logo_value;
	$this->load->view('home/'.$active_template.'/top', $data);
}