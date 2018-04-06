<?php
$variable = array('text','number','dropdown','textarea','radio','file');
pr($this->input->post());
$saved_config = json_encode($this->input->post());
pr($saved_config);
pr($this->session->userdata());
if(empty($this->input->post()))
{
	?>
	<form action="" method="post">
		<div class="panel-default">
			<div class="panel-heading">
				<h3>make a form</h3>
			</div>
			<div class="panel-body">
				<template id="field_tpl">
					<div class="row">
						<br>
						<div class="col-md-4">
							<input type="text" name="name[]" class="form-control" placeholder="name" required>
						</div>
						<div class="col-md-2">
							<select class="form-control type_option" name="type[]" required>
								<?php
								foreach ($variable as $key => $value)
								{
									echo '<option value="'.$value.'">'.$value.'</option>';
								}
								?>
							</select>
						</div>
						<a href="#" style="text-decoration: none; color: red;" class="del_field"><span><i class="fa fa-trash"></i></span></a>
					</div>
				</template>
				<div class="element">
					<div class="row">
						<div class="col-md-3">
							<input type="text" name="title" class="form-control" placeholder="form name" required>
							<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<input type="text" name="name[]" class="form-control" placeholder="name" required>
						</div>
						<div class="col-md-2">
							<select class="form-control type_option" name="type[]" required>
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
			</div>
			<div class="panel-footer">
				<span class="pull-right">
					supported by : esoftgreat
				</span>
			</div>
		</div>
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
				return false;
			});
			$(document).on('click', '.del_field', function(){
				console.log('ah');
				$(this).closest('.row').remove();
				return false;
			});
			$(document).on('change','.type_option', function(){
				var a = $(this).val();
				if(a == 'dropdown'){
					$(this).closest('.row').append('<div class="col-md-4 text_area"><textarea class="form-control" name="option[]" placeholder="option1,option2,option2"></textarea></div>');
				}else{
					$(this).closest('.row').find('.text_area').remove();
				}
			});
		});
	</script>
	<?php
	$ext = ob_get_contents();
	ob_end_clean();
	$this->session->set_userdata('js_extra', $ext);
	// $this->session->set_userdata('link_js', base_url().'templates/land_page/js/script.js');
}else{
	// $title = $this->input->post('title');
	// $data_field[] = array();
	// foreach ($this->input->post('type') as $key => $value)
	// {
	// 	switch ($value)
	// 	{
	// 		case 'text':
	// 			$data_field[$key]['type'] = 'VARCHAR(255) NOT NULL';
	// 			break;
	// 		case 'number':
	// 			$data_field[$key]['type'] = 'INT(11) NOT NULL';
	// 			break;
	// 		case 'textarea':
	// 			$data_field[$key]['type'] = 'TEXT NOT NULL';
	// 			break;
	// 		default:
	// 			$data_field[$key]['type'] = 'VARCHAR(255) NOT NULL';
	// 			break;
	// 	}
	// 	$data_field[$key]['name'] = $_POST['name'][$key];
	// }
	// pr($data_field);
	// $add_sql = array();
	// foreach ($data_field as $key => $value)
	// {
	// 	$add_sql[] = $value['name'].' '.$value['type'];
	// }
	// if(!empty($add_sql))
	// {
	// 	$add_sql = implode(',', $add_sql);
	// 	$add_sql = ','.$add_sql;
	// }
	// $sql = "CREATE TABLE `$title` (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY {$add_sql})";
	// pr($sql);
	// $this->db->query($sql);
	// echo msg('form created successfully', 'success');
}