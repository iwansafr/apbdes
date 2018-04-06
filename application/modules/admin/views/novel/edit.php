<?php defined('BASEPATH') OR exit('No direct script access allowed');
$id      = !empty($data['id']) ? $data['id'] : '';
$publish = isset($data['publish']) ? $data['publish'] : 1;
$editable = isset($data['editable']) ? $data['editable'] : 0;

if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
// pr(@$_FILES);
// pr($_FILES['image']['name']);
// pr(@$this->input->post());
// pr($data);
// pr($novel);
$this->session->__set('link_js', base_url().'templates/admin/js/bootstrap-tagsinput.js');
?>
<?php echo form_open_multipart(base_url('admin/novel_edit/'.$id), 'id="novel_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo !empty($id) ? 'Edit' : 'Add'; echo ' Article'; ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<br>
			<?php
			echo form_hidden('id',$id);
			echo form_label('Novel', 'novel');
			echo form_dropdown(array(
				'name'     => 'novel_id',
				'class'    => 'form-control',
				'options'  => $novel,
				'selected' => @$data['novel_id']
			));
			echo form_label('Title', 'title');
			echo form_input(array(
				'name'     => 'title',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$data['title']));

			echo form_label('Content', 'content');
			echo form_textarea(array(
				'name'  => 'content',
				'id'    => 'textckeditor',
				'class' => 'form-control',
				'value' => @$data['content']));

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

			echo form_label('Editable', 'editable');
			echo '<div class="checkbox">';
			echo '<label>';
			echo form_checkbox(array(
				'name' => 'editable',
				'value'=> 'editable',
				'checked' => $editable
				)).' Editable';
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
	<script type="text/javascript">
		CKEDITOR.replace('textckeditor');
	</script>
<?php echo form_close();