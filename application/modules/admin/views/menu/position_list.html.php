<?php defined('BASEPATH') OR exit('No direct script access allowed');

$form = new ecrud();

$form->setTable('menu_position', 'id', 'DESC');
$form->init('roll');

$form->search();

$form->setField(array('id','title'));


$form->addInput('title','link');
$form->setLink('title',base_url('admin/menu_position'),'id');

$form->addInput('id','link');
$form->setLink('id',base_url('admin/menu_position_menu'),'id');
$form->setPlaintext('id','detail');
$form->setLabel('id','detail');

$form->setDelete(true);

$form->form();