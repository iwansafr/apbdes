<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=APBDES.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

if(!empty($this->input->post()))
{
	$pemdes = $this->esg->get_config('pemdes');
	$tahun  = $this->input->post('tahun');
	$data   = $this->esg->get_data('apbdes',"tahun={$tahun} AND par_id = ", 0);
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
						if(!empty($value['percent']) && !empty($value['apbdes_id']))
						{
							$anggaran = ($value['percent']/100)*@intval($_SESSION['apbdes']['anggaran'][$value['apbdes_id']]);
							$value['anggaran'] = $anggaran;
						}
						$weight = $value['level'] < 3 ? 'style="font-weight: 1000;"' : 'style="font-weight: 500;"';
						$ket    = !empty($value['is_ket']) ? $value['alias_ket'] : get_ket($value['apbdes_ids'], $source);
						?>
						<tr>
							<td><?php echo $value['no'] ?>.</td>
							<td <?php echo $weight ?>><?php echo $value['uraian'] ?></td>
							<td><?php echo !empty($value['anggaran']) ? 'Rp.'.number_format($value['anggaran'],2,',','.') : '-'; ?></td>
							<td align="center">
								<?php echo $ket ?>
							</td>
						</tr>
						<?php

						if(!empty($value['anggaran']))
						{
							$_SESSION['apbdes']['anggaran'][$value['id']] = $value['anggaran'];
						}
						if(empty($no))
						{
							$_SESSION['uraian'] = array();
							$_SESSION['uraian']['title'] = $value['uraian'];
							$_SESSION['uraian']['no']    = $value['no'];
							$_SESSION['uraian']['total'] = 0;
						}
						$_SESSION['uraian']['total'] = $_SESSION['uraian']['total']+$value['anggaran'];
						if(!empty($value['child']))
						{
							call_user_func(__FUNCTION__, $value['child'], $value['no'], $source);
						}else{
							// if(@intval($data[$key+1]['no']) < $_SESSION['uraian']['no'])
							// {
								?>
							<!-- 	<tr>
									<td colspan="2" align="center">JUMLAH <?php echo $_SESSION['uraian']['title'] ?></td>
									<td><?php echo 'Rp.'.number_format($_SESSION['uraian']['total'],2,',','.') ?></td>
									<td></td>
								</tr> -->
								<?php
							// }
						}
					}
				}
			}
		}
	}
	?>
	<div id="report">
		<table style="width: 40%; margin-left: 60%;">
			<tr>
				<td colspan="2"></td>
				<td colspan="2">LAMPIRAN PERATURAN DESA <?php echo strtoupper($pemdes['desa']) ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="float: left">NOMOR <span style="text-align: right">:</span></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td>TAHUN &nbsp;:&nbsp;</td>
				<td><?php echo $tahun ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td valign="top">TENTANG &nbsp;:&nbsp;</td>
				<td>ANGGARAN PENDAPATAN DAN BELANJA DESA (APBDES) TAHUN ANGGARAN <?php echo $tahun ?></td>
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
				<td colspan="2"></td>
				<td align="center" colspan="2">DISETUJUI OLEH </td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="2" align="center">KEPALA DESA BANGSRI</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="2" height="50">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="2" align="center">(<?php echo $pemdes['kep_des'] ?>)</td>
			</tr>
		</table>
		<hr>
	</div>
	<?php
}