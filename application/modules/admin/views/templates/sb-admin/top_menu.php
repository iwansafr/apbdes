<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<?php
		$user_data = $this->session->userdata('logged_in');
		if(!empty($user_data['image']))
		{
			?>
			<img src="<?php echo image_module('user', $user_data['id'].'/'.$user_data['image']) ?>" style="object-fit: cover; height: 20px; width: 20px">
			<?php echo $user_data['username'] ?>
			<b class="caret"></b>
			<?php
		}else{
			?>
			<i class="fa fa-user"></i> <?php echo $this->session->userdata['logged_in']['username'] ?> <b class="caret"></b>
			<?php
		}
		?>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="<?php echo base_url('admin/user_edit/'.$user_data['id']) ?>"><i class="fa fa-fw fa-cog"></i>Edit Profil</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
		</li>
	</ul>
</li>