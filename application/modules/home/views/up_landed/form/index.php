<?php
$variable = array('-type-','text','number','dropdown','textarea','radio','file');
pr($this->input->post());
?>
<form action="" method="post">
	<h3>make a form</h3>
	<template id="field_tpl">
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="name[]" class="form-control" placeholder="name">
			</div>
			<div class="col-md-2">
				<select class="form-control" name="type[]">
					<?php
					foreach ($variable as $key => $value)
					{
						echo '<option value="'.$value.'">'.$value.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</template>
	<div class="element">
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="title" class="form-control" placeholder="title"><hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="name[]" class="form-control" placeholder="name">
			</div>
			<div class="col-md-2">
				<select class="form-control" name="type[]">
					<?php
					foreach ($variable as $key => $value)
					{
						echo '<option value="'.$value.'">'.$value.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<br>
	<a href="#" class="btn btn-default" id="add_field"><i class="fa fa-plus"></i> add field</a>
	<hr>
	<button class="btn btn-default button special">Submit</button>
</form>

<?php
$ext = array();
ob_start();
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add_field').on('click', function(){
			var a = $('#field_tpl').html();
			$('.element').append(a);
		});
	});
</script>
<?php
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_extra', $ext);
// $this->session->set_userdata('link_js', base_url().'templates/land_page/js/script.js');