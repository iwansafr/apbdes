<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=APBDES.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


if(!empty($this->input->post()))
{
	$tahun = $this->input->post('tahun');

	// $parent = $this->db->get_where('apbdes', 'par_id = 0')->result_array();
	// pr($parent);
	$data = $this->esg->get_data('apbdes','tahun = '.$tahun.' AND par_id = ', 0);
	$pemdes = $this->esg->get_config('pemdes');

	$this->db->select('id,title');
	$data_ket = $this->db->get_where('apbdes_ket')->result_array();
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
						$value['no'] = !empty($no) ? $no.'.'.$value['no'] : $value['no'];
						?>
						<tr>
							<td><?php echo $value['no'] ?>.</td>
							<td><?php echo $value['uraian'] ?></td>
							<td><?php echo !empty($value['anggaran']) ? 'Rp.'.number_format($value['anggaran'],2,',','.') : '-'; ?></td>
							<td align="center"><?php echo get_ket($value['apbdes_ket_id'], $source) ?></td>
						</tr>
						<?php
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
							if(@intval($data[$key+1]['no']) < $_SESSION['uraian']['no'])
							{
								?>
								<tr>
									<td colspan="2" align="center">JUMLAH <?php echo $_SESSION['uraian']['title'] ?></td>
									<td><?php echo 'Rp.'.number_format($_SESSION['uraian']['total'],2,',','.') ?></td>
									<td></td>
								</tr>
								<?php
							}
						}
					}
				}
			}
		}

		?>
		<div id="report">
			<table style="width: 50%; margin-left: 50%;">
				<tr>
					<td colspan="3">LAMPIRAN PERATURAN DESA <?php echo strtoupper($pemdes['desa']) ?></td>
				</tr>
				<tr>
					<td>NOMOR </td>
					<td>&nbsp;:&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>TANGGAL&nbsp;</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php echo date('d').' '.date('M').' '.$_POST['tahun'] ?></td>
				</tr>
				<tr>
					<td valign="top">TENTANG </td>
					<td valign="top">&nbsp;:&nbsp;</td>
					<td>ANGGARAN PENDAPATAN DAN BELANJA DESA (APBDES) TAHUN ANGGARAN <?php echo $_POST['tahun'] ?></td>
				</tr>
			</table>

			<div class="top_apbdes" style="text-align: center;">
				<h5>LAMPIRAN PERATURAN DESA</h5>
				<h5>NOMOR&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;001</h5>
				<h5>TANGGAL&nbsp;:&nbsp;<?php echo date('d').' '.date('M').' '.$_POST['tahun'] ?></h5>
				<h5>TENTANG&nbsp;:&nbsp;ANGGARAN PENDAPATAN DAN BELANJA DESA (APBDES) TAHUN ANGGARAN <?php echo $_POST['tahun'] ?></h5>
			</div>
			<hr>
			<div class="table-responsive">
				<table id="tableapbdes" class="table table-bordered table-hover table-striped" border="1">
					<thead style="background: #cac6c6;">
						<tr>
							<th>KODE REKENING</th>
							<th>URAIAN</th>
							<th>ANGGARAN</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<?php report_apbdes($data,0,$ket);?>
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
	}
}