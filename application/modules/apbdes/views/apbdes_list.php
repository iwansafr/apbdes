<form action="" method="post">
	<button class="btn btn-default"> <i class="fa fa-refresh"></i> Refresh</button>
</form>
<br>
<?php
$par_id = @intval($this->input->get('id'));
$tahun = $this->apbdes_model->get_tahun();

if(!empty($par_id))
{
	$data  = $this->data_model->get_one_data('apbdes'," WHERE id = {$par_id} AND created LIKE '$tahun%'");
	$jenis = $this->data_model->get_one('apbdes','jenis', 'WHERE id = '.$par_id);
}
$this->ecrud->init('roll');
$this->ecrud->setTable('apbdes','id','DESC');
$this->ecrud->search();
$this->ecrud->setField(array('id','uraian','anggaran'));
// $this->ecrud->orderBy('no','ASC');
$this->ecrud->setWhere("par_id = $par_id AND created LIKE '$tahun%'");

$this->ecrud->addInput('uraian','link');
$this->ecrud->setLink('uraian',base_url('apbdes/apbdes_list'),'id');

$this->ecrud->addInput('anggaran','plaintext');
$this->ecrud->setMoney('anggaran','Rp');

$this->ecrud->setEditLink('?id=');
$this->ecrud->setEdit(true);

$this->ecrud->setEditLink(base_url('apbdes').'?id=');
if(!empty($par_id))
{
	$this->ecrud->setDelete(true);
}

?>

<div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab">List Anggaran</a></li>
    <?php
    if(!empty($par_id))
    {
    	?>
	    <li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Tambah Anggarah</a></li>
	    <li>
	    	<?php
	    	if(!empty($data['id']))
				{
					$id = $this->data_model->get_one('apbdes','id',' WHERE id = '.$data['par_id']);
					$id = !empty($id) ? '?id='.$id : '';
					?>
					<a href="<?php echo base_url('apbdes/apbdes_list'.$id) ?>"> <span class="fa fa-arrow-left"></span> back</a>
					<?php
				}?>
	    </li>
    	<?php
    }
    ?>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="list">
			<?php $this->ecrud->form();?>
    </div>
    <?php
    if(!empty($par_id))
    {
    	?>
	    <div role="tabpanel" class="tab-pane" id="edit">
	    	<?php
	    	// $this->load->view('index');
				$form = new ecrud();
				$form->init('edit');
				$form->setHeading('APBDES');
				$form->setTable('apbdes');

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

				$form->addInput('is_ket','dropdown');
				$form->setLabel('is_ket','jadikan keterangan');
				$form->setOptions('is_ket',array('tidak','iya'));

				$form->addInput('alias_ket','text');
				$form->setLabel('alias_ket','beri singkatan');
				$form->setRequired(array('uraian'));

				$form->addInput('tahun','hidden');
				$form->setValue('tahun', date('Y'));

				$form->startCollapse('is_ket','jadikan keterangan');
				$form->endCollapse('alias_ket');

				if(empty($par_id))
				{
					$this->ecrud->addInput('jenis','dropdown');
					$this->ecrud->setOptions('jenis',array('1'=>'Pendapatan','2'=>'Belanja','3'=>'Biaya'));
				}

				if(!empty($jenis))
				{
					if($jenis == 2 && !empty($par_id))
					{
						$form->addInput('bidang_id','dropdown');
						$form->setLabel('bidang_id','Bidang');
						$form->tableOptions('bidang_id', 'bidang','id','title');
					}
				}

				$belanja_id = $this->data_model->get_one('apbdes','id',"WHERE uraian = 'belanja'");

				if(!empty($belanja_id))
				{
					if(!empty($data['jenis']))
					{
						if($data['jenis'] == $belanja_id)
						{
							// $form->addInput('apbdes_ids','multiselect');
							// $form->setMultiSelect('apbdes_ids','apbdes','id,par_id,uraian AS title');

							$this->db->select('id,alias_ket as title');
							$ket_tmp = $this->db->get_where('apbdes','is_ket = 1')->result_array();
							$ket = array();
							foreach ($ket_tmp as $key => $value)
							{
								$ket[$value['id']] = $value['title'];
							}
							$form->addInput('apbdes_ids','checkbox');
							$form->setCheckBox('apbdes_ids',$ket);
						}
					}
				}
				$form->form();



				$last_id = $this->data_model->LAST_INSERT_ID();

				if(!empty($last_id) || !empty($get_id))
				{
				  $last_id = !empty($get_id) ? $get_id : $last_id;

				  $post = array();
				  $level = $this->data_model->get_one('apbdes','level',' WHERE id = '.@intval($_POST['par_id']));
				  if(!empty($level))
				  {
				  	$post['level'] = $level+1;
				  	if(!empty($data))
				  	{
				  		$post['jenis'] = $data['jenis'];
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
	    	?>
	    </div>
    	<?php
    }
    ?>
  </div>
</div>