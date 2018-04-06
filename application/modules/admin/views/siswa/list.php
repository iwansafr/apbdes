<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<a href="<?php echo base_url('admin/user_edit') ?>" class="btn btn-default">Add User</a>
<form method="get" action="<?php echo base_url('admin/user_list') ?>" class="form-inline pull-right">
	<input type="text" name="keyword" class="form-control" placeholder="keyword">
	<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
</form>
<hr>
<div class="clearfix"></div>
<?php
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
?>
<form method="post" action="<?php echo base_url('admin/user_list'); ?>">
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>nama siswa</th>
					<th>orang tua </th>
					<th>alamat</th>
					<th>pekerjaan</th>
					<th>
						<div class="checkbox">
							<label>
								<input id="selectAllDel" type="checkbox">DELETE
							</label>
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($data))
				{
					foreach ($data as $key => $value)
					{
						?>
						<tr data-id="<?php echo $value['nama_ssiwa'] ?>">
							<td><?php echo $value['orang_tua'] ?></td>
							<td><a href="<?php echo base_url('admin/user_edit/'.$value['nama_siswa']) ?>"><?php echo $value['nama_siswa'] ?></a></td>
							<td><?php echo $value['alamat'] ?></td>
							<td><?php echo $value['pekerjaan'] ?></td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="del_check" name="del_user[]" value="<?php echo $value['nama_siswa']; ?>"> <span class="glyphicon glyphicon-trash"></span>
									</label>
								</div>
							</td>
						</tr>
						<?php
					}
				}else{
					?>
					<tr>
						<td colspan="5"><?php msg('data kosong', 'danger'); ?></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="4">
						<?php
						 echo $pagination;
						 ?>
					</td>
					<td>
						<button type="submit" name="delete" value="1" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span> DELETE
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>