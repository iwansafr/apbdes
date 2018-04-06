<?php
$data_config = get_block_config('menu_footer', $config_template);
$data_menu   = $this->esg->parent_menu($data_config['table'], $data_config['id']);
?>
<ul class="icons">
	<?php
	foreach ($data_menu as $key => $value)
	{
		?>
		<li><a href="<?php echo $value['link'] ?>" class="icon alt fa-<?php echo $value['title'] ?>"><span class="label"><?php echo $value['title'] ?></span></a></li>
		<?php
	}
	?>
<!-- 	<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
	<li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
	<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
	<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
	<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li> -->
</ul>
<ul class="copyright">
	<li>Copyright &copy; <?php echo date('Y') ?> </li><li> Untitled. All rights reserved.</li><li>Powered By: <a href="<?php echo $site_value['link'] ?>"><?php echo $site_value['title'] ?></a></li>
</ul>