<?php

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
// $form->setParam($config);
$form->setParamName('header_bottom');
$form->addInput('image', 'upload');
$form->setAccept('image', 'image/jpeg,image/png');
$form->addInput('title', 'text');
$form->addInput('description', 'text');
$form->form();