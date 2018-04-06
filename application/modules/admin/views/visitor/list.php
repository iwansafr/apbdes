<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_admin())
{
	$form = new ecrud();

	$form->setTable('visitor');
	$form->init('roll');

	$form->search();

	$form->setField(array('ip','visited'));


	$form->addInput('ip', 'plaintext');

	$form->addInput('visited', 'plaintext');

	$form->addInput('created', 'plaintext');

	$form->form();
}else{
	msg('you dont have permission to access this section','danger');
}
