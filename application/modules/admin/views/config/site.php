<?php

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
// $form->setParam($config);
$form->setParamName('site');
$form->addInput('title', 'text');
$form->addInput('link', 'text');
$form->addInput('image', 'upload');
$form->setAccept('image', 'image/jpeg,image/png');
$form->addInput('keyword', 'text');
$form->addInput('description', 'textarea');
$form->form();