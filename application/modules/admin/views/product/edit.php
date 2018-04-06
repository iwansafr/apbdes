<?php

$this->ecrud->init('edit');
$this->ecrud->setTable('product');
$this->ecrud->setHeading('Product');
$this->ecrud->addInput('title', 'text');
$this->ecrud->addInput('price', 'text');

$this->ecrud->form();