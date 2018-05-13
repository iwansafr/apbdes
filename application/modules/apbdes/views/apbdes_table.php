<form action="" method="get">
	<input type="number" name="year" class="form-control" placeholder="tahun">
</form>
<?php
$pemdes = $this->esg->get_config('pemdes');
if(!empty($this->input->get('year')))
{
	$tahun = $this->input->get('year');

	// $parent = $this->db->get_where('apbdes', 'par_id = 0')->result_array();
	// pr($parent);
	$data = $this->esg->get_data('apbdes',"created LIKE '$tahun%' AND par_id = ", 0);

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
						if(!empty($value['percent']) && !empty($value['apbdes_id']))
						{
							$anggaran = ($value['percent']/100)*@intval($_SESSION['apbdes']['anggaran'][$value['apbdes_id']]);
							$value['anggaran'] = $anggaran;
						}
						?>
						<tr>
							<td><?php echo $value['no'] ?>.</td>
							<td><?php echo $value['uraian'] ?></td>
							<td><?php echo !empty($value['anggaran']) ? 'Rp.'.number_format($value['anggaran'],2,',','.') : '-'; ?></td>
							<td align="center"><?php echo get_ket($value['apbdes_ket_id'], $source) ?></td>
							<td><a href="#" class="edit_apbdes"><i class="fa fa-pencil"></i></a></td>
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
							if(@intval($data[$key+1]['no']) < $_SESSION['uraian']['no'])
							{
								?>
								<tr>
									<td colspan="2" align="center">JUMLAH <?php echo $_SESSION['uraian']['title'] ?></td>
									<td><?php echo 'Rp.'.number_format($_SESSION['uraian']['total'],2,',','.') ?></td>
									<td colspan="2"></td>
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
			<hr>
			<div class="table-responsive">
				<table id="tableapbdes" class="table table-bordered table-hover table-striped">
					<thead style="background: #cac6c6;">
						<tr style="border: 1px solid black;">
							<th>KODE REKENING</th>
							<th>URAIAN</th>
							<th>ANGGARAN</th>
							<th>KETERANGAN</th>
							<th>edit</th>
						</tr>
					</thead>
					<?php report_apbdes($data,0,$ket);?>
				</table>
			</div>
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