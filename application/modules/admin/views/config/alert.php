<?php

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
$form->setParamName('alert');
$form->addInput('login_failed','text');
$form->setLabel('login_failed','Message When Login Failed');
$form->addInput('login_max_failed','text');
$form->setLabel('login_max_failed','Message When Login Failed 3 time');
$form->addInput('save_success','text');
$form->setLabel('save_success','Message When Save Success');
$form->form();