<?php
$bulan = array(
	'01' => 'Januari',
	'02' => 'Februari',
	'03' => 'Maret',
	'04' => 'April',
	'05' => 'Mei',
	'06' => 'Juni',
	'07' => 'Juli',
	'08' => 'Agustus',
	'09' => 'September',
	'10' => 'Oktober',
	'11' => 'November',
	'12' => 'Desember',
);
?>
<form method="post">
	<div class="panel panel-primary">
		<div class="panel-heading">
			APBDES BULANAN
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<select class="form-control" name="bulan">
					<?php
					foreach ($bulan as $key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<input type="number" name="tahun" class="form-control" max="<?php echo date('Y') ?>" min="1990" placeholder="tahun" no>
			</div>
			<div class="col-md-2">
				<button class="btn btn-primary"><span class="fa fa-search"></span> Submit</button>
			</div>
		</div>
	</div>
</form>

<?php
if(!empty($this->input->post()))
{
	$bulan = $this->input->post('bulan');
	$tahun = $this->input->post('tahun');

	// $parent = $this->db->get_where('apbdes', 'par_id = 0')->result_array();
	// pr($parent);
	$data = $this->esg->get_data('apbdes','bulan = '.$bulan.' AND tahun = '.$tahun.' AND par_id = ', 0);

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
		<button id="print_report" class="btn btn-default" ><span class="fa fa-print"></span> print</button>
		<button id="export_excel" class="btn btn-default" ><span class="fa fa-file-o"></span> export excel</button>
		<hr>
		<div id="report">
			<table style="width: 50%; margin-left: 50%;">
				<tr>
					<td colspan="3">LAMPIRAN PERATURAN DESA BANGSRI</td>
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
			<hr>
			<div class="table-responsive">
				<table id="tableapbdes" class="table table-bordered table-hover table-striped">
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
					<td colspan="2" align="center">(KEPALA DESA)</td>
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
				w.document.write($('#report').html());
				w.print();
				w.close();
			});

			function export_excel()
			{
		    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
		    var textRange; var j=0;
		    tab = document.getElementById('tableapbdes'); // id of table
		    for(j = 0 ; j < tab.rows.length ; j++)
		    {
	        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
	        //tab_text=tab_text+"</tr>";
		    }
		    tab_text = tab_text+"</table>";
		    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
		    tab_text = tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
		    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
		    var ua   = window.navigator.userAgent;
		    var msie = ua.indexOf("MSIE ");
		    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
		    {
	        txtArea1.document.open("txt/html","replace");
	        txtArea1.document.write(tab_text);
	        txtArea1.document.close();
	        txtArea1.focus();
	        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
		    }else{
	        sa = window.open('data:application/vnd.ms-excel,Content-Disposition: attachment:filename:data_apbdes.xls,' + encodeURIComponent(tab_text));
		    }
		    return (sa);
			}
			$('#export_excel').on('click',function(){
				// export_excel();
			});
		</script>
		<?php
		$ext = ob_get_contents();
		ob_end_clean();
		$this->session->set_userdata('js_extra', $ext);
	}
}
?>