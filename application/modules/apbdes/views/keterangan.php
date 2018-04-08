<?php

$edit = new ecrud();
$edit->init('edit');
$edit->setTable('apbdes_ket');
$edit->addInput('title','text');
$edit->form();

$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes_ket');
$this->ecrud->search();
$this->ecrud->setField(array('id','title'));
$this->ecrud->addInput('id','plaintext');
$this->ecrud->addInput('title','plaintext');
$this->ecrud->form();