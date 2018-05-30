<?php
$pemdes = $this->esg->get_config('pemdes');
$tahun  = @intval($pemdes['tahun']);
$this->db->select('id,alias_ket,anggaran');
$income                = $this->db->get_where('apbdes',"is_ket = 1 AND tahun = {$tahun}")->result_array();
$id_pemerintahan       = $this->data_model->get_one('bidang','id',"WHERE title = 'pemerintahan'");
$add_id                = $this->data_model->get_one('apbdes','id'," WHERE tahun = {$tahun} AND alias_ket = 'ADD'");
$add_pemerintahan_sisa = 0;

if(!empty($id_pemerintahan))
{
	$anggaran_add = $this->data_model->get_one('apbdes','anggaran',"WHERE level = 2 AND tahun = {$tahun} AND bidang_id = {$id_pemerintahan}");
	$apbdes_ids   = $this->data_model->get_one('apbdes','apbdes_ids',"WHERE level = 2 AND tahun = {$tahun} AND bidang_id = {$id_pemerintahan}");
	if(!empty($apbdes_ids))
	{
		$apbdes_ids   = string_to_array($apbdes_ids);
		foreach ($apbdes_ids as $key => $value)
		{
			if($value != $add_id)
			{
				$this->db->select('anggaran');
				$anggaran_non_add[] = $this->db->get_where('apbdes',"tahun = {$tahun} AND bidang_id = {$id_pemerintahan} AND apbdes_ids = ',{$value},' AND is_parent = 0")->result_array();
			}
		}


		$for_minus_add = 0;
		if(!empty($anggaran_non_add))
		{
			$anggaran_non_add = $anggaran_non_add[0];
			foreach ($anggaran_non_add as $key => $value)
			{
				$for_minus_add += $value['anggaran'];
			}
		}
		$anggaran_add = $anggaran_add-$for_minus_add;
	}
}
$max_add = 0;
if(!empty($income))
{
	if(!empty($income))
	{
		foreach ($income as $key => $value)
		{
			?>
			<div class="col-md-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
				    	<div class="col-xs-3">
				        <i class="fa fa-bar-chart fa-2x"></i>
				      </div>
				      <div class="col-xs-9 text-right">
				        <div style="color: white; font-size: 12px;"><?php echo !empty($value['anggaran']) ? 'Rp.'.number_format($value['anggaran'],2,',','.') : '-'; ?></div>
				        <div style="color: orange"><?php echo $value['alias_ket'] ?></div>
				      </div>
				  	</div>
					</div>
					<a href="<?php echo base_url('apbdes/?id='.$value['id']) ?>">
			      <div class="panel-footer">
			        <span class="pull-left">View Details</span>
			        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			        <div class="clearfix"></div>
			      </div>
			    </a>
				</div>
			</div>
			<?php
			if($value['alias_ket'] == 'ADD')
			{
				$percent = 0;
				$min = 0;
				if($value['anggaran'] < 500000000){
					$percent = 60;
				}else if($value['anggaran'] >=500000000 && $value['anggaran'] <= 700000000){
					$percent = 50;
					$min = 300000000;
				}else if($value['anggaran'] >700000000 && $value['anggaran'] <= 900000000){
					$percent = 40;
					$min = 350000000;
				}
				else if($value['anggaran'] >900000000){
					$percent = 30;
					$min = 360000000;
				}
				$anggaran = $value['anggaran']*$percent/100;
				$max_add  = $anggaran;
				?>
				<div class="col-md-2">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
					    	<div class="col-xs-3">
					        <i class="fa fa-bar-chart fa-2x"></i>
					      </div>
					      <div class="col-xs-9 text-right">
					      	<?php
					      	if(!empty($min))
					      	{
						      	?>
						        <div style="font-size: 12px;">Min <?php echo !empty($anggaran) ? 'Rp.'.number_format($min,2,',','.') : 'Rp.-'; ?></div>
										<?php
					      	}?>
					        <div style="font-size: 12px;">Max <?php echo !empty($anggaran) ? 'Rp.'.number_format($anggaran,2,',','.') : 'Rp.-'; ?></div>
					        <div><?php echo $percent.'% '.$value['alias_ket'] ?></div>
					      </div>
					  	</div>
						</div>
						<a href="<?php echo base_url('apbdes/?id='.$value['id']) ?>">
				      <div class="panel-footer">
				        <span class="pull-left">View Details</span>
				        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				        <div class="clearfix"></div>
				      </div>
				    </a>
					</div>
				</div>
				<?php
			}
		}
	}

	if(!empty($anggaran_add))
	{
		$class = @intval($max_add) < ($anggaran_add) ? 'danger' : 'warning';
		?>
		<div class="col-md-2">
			<div class="panel panel-<?php echo $class?>">
				<div class="panel-heading">
					<div class="row">
			    	<div class="col-xs-3">
			        <i class="fa fa-bar-chart fa-2x"></i>
			      </div>
			      <div class="col-xs-9 text-right">
			        <div style="font-size: 12px;"><?php echo 'Rp.'.number_format($anggaran_add,2,',','.'); ?></div>
			        <div ><?php echo 'MAX ADD terpakai'; ?></div>
			      </div>
			  	</div>
				</div>
				<a href="#">
		      <div class="panel-footer">
		        <span class="pull-left">View Details</span>
		        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		        <div class="clearfix"></div>
		      </div>
		    </a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<?php
				if(@intval($max_add) < ($anggaran_add))
				{
					echo msg('pengguanan ADD pada bidang pemerintahan telah melebihi batas maximal silahkan olah kembali','danger');
				}?>
			</div>
		</div>
		<?php
		$add_pemerintahan_sisa             = @intval($max_add) - @intval($anggaran_add);
		$_SESSION['add_pemerintahan_sisa'] = $add_pemerintahan_sisa;
		if(!empty($add_pemerintahan_sisa))
		{
			?>
			<div class="col-md-2">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
				    	<div class="col-xs-3">
				        <i class="fa fa-bar-chart fa-2x"></i>
				      </div>
				      <div class="col-xs-9 text-right">
				        <div style="font-size: 12px;"><?php echo 'Rp.'.number_format($add_pemerintahan_sisa,2,',','.'); ?></div>
				        <div ><?php echo 'MAX ADD tersisa'; ?></div>
				      </div>
				  	</div>
					</div>
					<a href="#">
			      <div class="panel-footer">
			        <span class="pull-left">View Details</span>
			        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			        <div class="clearfix"></div>
			      </div>
			    </a>
				</div>
			</div>
			<?php
		}
	}
}