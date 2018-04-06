<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}

$id         = !empty(@intval($data['id'])) ? $data['id'] : '';
$par_id     = @intval($data['par_id']);
$publish    = isset($data['publish']) ? $data['publish'] : 1;
$pagination = $data_list['pagination'];
$cat_list   = $data_list['data_list'];
?>
<div class="col-md-4">
	<?php echo form_open_multipart(base_url('admin/novel_category/'.$id), 'id="cat_edit"');?>
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4 class="panel-title">
					<?php echo !empty($id) ? 'Edit' : 'Add'; echo ' Category'; ?>
				</h4>
			</div>
			<div class="panel panel-body">
				<?php
				echo form_hidden('id',$id);
				echo form_label('Parent', 'parent');
				echo form_dropdown(array(
					'name'     => 'par_id',
					'class'=>'form-control',
					'options' => $parent,
					'selected'=> $par_id));
				echo form_label('Title', 'title');
				echo form_input(array(
					'name'     => 'title',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$data['title']));
				echo '			<div id="title_error"></div>';
				echo form_label('description', 'description');
				echo form_textarea(array(
					'name'  => 'description',
					'class' => 'form-control',
					'rows'  => '2',
					'value' => @$data['description']));

				echo form_label('Publish', 'publish');
				echo '<div class="checkbox">';
				echo '<label>';
				echo form_checkbox(array(
					'name' => 'publish',
					'value'=> 'publish',
					'checked' => $publish
					)).' Published';
				echo '</label>';
				echo '</div>';
				?>
			</div>
			<div class="panel panel-footer">
				<?php
				echo form_button(array(
	        'name'    => 'submit',
	        'id'      => 'submit',
	        'value'   => 'true',
	        'type'    => 'success',
	        'content' => 'submit',
	        'class'   => 'btn btn-success'));
				echo form_button(array(
	        'name'    => 'reset',
	        'id'      => 'reset',
	        'value'   => 'true',
	        'type'    => 'reset',
	        'content' => 'reset',
	        'class'   => 'btn btn-warning'));
				?>
			</div>
		</div>
	<?php echo form_close();?>
</div>
<div class="col-md-8">
	<form method="get" action="<?php echo base_url('admin/novel_category') ?>" class="form-inline pull-right">
		<input type="text" name="keyword" class="form-control" placeholder="keyword" value="<?php echo @$_GET['keyword'] ?>">
		<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
	</form>
	<hr>
	<div class="clearfix"></div>
	<form method="post" action="<?php echo base_url('admin/novel_category'); ?>">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>title</th>
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
					if(!empty($cat_list))
					{
						foreach ($cat_list as $key => $value)
						{
							?>
							<tr data-id="<?php echo $value['id'] ?>">
								<input type="hidden" name="id[]" value="<?php echo $value['id'] ?>">
								<td><a href="<?php echo base_url('admin/novel_category/'.$value['id']) ?>"><?php echo $value['title'] ?></a></td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" class="pub_check" name="pub_check[]" value="<?php echo $value['id']; ?>" <?php echo !empty($value['publish']) ? 'checked':''; ?>> Publish
										</label>
									</div>
								</td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" class="del_check" name="del_check[]" value="<?php echo $value['id']; ?>"> <span class="glyphicon glyphicon-trash"></span>
										</label>
									</div>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="3"><?php msg('data kosong', 'danger'); ?></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td colspan="1">
							<?php
							 echo $pagination;
							 ?>
						</td>
						<td>
							<button type="submit" name="publish_list" value="1" class="btn btn-success btn-sm">
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
</div>