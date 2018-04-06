<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
$this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');

if(!empty($data_user))
{
	$user_value = $data_user['nama_siswa'];
	$user_email = $data_user['orang_tua'];
	// $user_role  = $data_user['role'];
}
if(!empty($data_user))
{
	// pr($data_user);
}
$nama_siswa = !empty(@intval($data_user['nama_siswa'])) ? $data_user['nama_siswa']: '';
$validate_error = validation_errors();
if(!empty($validate_error))
{
	msg($validate_error, 'danger');
}
?>
<?php echo form_open(base_url('admin/siswa_edit/'.$nama_siswa), 'id="siswa_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo !empty($id) ? 'Edit ' : 'Add '; echo ucfirst($module); ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<?php
			echo form_hidden('nama_siswa',$nama_siswa);
			echo form_label('orang_tua', 'orang_tua');
			echo form_input(array(
				'name'     => 'orang_tua',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$user_email));
			echo form_label('nama_siswa', 'nama_siswa');
			if($id>0)
			{
				echo form_label(@$user_value, @$user_value,array('class'=>'form-control'));
				echo form_hidden('nama_siswa',@$user_value);
			}else{
				echo form_input(array(
					'name'     => 'nama_siswa',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$user_value));
				echo '			<div id="user_error"></div>';
			}
			echo form_label('pekerjaan', 'pekerjaan');
			echo form_input(array(
				'name'     => 'pekerjaan',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$user_email));
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