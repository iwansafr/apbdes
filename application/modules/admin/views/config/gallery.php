<?php

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
// $form->setParam($config);
$form->setParamName('gallery');
$form->addInput('title', 'text');
$form->addInput('description', 'textarea');

$form->form();