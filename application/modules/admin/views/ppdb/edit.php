<?php
$get_id = @intval($this->input->get('id'));
$form = new ecrud();

$form->init('edit');

$form->setTable('ppdb');

$form->setId($get_id);

$form->setHeading('Daftar Siswa Baru');

$form->addInput('nisn', 'text');
$form->setLabel('nisn', 'NISN');
$form->setType('nisn','number');

$form->addInput('nama', 'text');

$form->addInput('jenis_kelamin', 'dropdown');
$form->setOptions('jenis_kelamin', array('laki-laki'=>'Laki-Laki', 'perempuan'=>'Perempuan'));
$form->setLabel('jenis_kelamin', 'Jenis Kelamin');

$form->addInput('tempat_lahir','text');
$form->setLabel('tempat_lahir','Tempat Lahir');

$form->addInput('agama', 'dropdown');
$form->setOptions('agama', array('islam'=>'Islam','kristen'=>'Kristen','katolik'=>'Katolik','hindu'=>'Hindu','budha'=>'Budha'));

$form->addInput('alamat', 'textarea');

$form->addInput('telp', 'text');
$form->setType('telp','number');

$form->addInput('email', 'text');
$form->setType('email','email');

$form->addInput('asal_sekolah', 'text');
$form->setLabel('asal_sekolah','Asal Sekolah');

$form->addInput('no_sttb', 'text');
$form->setLabel('no_sttb', 'No STTB');
$form->setType('no_sttb','number');

$form->addInput('no_skhu', 'text');
$form->setLabel('no_skhu', 'No SKHU');
$form->setType('no_skhu','number');

$form->addInput('tahun_ijazah', 'dropdown');
$form->setLabel('tahun_ijazah','Tahun Ijazah');
$form->setOptions('tahun_ijazah', array('2011'=>'2011','2012'=>'2012','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019'));

$form->addInput('nilai_un', 'text');
$form->setLabel('nilai_un','Nilai UN');

$form->addInput('nama_orangtua', 'text');
$form->setLabel('nama_orangtua','Nama Orangtua');

$form->addInput('alamat_orangtua', 'textarea');
$form->setLabel('alamat_orangtua','Alamat Orang Tua');

$form->addInput('pekerjaan_orangtua', 'text');
$form->setLabel('pekerjaan_orangtua','Pekerjaan Orang Tua');

$form->addInput('telp_orangtua', 'text');
$form->setType('telp_orangtua','number');
$form->setLabel('telp_orangtua', 'Telp Orang Tua');

// if(is_admin())
// {
// 	$form->addInput('publish','checkbox');
// 	$form->setValue('publish', 1);
// }else{
	$form->addInput('publish','hidden');
	$form->setValue('publish', 0);
// }

$form->setRequired(array('nisn','nama','tempat_lahir','alamat','telp','asal_sekolah','no_sttb','no_skhu','nilai_un','nama_orangtua','alamat_orangtua','pekerjaan_orangtua'));

$form->form();