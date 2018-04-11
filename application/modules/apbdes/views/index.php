<?php
$get_id = $this->input->get('id');

$this->ecrud->init('edit');
$this->ecrud->setHeading('APBDES');
$this->ecrud->setTable('apbdes');

$this->ecrud->setId($get_id);

$this->ecrud->addInput('apbdes_ket_id','multiselect');
$this->ecrud->setLabel('apbdes_ket_id','Keterangan');
$this->ecrud->setMultiSelect('apbdes_ket_id', 'apbdes_ket','id,par_id,title');

$this->ecrud->addInput('par_id','dropdown');
$this->ecrud->setLabel('par_id','Induk Dari');
$this->ecrud->tableOptions('par_id', 'apbdes','id','uraian');

$this->ecrud->addInput('uraian','text');

$this->ecrud->addInput('bulan','dropdown');

$bulan = array(
	'01' => 'Januari',
	'02' => 'Februari',
	'03' => 'Maret',
	'04' => 'April',
	'05' => 'Mei',
	'06' => 'Juni',
	'07' => 'Juli',
	'08' => 'Agustus',
	'09' => 'September',
	'10' => 'Oktober',
	'11' => 'November',
	'12' => 'Desember',
);


$this->ecrud->setOptions('bulan', $bulan);
$this->ecrud->setSelected('bulan', date('m'));

$this->ecrud->addInput('tahun', 'text');
$this->ecrud->setType('tahun','number');
$this->ecrud->setAttribute('tahun',array('max'=>date('Y'),'min'=>1990));
$this->ecrud->setValue('tahun', date('Y'));

$this->ecrud->startCollapse('bulan','jika anggaran tidak untuk bulan ini');
$this->ecrud->endCollapse('tahun');

$this->ecrud->addInput('anggaran','text');
$this->ecrud->setType('anggaran','number');
$this->ecrud->form();


$last_id = $this->data_model->LAST_INSERT_ID();

if(!empty($last_id) || !empty($get_id))
{
  $last_id = !empty($get_id) ? $get_id : $last_id;

  $post = array();
  $user = $this->session->userdata('logged_in');
  if(!empty($user))
  {
  	$post['user_id'] = $user['id'];
  	$this->data_model->set_data('apbdes',$last_id,$post);
  }
}

