<?php
$form = new Ecrud();
$form->init('param');
$form->setTable('config');
$form->setParamName('pemdes');
$form->setHeading('Detail Desa');
$form->addInput('desa', 'text');
$form->addInput('kep_des', 'text');

$form->form();