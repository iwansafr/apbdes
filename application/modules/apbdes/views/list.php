<?php

$par_id = @intval($this->input->get('id'));
$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes');
$this->ecrud->search();
// $this->ecrud->setField(array('id','uraian','anggaran'));
$this->ecrud->setWhere('par_id = '.$par_id);

$this->ecrud->addInput('uraian','link');
$this->ecrud->setLink('uraian',base_url('apbdes/list'),'id');
$this->ecrud->addInput('anggaran','plaintext');

$this->ecrud->setEditLink(base_url().'?id=');

$this->ecrud->setDelete(true);

$this->ecrud->form();