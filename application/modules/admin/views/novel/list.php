<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form method="get" action="<?php echo base_url('admin/novel_list') ?>" class="form-inline pull-right">
	<input type="text" name="keyword" class="form-control" placeholder="keyword" value="<?php echo @$_GET['keyword'] ?>">
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
<form method="post" action="<?php echo base_url('admin/novel_list'); ?>">
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>TITLE</th>
					<th>CREATED</th>
					<th>
						<div class="checkbox">
							<label>
								<input id="selectAllPub" type="checkbox">PUBLISH
							</label>
						</div>
					</th>
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
						<tr data-id="<?php echo $value['id'] ?>">
							<input type="hidden" name="id[]" value="<?php echo $value['id'] ?>">
							<td><a href="<?php echo base_url('admin/novel_edit/'.$value['id']) ?>"><?php echo $value['id'] ?></a></td>
							<td><a href="<?php echo base_url('admin/novel_edit/'.$value['id']) ?>"><?php echo $value['title'] ?></a></td>
							<td><?php echo nice_date($value['created'], 'Y/m/d'); ?></td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="pub_check" name="pub_chapter[]" value="<?php echo $value['id']; ?>" <?php echo !empty($value['publish']) ? 'checked':''; ?>> Publish
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="del_check" name="del_chapter[]" value="<?php echo $value['id']; ?>"> <span class="glyphicon glyphicon-trash"></span>
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
					<td colspan="3">
						<?php
						 echo $pagination;
						 ?>
					</td>
					<td>
						<button type="submit" name="publish" value="1" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-floppy-disk"></span> PUBLISH
						</button>
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