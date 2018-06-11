<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty(user()))
{
	$form = new Ecrud();
	$form->init('param');
	$form->setTable('config');
	$form->setParamName('config_user_'.user('id'));
	$form->setHeading('Detail Desa');
	$form->addInput('desa', 'text');
	$form->setAttribute('desa','readonly');
	$form->setValue('desa',user('username'));
	$form->addInput('kep_des', 'text');
	$form->setLabel('kep_des','Kepala Desa');
	$form->addInput('tahun','text');
	$form->setType('tahun','number');
	$form->setAttribute('tahun',array('max'=>date('Y')+1,'min'=>2000));
	$form->setRequired(array('tahun'));

	$form->form();
}