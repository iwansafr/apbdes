<?php
$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes');
$this->ecrud->search();
// $this->ecrud->setField(array('id','uraian','anggaran'));

$this->ecrud->addInput('id','link');
$this->ecrud->setLink('id', base_url('apbdes/index'),'id');
$this->ecrud->addInput('uraian','plaintext');
$this->ecrud->addInput('anggaran','plaintext');

$this->ecrud->setDelete(true);

$this->ecrud->form();