<?php
$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();
?>
<h1>
  Dashboard
  <?php
  if(!empty($mod['task']) || $mod['task'] == 'admin')
	{
		?>
		<a href="<?php echo base_url($mod['name'].'/'.$mod['task']); ?>"><small> <?php echo $mod['task'] ?></small></a>
		<?php
	}?>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <?php
	if(!empty($mod['name']))
	{
		?>
		<li class="active">
			<a href="<?php echo base_url($mod['name']); ?>"> <?php echo $mod['name'] ?></a>
		</li>
		<?php
	}
	if(!empty($this->session->userdata('nav_menu')))
	{
		$nav_menu = $this->session->userdata('nav_menu');
		?>
		<li class="active">
			<a href="<?php echo $nav_menu['link']; ?>"> <?php echo $nav_menu['title']?></a>
		</li>
		<?php
	}
	if(!empty($mod['task']) || $mod['task'] == 'admin')
	{
		?>
		<li class="active">
			<a href="<?php echo base_url($mod['name'].'/'.$mod['task']); ?>"> <?php echo $mod['task'] ?></a>
		</li>
		<?php
	}?>
</ol>