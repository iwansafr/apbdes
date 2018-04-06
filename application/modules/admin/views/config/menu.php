<?php $data = json_decode($config['value'], 1);
pr($_POST);
?>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open_multipart(base_url('admin/config_menu/menu'), 'id="conf_site"');?>
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4 class="panel-title">
					<?php echo 'Menu Configuration';?>
				</h4>
			</div>
			<div class="panel panel-body">
				<?php
				echo form_label('Menu 1 Text', 'menutext[]');
				echo form_input(array(
					'name'     => 'menutext[]',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$data['menu1text']));
				echo form_label('Menu 1 Url', 'menu1url');
				echo form_input(array(
					'name'     => 'menuurl[]',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$data['menu1url']));
				echo form_label('Menu 2 Text', 'menutext[]');
				echo form_input(array(
					'name'     => 'menutext[]',
					'class'    => 'form-control',
					'value'    => @$data['menu2text']));
				echo form_label('Menu 2 Url', 'menuurl[]');
				echo form_input(array(
					'name'     => 'menuurl[]',
					'class'    => 'form-control',
					'value'    => @$data['menuurl']));
				echo form_label('Menu 3 Text', 'menutext[]');
				echo form_input(array(
					'name'     => 'menutext[]',
					'class'    => 'form-control',
					'value'    => @$data['menu3text']));
				echo form_label('Menu 3 Url', 'menuurl[]');
				echo form_input(array(
					'name'     => 'menuurl[]',
					'class'    => 'form-control',
					'value'    => @$data['menu3url']));
				?>
			</div>
			<div class="panel panel-footer">
				<?php
				echo form_button(array(
	        'id'      => 'submit',
	        'value'   => 'true',
	        'type'    => 'success',
	        'content' => 'submit',
	        'class'   => 'btn btn-success'));
				echo form_button(array(
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
</div>