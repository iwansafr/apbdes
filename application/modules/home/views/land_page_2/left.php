<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Menu</h3>
	</div>
	<div class="panel-body">
		<?php
		$data = $this->esg->get_menu($config_template['menu_left']);
		?>
		<ul class="nav nav-pills nav-stacked">
			<?php
			if(is_admin())
			{
				?>
				<li><a href="<?php echo base_url('apbdes/apbdes/edit_desa') ?>">Edit Desa</a></li>
				<?php
			}
			if(user('role') < 4)
			{
				?>
				<li><a href="<?php echo base_url('apbdes/apbdes/village') ?>">Daftar Desa</a></li>
				<?php
			}
			foreach ($data as $key => $value)
			{
				echo '<li class=""><a href="'.menu_link($value['link']).'">'.$value['title'].'</a></li>';
			}
			?>
		</ul>
	</div>
</div>
