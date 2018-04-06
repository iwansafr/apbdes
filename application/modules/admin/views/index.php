<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data         = array();
$site         = $this->config_model->get_config('site');
$data['site'] = @$site;
$this->db->select('value');
$active_template = $this->db->get_where('config',"name = 'templates'")->row_array();
$admin_templates = '';

if(!empty($active_template))
{
	$active_template = json_decode($active_template['value'], 1);
	$admin_templates = $active_template['admin_templates'];
	$active_template = $active_template['templates'];
	$config_name     = $active_template.'_widget';
	$config_template = $this->data_model->get_one('config', 'value',"WHERE name = '{$config_name}'");
	if(empty($config_template))
	{
		$data['config_alert'] = 'Widget not yet configured please configure it first <a href="'.base_url('admin/config_widget/widget/').'">here</a>';
	}
	$data['admin_templates'] = $admin_templates;
}

if(!empty($this->session->userdata['logged_in']))
{
	$mod['name'] = $this->router->fetch_class();
	$mod['task'] = $this->router->fetch_method();

	$this->session->set_userdata('parent_menu', '');
	$mod['string'] = explode('_',$mod['task']);
	$mod['name']   = $mod['string'][0];
	unset($mod['string'][0]);
	$mod['task'] = implode('_',$mod['string']);

	$content                 = ($mod['name'] == 'index') ? 'admin/content' : $mod['name'].'/'.$mod['task'];
	$data['content']         = $content;
	$data['task']            = $mod['task'];
	$data['module']          = $mod['name'];

	$this->session->__set('link_js','');
	$this->load->view('admin/home',$data);
}else if(!empty($_COOKIE['username'])){
	$username = get_cookie('username');
  $password = get_cookie('password');
  $current_password = $this->data_model->get_one('user', 'password', " WHERE username = '{$username}'");
  $allow = decrypt($password, $current_password);
  if(!empty($allow))
  {
    $data = $this->data_model->get_one_data('user', "WHERE username = '{$username}'");
    $this->session->set_userdata('logged_in', $data);
    set_cookie('username', $username);
    set_cookie('password', $password);
    $this->load->view('admin/index', $data);
  }
}else{
	$this->load->view('user/login', $data);
}
