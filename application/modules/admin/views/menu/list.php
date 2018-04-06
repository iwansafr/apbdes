<?php defined('BASEPATH') OR exit('No direct script access allowed');

$get_id = $this->input->get('id');

$form = new ecrud();

$form->init('roll');
$form->setTable('menu');

$form->setId($get_id);

$form->search();

$form->setField(array('id','title'));

$form->addInput('id','plaintext');
$form->addInput('title','link');
$form->setLink('title',base_url('admin/menu_edit'), 'id');

$form->addInput('position_id','dropdown');
$form->setLabel('position_id', 'Menu Position');
$form->tableOptions('position_id', 'menu_position','id','title');
$form->setAttribute('position_id', array('disabled'=>'disabled'));

// $form->addInput('sort_order','order');

$form->addInput('link','plaintext');

$form->setDelete(true);

$form->form();