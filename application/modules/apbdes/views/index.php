<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form action="" method="post">
	<button class="btn btn-default"> <i class="fa fa-refresh"></i> Refresh</button>
</form>
<br>
<br>
<?php
$tahun   = $this->apbdes_model->get_tahun();
$user_id = user('id');
$get_id  = $this->input->get('id');
if(!empty($get_id))
{
	$jenis  = $this->data_model->get_one('apbdes','jenis', 'WHERE id = '.$get_id);
	$par_id = $this->data_model->get_one('apbdes','par_id', 'WHERE id = '.$get_id);
	$data   = $this->db->get_where('apbdes','id = '.$get_id)->row_array();
}
$_SESSION['tmp_anggaran'] = !empty($data) ? $data['anggaran'] : 0;

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
$this->ecrud->tableOptions('par_id', 'apbdes','id','uraian', 'WHERE tahun = '.$tahun);


if(!empty($get_id))
{
	if(!empty($par_id))
	{
		$this->ecrud->setOptions('par_id',array($parent['id']=>$parent['uraian']));
	}else{
		$this->ecrud->setOptions('par_id',array('none'));
	}
}

$this->ecrud->addInput('uraian','text');
if(@intval($parent['level']) > 1 && $data['is_parent'] == 0){
	$this->ecrud->addInput('anggaran','text');
	$this->ecrud->setType('anggaran','number');
}

$this->ecrud->addInput('user_id','hidden');
$this->ecrud->setValue('user_id',$user_id);

$this->ecrud->addInput('is_ket','dropdown');
$this->ecrud->setLabel('is_ket','jadikan keterangan');
$this->ecrud->setOptions('is_ket',array('tidak','iya'));

$this->ecrud->addInput('alias_ket','text');
$this->ecrud->setLabel('alias_ket','beri singkatan');
$this->ecrud->setRequired(array('uraian'));

$this->ecrud->addInput('tahun','hidden');
$this->ecrud->setValue('tahun', $tahun);

$this->ecrud->startCollapse('is_ket','jadikan keterangan');
$this->ecrud->endCollapse('alias_ket');

if(empty($par_id))
{
	$this->db->select('id,uraian as title');
	$data_jenis = $this->db->get_where('apbdes','par_id = 0 AND tahun = '.$tahun.' AND user_id = '.$user_id)->result_array();
	$jenis_data = array();
	if(!empty($data_jenis))
	{
		foreach ($data_jenis as $key => $value)
		{
			$jenis_data[$value['id']] = $value['title'];
		}
	}
	if(!empty($jenis_data))
	{
		$this->ecrud->addInput('jenis','dropdown');
		$this->ecrud->setOptions('jenis',$jenis_data);
	}
}

if(!empty($jenis))
{
	if($jenis == 2 && !empty($par_id) && @intval($data['level']) == 2)
	{
		$this->ecrud->addInput('bidang_id','dropdown');
		$this->ecrud->setLabel('bidang_id','Bidang');
		$this->ecrud->tableOptions('bidang_id', 'bidang','id','title');
	}
}

$belanja_id = $this->data_model->get_one('apbdes','id',"WHERE uraian = 'belanja' AND tahun = {$tahun} AND user_id = ".$user_id);
if(!empty($belanja_id) && @intval($parent['level']) > 1)
{
	if(!empty($parent['jenis']))
	{
		if($parent['jenis'] == $belanja_id)
		{
			// $form->addInput('apbdes_ids','multiselect');
			// $form->setMultiSelect('apbdes_ids','apbdes','id,par_id,uraian AS title');

			$this->db->select('id,alias_ket as title');
			$ket_tmp = $this->db->get_where('apbdes','is_ket = 1 AND TAHUN = '.$tahun.' AND user_id = '.$user_id)->result_array();
			$ket = array();
			foreach ($ket_tmp as $key => $value)
			{
				if($value['title'] == 'ADD')
				{
					$add_id = $value['id'];
				}
				$ket[$value['id']] = $value['title'];
			}
			$this->ecrud->addInput('apbdes_ids','radio');
			$this->ecrud->setLabel('apbdes_ids','Keterangan');
			$this->ecrud->setRadio('apbdes_ids',$ket);
		}
	}
}
$this->ecrud->form();

$last_id = $this->data_model->LAST_INSERT_ID();
if(!empty($last_id) || !empty($get_id))
{
  $last_id = !empty($get_id) ? $get_id : $last_id;

  $post = array();
  $level = $this->data_model->get_one('apbdes','level',' WHERE id = '.@intval($_POST['par_id']));

  if(@intval($data['level'])>2)
  {
		if(@intval($_SESSION['tmp_anggaran']) > @intval($_POST['anggaran']))
		{
			$_SESSION['div_anggaran'] = @intval($_SESSION['tmp_anggaran']) - @intval($_POST['anggaran']);
			$_SESSION['div_anggaran'] = -$_SESSION['div_anggaran'];
		}else if(@intval($_SESSION['tmp_anggaran']) < @intval($_POST['anggaran']))
		{
			$_SESSION['div_anggaran'] = @intval($_POST['anggaran']) - @intval($_SESSION['tmp_anggaran']);
		}else{
			$_SESSION['div_anggaran'] = 0;
		}
  }

	$keterangan = @$_POST['apbdes_ids'];
	if(!empty($keterangan))
	{
		$_SESSION['add_keterangan'] = $keterangan;
		$this->apbdes_model->set_keterangan($last_id);
	}
  if(!empty($level))
  {
  	if(!empty($parent['bidang_id']))
  	{
  		$post['bidang_id'] = $parent['bidang_id'];
  	}
  	if(@intval($data['level'])==2)
  	{
  		$apbdes_ids = $this->apbdes_model->get_apbdes_ids($last_id);
  		$this->apbdes_model->set_bidang($apbdes_ids,@intval($_POST['bidang_id']));
  	}

  	if(!empty($parent))
  	{
  		if(empty($parent['is_parent']))
  		{
  			$this->data_model->set_data('apbdes', $parent['id'],array('is_parent'=>1));
  		}
  	}

  	$post['level'] = $level+1;
  	if(!empty($parent))
  	{
  		$post['jenis'] = $parent['jenis'];
  	}
  	$this->data_model->set_data('apbdes',$last_id,$post);
  	if(@intval($data['level']) > 2)
  	{
  		$this->apbdes_model->set_anggaran($last_id);
  	}
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
if(!empty($ket))
{
	foreach ($ket as $ket_key => $ket_value)
	{
		$index = 'sisa_anggaran_'.$ket_key;
		?>
		<script type="text/javascript">
			if($('input[class="apbdes_ids"][value="<?php echo $ket_key ?>"]').is(':checked')){
				$('input[name="anggaran"]').attr("max","<?php echo @intval($_SESSION[$index]) ?>");
			}
			$('input[class="apbdes_ids"]').on('click',function(){
				if($('input[class="apbdes_ids"][value="<?php echo $ket_key ?>"]').is(':checked')){
					$('input[name="anggaran"]').attr("max","<?php echo @intval($_SESSION[$index]) ?>");
				}
			});
		</script>
		<?php
	}
}
if(!empty($add_id))
{
	?>
	<script type="text/javascript">
		function check(a){
			if(a=='Penghasilan Tetap Petinggi dan Perangkat' || a=='penghasilan tetap petinggi dan perangkat'){
				if($('input[class="apbdes_ids"][value="<?php echo $add_id ?>"]').is(':checked')){
					$('input[name="anggaran"]').attr("max","<?php echo @intval($_SESSION['add_pemerintahan_sisa']) ?>");
				}
				$('input[class="apbdes_ids"]').on('click',function(){
					if($('input[class="apbdes_ids"][value="<?php echo $add_id ?>"]').is(':checked')){
						$('input[name="anggaran"]').attr("max","<?php echo @intval($_SESSION['add_pemerintahan_sisa']) ?>");
					}
				});
			}
		}
		var a = $('input[name="uraian"]').val();
		$('input[name="uraian"').on('keyup',function(){
			var a = $('input[name="uraian"]').val();
			check(a);
		});
	</script>
	<?php
	unset($_SESSION['add_pemerintahan_sisa']);
}
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_extra', $ext);

