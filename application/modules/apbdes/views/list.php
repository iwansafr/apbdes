<?php

$tahun = $this->apbdes_model->get_tahun();

$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes');
$this->ecrud->search();
$this->ecrud->setField(array('id','uraian','anggaran'));

$this->ecrud->addInput('uraian','plaintext');
$this->ecrud->setView('apbdes/list');
$this->ecrud->setWhere('tahun = '.$tahun);
// $this->ecrud->setLink('uraian',base_url('apbdes/apbdes_list'),'id');

// $this->ecrud->addInput('no','text');

$this->ecrud->addInput('created', 'plaintext');

$this->ecrud->addInput('anggaran','plaintext');
$this->ecrud->setMoney('anggaran','Rp');

$this->ecrud->setEditLink(base_url('apbdes').'?id=');
$this->ecrud->setDelete(true);

$this->ecrud->form();