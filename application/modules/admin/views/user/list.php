<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_admin())
{
	$form = new ecrud();

	$form->setTable('user');
	$form->init('roll');

	$form->setField(array('username','email'));


	$form->addInput('username', 'link');
	$form->setLink('username',base_url('admin/user_edit'), 'id');

	$form->addInput('email', 'plaintext');

	$form->addInput('image', 'thumbnail');
	$form->setLabel('image', 'gambar');
	$form->setImage('image', 'user');

	$form->setLink('image',base_url('admin/content_edit'), 'id');

	$form->addInput('created', 'plaintext');

	$form->addInput('active', 'checkbox');

	$form->setDelete(true);

	$form->form();
}else{
	msg('you dont have permission to access this section','danger');
}
