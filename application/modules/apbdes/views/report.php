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
	<div class="panel panel-success">
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
				<input type="number" name="tahun" class="form-control" max="<?php echo date('Y') ?>" min="1990" placeholder="tahun" required>
			</div>
			<div class="col-md-2">
				<button class="btn btn-success"><span class="fa fa-search"></span> Submit</button>
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

}
?>