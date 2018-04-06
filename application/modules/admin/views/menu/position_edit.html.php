<?php defined('BASEPATH') OR exit('No direct script access allowed');

$get_id = $this->input->get('id');

$form = new ecrud();

$form->init('edit');
$form->setTable('menu_position');

$form->setId($get_id);

$form->setHeading('Menu Position');

// $form->setField(array('id','par_id','title'));
$form->addInput('title','text');

// $form->addInput('publish', 'checkbox');

$form->form();