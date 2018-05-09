<form action="" method="post">
	<button class="btn btn-default"> <i class="fa fa-refresh"></i> Refresh</button>
</form>
<br>
<br>
<?php
$get_id = $this->input->get('id');
if(!empty($get_id))
{
	$jenis  = $this->data_model->get_one('apbdes','jenis', 'WHERE id = '.$get_id);
	$par_id = $this->data_model->get_one('apbdes','par_id', 'WHERE id = '.$get_id);
}

if(!empty($par_id))
{
	$parent = $this->data_model->get_one_data('apbdes','WHERE id = '.$par_id);
}

$this->ecrud->init('edit');
$this->ecrud->setHeading('APBDES');
$this->ecrud->setTable('apbdes');

$this->ecrud->setId($get_id);

$this->ecrud->addInput('par_id','dropdown');
$this->ecrud->setLabel('par_id','Induk Dari');
$this->ecrud->tableOptions('par_id', 'apbdes','id','uraian');


if(!empty($get_id))
{
	if(!empty($par_id))
	{
		$this->ecrud->setOptions('par_id',array($parent['id']=>$parent['uraian']));
	}
}

$this->ecrud->addInput('uraian','text');

$this->ecrud->addInput('anggaran','text');
$this->ecrud->setType('anggaran','number');

$this->ecrud->addInput('is_ket','dropdown');
$this->ecrud->setLabel('is_ket','jadikan keterangan');
$this->ecrud->setOptions('is_ket',array('tidak','iya'));

$this->ecrud->addInput('alias_ket','text');
$this->ecrud->setLabel('alias_ket','beri singkatan');
$this->ecrud->setRequired(array('uraian'));

$this->ecrud->addInput('tahun','hidden');
$this->ecrud->setValue('tahun', date('Y'));

$this->ecrud->startCollapse('is_ket','jadikan keterangan');
$this->ecrud->endCollapse('alias_ket');

if(empty($par_id))
{
	$this->ecrud->addInput('jenis','dropdown');
	$this->ecrud->setOptions('jenis',array('1'=>'Pendapatan','2'=>'Belanja','3'=>'Biaya'));
}

if(!empty($jenis))
{
	if($jenis == 2 && !empty($par_id))
	{
		$this->ecrud->addInput('bidang_id','dropdown');
		$this->ecrud->setLabel('bidang_id','Bidang');
		$this->ecrud->tableOptions('bidang_id', 'bidang','id','title');
	}
}

$this->ecrud->form();



$last_id = $this->data_model->LAST_INSERT_ID();

if(!empty($last_id) || !empty($get_id))
{
  $last_id = !empty($get_id) ? $get_id : $last_id;

  $post = array();
  $level = $this->data_model->get_one('apbdes','level',' WHERE id = '.@intval($_POST['par_id']));
  if(!empty($level))
  {
  	$post['level'] = $level+1;
  	if(!empty($parent))
  	{
  		$post['jenis'] = $parent['jenis'];
  	}
  	$this->data_model->set_data('apbdes',$last_id,$post);
  }
}


$ext = array();
ob_start();
?>
<script type="text/javascript">
	$('select[name="is_ket"]').on('change', function(){
		var a = $(this).val();
		if(a==1){
			$('input[name="alias_ket"]').attr('required','required');
		}else{
			$('input[name="alias_ket"]').removeAttr('required');
		}
	});
</script>
<?php
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_extra', $ext);

