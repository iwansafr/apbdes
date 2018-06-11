<?php defined('BASEPATH') OR exit('No direct script access allowed');
$par_id    = @intval($this->input->get('id'));
$tahun     = $this->apbdes_model->get_tahun();
$user_id   = user('id');
$forbidden = @$main_data['forbidden'];

if(!empty($forbidden) && in_array($tahun,$forbidden))
{
	msg('anda tidak diperkenankan mengedit apbdes tahun '.$tahun, 'danger');
}else{
	$exist   = $this->data_model->get_one('apbdes','id',' WHERE tahun = '.$tahun.' AND par_id = 0 AND user_id = '.$user_id);
	if(!empty($exist))
	{
		?>
		<form action="" method="post">
			<button class="btn btn-default"> <i class="fa fa-refresh"></i> Refresh</button>
		</form>
		<br>
		<?php

		if(!empty($par_id))
		{
			$data  = $this->data_model->get_one_data('apbdes',' WHERE id = '.$par_id);
			$jenis = $this->data_model->get_one('apbdes','jenis', 'WHERE id = '.$par_id);
		}
		$this->ecrud->init('roll');
		$this->ecrud->setTable('apbdes','id','DESC');
		$this->ecrud->setField(array('id','uraian','anggaran'));
		$this->ecrud->setWhere('par_id = '.$par_id.' AND tahun = '.$tahun.' AND user_id = '.$user_id);

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
		}else{
			$this->ecrud->setDelete(true);
		}

		$this->ecrud->setDelete(true, 'button');

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
					<?php
					$this->ecrud->form();
					if(!empty($_POST['del_row']))
					{
						$del_apbdes_ids = array();
						foreach ($_POST['del_row'] as $key => $value)
						{
							$del_apbdes_ids_tmp = $this->apbdes_model->get_apbdes_ids($value);
							if(!empty($del_apbdes_ids_tmp))
							{
								$del_apbdes_ids = array_merge($del_apbdes_ids,$del_apbdes_ids_tmp);
							}
						}
						$this->apbdes_model->delete($del_apbdes_ids);
						unset($del_apbdes_ids);
						unset($del_apbdes_ids_tmp);
					}
					?>
		    </div>
		    <?php
		    if(!empty($par_id))
		    {
		    	?>
			    <div role="tabpanel" class="tab-pane" id="edit">
			    	<?php
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

						if($data['level'] > 1){
							$form->addInput('anggaran','text');
							$form->setType('anggaran','number');
						}

						$form->addInput('is_ket','dropdown');
						$form->setLabel('is_ket','jadikan keterangan');
						$form->setOptions('is_ket',array('tidak','iya'));

						$form->addInput('alias_ket','text');
						$form->setLabel('alias_ket','beri singkatan');
						$form->setRequired(array('uraian'));

						$form->addInput('tahun','hidden');
						$form->setValue('tahun', $tahun);

						$form->addInput('user_id','hidden');
						$form->setValue('user_id', user('id'));

						$form->startCollapse('is_ket','jadikan keterangan');
						$form->endCollapse('alias_ket');

						if(empty($par_id))
						{
							$this->ecrud->addInput('jenis','dropdown');
							$this->ecrud->setOptions('jenis',array('1'=>'Pendapatan','2'=>'Belanja','3'=>'Biaya'));
						}
						if(!empty($jenis))
						{
							if((!empty($par_id)) && (@intval($data['level']) ==1) && ($data['uraian'] == 'BELANJA'))
							{
								$form->addInput('bidang_id','dropdown');
								$form->setLabel('bidang_id','Bidang');
								$form->tableOptions('bidang_id', 'bidang','id','title');
							}
						}

						$belanja_id = $this->data_model->get_one('apbdes','id',"WHERE uraian = 'belanja' AND tahun = $tahun AND user_id = ".$user_id);

						if(!empty($belanja_id))
						{
							if(!empty($data['jenis']))
							{
								if($data['jenis'] == $belanja_id)
								{
									$this->db->select('id,alias_ket as title');
									$ket_tmp = $this->db->get_where('apbdes','is_ket = 1 AND tahun = '.$tahun.' AND user_id = '.$user_id)->result_array();
									$ket = array();
									foreach ($ket_tmp as $key => $value)
									{
										if($value['title'] == 'ADD')
										{
											$add_id = $value['id'];
										}
										$ket[$value['id']] = $value['title'];
									}
									$form->addInput('apbdes_ids','radio');
									$form->setLabel('apbdes_ids','Keterangan');
									$form->setRadio('apbdes_ids',$ket);
								}
							}
						}
						$form->form();
						$last_id = $this->data_model->LAST_INSERT_ID();

						if(!empty($last_id) || !empty($get_id))
						{
						  $last_id = !empty($get_id) ? $get_id : $last_id;

						  $post = array();
						  $level = $data['level'];
						  if(!empty($level))
						  {
						  	if(!empty($data['bidang_id']))
						  	{
						  		$post['bidang_id'] = $data['bidang_id'];
						  	}

								if(!empty($data['id']))
								{
									$this->data_model->set_data('apbdes', $data['id'],array('is_parent'=>1));
								}

						  	$post['level']            = $level+1;
						  	$_SESSION['div_anggaran'] = @intval($_POST['anggaran']);
						  	$keterangan = @$_POST['apbdes_ids'];
						  	if(!empty($keterangan))
						  	{
						  		$_SESSION['add_keterangan'] = $keterangan;
						  		$this->apbdes_model->set_keterangan($last_id);
						  	}
						  	if(!empty($data))
						  	{
						  		$post['jenis'] = $data['jenis'];
						  	}
						  	$this->data_model->set_data('apbdes',$last_id,$post);
						  	$this->apbdes_model->set_anggaran($last_id);
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
							$('button[name="delete_form_1"]').on('click',function(){
								var a = confirm("apakah anda yakin ingin menghapus data ?");
								if(a){
									var b = $('#form_1').serializeArray();
									$.ajax({
							      type:"POST",
							      url:"<?php echo base_url('apbdes/apbdes_delete') ?>",
							      data:{data:b},
							      success:function(result){
							      	console.log(result);
							      	$('#form_1')[0].submit();
							      }
							    });
								}
							});
						</script>
						<?php
				  	$id_pemerintahan = $this->data_model->get_one('bidang','id',"WHERE title = 'pemerintahan'");
				  	if(!empty($id_pemerintahan))
				  	{
				  		if($id_pemerintahan != $data['bidang_id'])
				  		{
				  			$add_id = 0;
				  		}
				  	}
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
			    	?>
			    </div>
		    	<?php
		    }else{
					$ext = array();
					ob_start();
					?>
					<script type="text/javascript">
						$('button[name="delete_form_1"]').on('click',function(){
							var a = confirm("apakah anda yakin ingin menghapus data ?");
							if(a){
								var b = $('#form_1').serializeArray();
								$.ajax({
						      type:"POST",
						      url:"<?php echo base_url('apbdes/apbdes_delete') ?>",
						      data:{data:b},
						      success:function(result){
						      	console.log('hapus data berhasil');
						      }
						    });
							}
						});
					</script>
					<?php
					$ext = ob_get_contents();
					ob_end_clean();
					$this->session->set_userdata('js_extra', $ext);
		    }
		    ?>
		  </div>
		</div>
		<?php
		if(!empty($_POST['del_row']))
		{
			$this->data_model->del_data('apbdes',$_POST['del_row']);
			if(!empty($par_id))
			{
				header('Location: '.base_url('apbdes/apbdes_list/?id='.$par_id));
			}else{
				header('Location: '.base_url());
			}
		}
	}else{
		echo msg('data apbdes untuk tahun '.$tahun.' belum ada','warning');
		?>
		<form action="" method="post">
			<button class="btn btn-success" name="new" value="1">
				<i class="fa fa-file"></i> buat baru
			</button>
		</form>
		<?php
		if(!empty($_POST['new']))
		{
			$data = array('PENDAPATAN','BELANJA','PEMBIAYAAN');
			foreach ($data as $key => $value)
			{
				$this->data_model->set_data('apbdes',0,array('uraian'=>$value,'tahun'=>$tahun,'user_id'=>user('id')));
				$last_id = $this->data_model->LAST_INSERT_ID();
				if(!empty($last_id))
				{
					$this->data_model->set_data('apbdes',$last_id,array('jenis'=>$last_id));
				}
			}
			header('Location: '.base_url());
		}
	}
}