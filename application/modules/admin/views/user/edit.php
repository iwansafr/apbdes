<?php defined('BASEPATH') OR exit('No direct script access allowed');
$get_id = @intval($this->input->get('id'));

$updated = !empty($_POST['submit']) ? 1 : 0;
if(empty($get_id))
{
	$get_id = @intval($this->uri->segment(3));
}

if(is_admin() || $get_id == $this->session->userdata['logged_in']['id'])
{
	$this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');

	$form = new ecrud();


	$form->init('edit');
	$form->setTable('user');

	$form->setId($get_id);

	$form->setHeading('User');

	$form->setField(array('id','username','email'));

	$form->addInput('username', 'text');

	$form->addInput('email', 'text');
	$form->setType('email','email');

	$form->setRequired(array('email','username'));

	$form->addInput('password', 'password');

	$form->addInput('image', 'upload');
	$form->setAccept('image', 'image/jpeg,image/png');

	$form->addInput('role', 'dropdown');
	$role = array(
		'1' => 'admin',
		'2' => 'editor',
		'3' => 'author',
		'4' => 'contributor',
		'5' => 'subscriber',
		);
	$form->setOptions('role', $role);

	$form->addInput('active','checkbox');
	// $form->setCheckBox('active',array('public','private','secret'));

	$form->form();
	if(!empty($updated))
	{
		$data = $this->data_model->get_one_data('user', ' WHERE id = '.$get_id);
		if(!empty($data))
		{
			$this->session->set_userdata('logged_in', $data);
			set_cookie('username', $data['username']);
			set_cookie('password', $data['password']);
		}
	}
}else{
	msg('you dont have permission to access this section','danger');
}