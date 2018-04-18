<?php

$par_id = @intval($this->input->get('id'));

if(!empty($par_id))
{
	$data = $this->data_model->get_one_data('apbdes',' WHERE id = '.$par_id);
}
$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes');
$this->ecrud->search();
$this->ecrud->setField(array('id','uraian','anggaran'));
$this->ecrud->setWhere('par_id = '.$par_id);

$this->ecrud->addInput('uraian','link');
$this->ecrud->setLink('uraian',base_url('apbdes/apbdes_list'),'id');

$this->ecrud->addInput('no','text');

$this->ecrud->addInput('created', 'plaintext');

$this->ecrud->addInput('anggaran','plaintext');

$this->ecrud->setEditLink(base_url('apbdes').'?id=');
$this->ecrud->setDelete(true);

?>

<div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab">List Anggaran</a></li>
    <li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Tambah Anggarah</a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="list">
			<?php $this->ecrud->form();?>
    </div>
    <div role="tabpanel" class="tab-pane" id="edit">
    	<?php

			$form = new ecrud();
			$form->init('edit');
			$form->setHeading('APBDES');
			$form->setTable('apbdes');

			$form->addInput('apbdes_ket_id','multiselect');
			$form->setLabel('apbdes_ket_id','Keterangan');
			$form->setMultiSelect('apbdes_ket_id', 'apbdes_ket','id,par_id,title');

			$form->addInput('par_id','dropdown');
			$form->setLabel('par_id','Induk Dari');
			if(!empty($data))
			{
				$form->setOptions('par_id',array($data['id']=>$data['uraian']));
			}else{
				$form->setOptions('par_id', array('0'=>'none'));
			}

			$form->addInput('uraian','text');

			$form->addInput('anggaran','text');
			$form->setType('anggaran','number');
			$form->form();


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
    	?>
    </div>
  </div>
</div>