<?php

$this->ecrud->init('param');
$this->ecrud->setTable('config');
// $this->ecrud->setParam($config);
$this->ecrud->setParamName('web_type');
$this->ecrud->addInput('type', 'dropdown');
$this->ecrud->setLabel('type','Web Type');
$this->ecrud->setOptions('type', array('Corporate', 'Shop'));
$this->ecrud->form();