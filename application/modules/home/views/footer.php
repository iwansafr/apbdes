<?php defined('BASEPATH') OR exit('No direct script access allowed');
$site_value      = $this->esg->get_config('site');
$template_config = $this->esg->get_config($active_template.'_config');
if(!empty($template_config))
{
	$site_value['title']       = !empty($template_config['site_title']) ? $template_config['site_title'] : $site_value['title'];
	$site_value['link']        = !empty($template_config['site_link']) ? $template_config['site_link'] : $site_value['link'];
	$site_value['image']       = !empty($template_config['site_image']) ? $template_config['site_image'] : $site_value['image'];
	$site_value['keyword']     = !empty($template_config['site_keyword']) ? $template_config['site_keyword'] : $site_value['keyword'];
	$site_value['description'] = !empty($template_config['site_description']) ? $template_config['site_description'] : $site_value['description'];
}

$this->load->view('home/'.$active_template.'/footer');
