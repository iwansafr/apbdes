<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($main_data['msg']))
{
	$this->ecrud->init('param');
	$this->ecrud->setTable('config');
	$this->ecrud->setId($this->input->get('id'));
	$this->ecrud->setHeading('pembatasan perubahan apbdes');
	$this->ecrud->setParamName('limit_user_'.$this->input->get('id'));
	$this->ecrud->addInput('tahun','checkbox');
	$this->ecrud->setLabel('tahun','pilih tahun');
	$this->ecrud->setCheckBox('tahun',$main_data['tahun']);
	$this->ecrud->form();
}else{
	echo msg($main_data['msg']['msg'], $main_data['msg']['alert']);
}