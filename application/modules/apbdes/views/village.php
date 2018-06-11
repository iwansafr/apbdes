<?php defined('BASEPATH') OR exit('No direct script access allowed');
// pr($main_data);
$this->ecrud->init('roll');
$this->ecrud->setTable('desa');
$this->ecrud->join('user','ON(user.id=desa.child_id)', 'desa.child_id,user.username,user.id');
$this->ecrud->setWhere('desa.parent_id = '.user('id'));
$this->ecrud->addInput('child_id','plaintext');
$this->ecrud->setLabel('child_id','id');
$this->ecrud->addInput('username','link');
$this->ecrud->setLink('username',base_url('apbdes/report'),'id');
$this->ecrud->setLabel('username','desa');

$this->ecrud->form();