<?php
$esg = new esg();
$data = $esg->get_config('templates');

$form = new Ecrud();
$form->init('param');
$form->setTable('config');
$form->setParamName($data['templates'].'_config');

$form->addInput('site_title', 'text');
$form->addInput('site_link', 'text');
$form->addInput('site_image', 'upload');
$form->setAccept('site_image', 'image/jpeg,image/png');
$form->addInput('site_keyword', 'text');
$form->addInput('site_description', 'textarea');
$form->startCollapse('site_title', 'site configuration');
$form->endCollapse('site_description');

$form->addInput('logo_title', 'text');
$form->addInput('logo_image', 'upload');
$form->setAccept('logo_image', 'image/jpeg,image/png');
$form->addInput('logo_width', 'text');
$form->addInput('logo_height', 'text');

$form->startCollapse('logo_title', 'logo configuration');
$form->endCollapse('logo_height');

$form->form();