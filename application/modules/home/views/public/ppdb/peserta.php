<h1>data peserta</h1>
<p>di bawah ini hanya menampilkan data peserta yang sudah di validasi oleh admin</p>
<?php

$form = new ecrud();

$form->init('roll');

$form->search();

$form->setField(array('nisn','nama','asal_sekolah'));

$form->setTable('ppdb');

$form->setHeading('Daftar Siswa Baru');

// $form->addInput('id','plaintext');

$form->addInput('nisn', 'plaintext');
$form->setLabel('nisn', 'NISN');

$form->addInput('nama', 'plaintext');

$form->addInput('asal_sekolah', 'plaintext');
$form->setLabel('asal_sekolah','Asal Sekolah');

$form->addInput('tahun_ijazah', 'plaintext');

$form->form();