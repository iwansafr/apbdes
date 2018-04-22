<?php

$edit = new ecrud();
$id   = $this->input->get('id');
$edit->init('edit');
$edit->setId($id);
$edit->setTable('apbdes_ket');
$edit->addInput('title','text');
$edit->form();

$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes_ket');
$this->ecrud->search();
$this->ecrud->setField(array('id','title'));
$this->ecrud->addInput('id','plaintext');
$this->ecrud->setEditLink(base_url('apbdes/keterangan?id='));
$this->ecrud->addInput('title','plaintext');
$this->ecrud->setDelete(true);
$this->ecrud->form();