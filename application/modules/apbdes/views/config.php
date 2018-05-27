<?php
$form = new Ecrud();
$form->init('param');
$form->setTable('config');
$form->setParamName('pemdes');
$form->setHeading('Detail Desa');
$form->addInput('desa', 'text');
$form->addInput('kep_des', 'text');
$form->addInput('tahun','text');
$form->setType('tahun','number');
$form->setAttribute('tahun',array('max'=>date('Y')+1,'min'=>2000));
$form->setRequired(array('tahun'));

$form->form();