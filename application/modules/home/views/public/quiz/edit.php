<?php

$form = new ecrud();

$form->init('edit');

$form->setTable('question');
$form->addInput('question','textarea');
$form->setElementId('question','textckeditor');
$form->addInput('option1','text');
$form->addInput('option2','text');
$form->addInput('answer', 'dropdown');
$form->setOptions('answer', array('1'=>'Option1', '2'=>'Option2'));

$form->setRequired(array('question','option1','option2'));

$form->form();