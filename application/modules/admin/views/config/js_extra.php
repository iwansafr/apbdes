<?php

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
$form->setParamName('js_extra');
$form->addInput('code', 'textarea');
$form->setLabel('code', 'your js code');
$form->form();