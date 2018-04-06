<h3>kategori</h3>
<?php
$data = $this->esg->get_menu($config_template['menu_left']);
?>
<ul class="nav nav-pills nav-stacked">
	<?php
	foreach ($data as $key => $value)
	{
		echo '<li class=""><a href="'.menu_link($value['link']).'">'.$value['title'].'</a></li>';
	}
	?>
</ul>
