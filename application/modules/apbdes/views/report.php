<?php
$pemdes = $this->esg->get_config('pemdes');
if(!empty($pemdes))
{
	$tahun = $pemdes['tahun'];
	$data  = $this->esg->get_data('apbdes',"tahun={$tahun} AND par_id = ", 0);
	$this->db->select('id,alias_ket AS title');
	$data_ket = $this->db->get_where('apbdes','is_ket = 1')->result_array();
	$ket      = array();

	foreach ($data_ket as $dkkey => $dkvalue)
	{
		$ket[$dkvalue['id']] = $dkvalue['title'];
	}

	if(!function_exists('get_ket'))
	{
		function get_ket($value = '', $source = array())
		{
			$data = array();
			if(!empty($value))
			{
				$tmp = explode(',',$value);
				$tmp = array_filter($tmp);
				foreach ($tmp as $skey => $svalue)
				{
					$data[] = $source[$svalue];
				}
				$data = implode('+',$data);
			}
			if(!empty($data))
			{
				return $data;
			}
		}
	}

	if(!function_exists('report_apbdes'))
	{
		function report_apbdes($data = array(), $no = 0, $source = array())
		{
			if(!empty($data) && is_array($data))
			{
				foreach ($data as $key => $value)
				{
					if(!empty($value))
					{
						$value['no'] = !empty($no) ? $no.'.'.$value['no'] : @intval($value['no']);
						$count_no = $value['no'];
						$count_no = explode('.',$count_no);
						$count_no = count($count_no);
						if($count_no > 4)
						{
							$value['no'] = '';
						}
						if(!empty($value['percent']) && !empty($value['apbdes_id']))
						{
							$anggaran = ($value['percent']/100)*@intval($_SESSION['apbdes']['anggaran'][$value['apbdes_id']]);
							$value['anggaran'] = $anggaran;
						}
						$weight = $value['level'] < 3 ? 'style="font-weight: 1000;"' : 'style="font-weight: 500;"';
						$ket    = !empty($value['is_ket']) ? $value['alias_ket'] : get_ket($value['apbdes_ids'], $source);
						?>
						<tr>
							<td><?php echo $value['no'] ?></td>
							<td <?php echo $weight ?>><?php echo $value['uraian'] ?></td>
							<td>
								<?php
								if($value['level']>1){
									echo !empty($value['anggaran']) ? 'Rp.'.number_format($value['anggaran'],2,',','.') : '-';
								}
								?>
							</td>
							<td align="center">
								<?php echo $value['level']>1 ? $ket :''; ?>
								<a href="<?php echo base_url('apbdes?id='.$value['id']) ?>" class="edit_anggaran">
									<button type="button" class="btn btn-default btn-xs" style="position: absolute;right: 2%;">
									  <i class="fa fa-pencil"></i>
									</button>
								</a>
							</td>
						</tr>
						<?php
						if(!empty($value['child']))
						{
							call_user_func(__FUNCTION__, $value['child'], $value['no'], $source);
						}
						if($value['level'] == 1)
						{
							if($value['uraian'] == 'PENDAPATAN')
							{
								$_SESSION['total_pendapatan'] = $value['anggaran'];
							}
							?>
							<tr>
								<td colspan="2" align="center">JUMLAH <?php echo $value['uraian'] ?></td>
								<td><?php echo 'Rp.'.number_format($value['anggaran'],2,',','.') ?></td>
								<td></td>
							</tr>
							<?php
							if($value['uraian'] == 'BELANJA')
							{
								?>
								<tr>
									<td colspan="2" align="center">SURPLUS/DEFISIT</td>
									<td><?php echo 'Rp.'.number_format(@intval($_SESSION['total_pendapatan'])-$value['anggaran'],2,',','.') ?></td>
									<td></td>
								</tr>
								<?php
							}
							unset($_SESSION['total_pendapatan']);
						}
					}
				}
			}
		}?>
		<div class="row">
			<div class="col-md-1">
				<button id="print_report" class="btn btn-default" ><span class="fa fa-print"></span> print</button>
			</div>
			<div class="col-md-2">
				<form action="<?php echo base_url('apbdes/excel') ?>" method="post">
					<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
					<button id="export_excel" class="btn btn-default" ><span class="fa fa-file-o"></span> export excel</button>
				</form>
			</div>
			<div class="col-md-1">
				<form action="" method="post">
					<button class="btn btn-default">
						<span class="fa fa-refresh"></span>
						refresh
					</button>
				</form>
			</div>
		</div>
		<hr>
		<div id="report">
			<table style="width: 40%; margin-left: 60%;">
				<tr>
					<td colspan="3">LAMPIRAN PERATURAN DESA <?php echo strtoupper($pemdes['desa']) ?></td>
				</tr>
				<tr>
					<td>NOMOR </td>
					<td>&nbsp;:&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>TAHUN&nbsp;</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php echo $tahun ?></td>
				</tr>
				<tr>
					<td valign="top">TENTANG </td>
					<td valign="top">&nbsp;:&nbsp;</td>
					<td>ANGGARAN PENDAPATAN DAN BELANJA DESA (APBDES) TAHUN ANGGARAN <?php echo $tahun ?></td>
				</tr>
			</table>
			<br>
			<table style="width: 100%; text-align: center; font-size: 18px;">
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td>ANGGARAN PENDAPATAN DAN BELANJA DESA</td>
				</tr>
				<tr>
					<td>PEMERINTAHAN DESA <?php echo strtoupper($pemdes['desa']) ?></td>
				</tr>
				<tr>
					<td>TAHUN ANGGARAN <?php echo $tahun ?></td>
				</tr>
			</table>
			<hr>
			<div class="table-responsive">
				<table id="tableapbdes" class="table table-bordered table-hover table-striped">
					<thead style="background: #cac6c6;">
						<tr style="border: 1px solid black;">
							<th>KODE REKENING</th>
							<th>URAIAN</th>
							<th>ANGGARAN</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<?php
					// pr($data);
					report_apbdes($data,0,$ket);
					?>
				</table>
			</div>
			<hr>
			<table style="width: 50%; margin-left: 60%">
				<tr>
					<td align="center">DISETUJUI OLEH </td>
				</tr>
				<tr>
					<td colspan="2" align="center">KEPALA DESA BANGSRI</td>
				</tr>
				<tr>
					<td colspan="2" height="50">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" align="center">(<?php echo $pemdes['kep_des'] ?>)</td>
				</tr>
			</table>
			<hr>
		</div>
		<?php
		$ext = array();
		ob_start();
		?>
		<script type="text/javascript">
			$('#print_report').on('click', function(){
				w = window.open();
				$('.edit_anggaran').remove();
				w.document.write($('#report').html());
				w.print();
				w.close();
			});
		</script>
		<?php
		$ext = ob_get_contents();
		ob_end_clean();
		$this->session->set_userdata('js_extra', $ext);
	}
}