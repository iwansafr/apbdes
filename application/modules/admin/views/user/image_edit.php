<?php defined('BASEPATH') OR exit('No direct script access allowed');
pr($data_user);
if(!empty($_FILES))
{
	pr($_FILES);
}
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
if(!empty($validate_error))
{
	msg($validate_error, 'danger');
}
$id = @intval($data_user['id']);
if(!empty($id))
{
	echo form_open_multipart(base_url('admin/user_image_edit/'.$id), 'id="user_image_edit"');?>
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4 class="panel-title">
					Edit Image
				</h4>
			</div>
			<div class="panel panel-body">
				<label>Photo Profil</label>
				<div class="image">
					<img src="<?php echo image_module('user',$id.'/'.$data_user['image']); ?>" class="img-responsive" width="200">
				</div>
				<hr>
				<?php
				echo form_label('image','image');
				echo form_upload(array(
					'name'  => 'image',
					'class' => 'form-control'));
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
	<?php echo form_close();
}