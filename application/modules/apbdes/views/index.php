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

