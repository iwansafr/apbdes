<h1 id="logo">
	<a href="<?php echo base_url() ?>">
		<?php
		if(!empty($logo_value['image']))
		{
			?>
			<img src="<?php echo image_module('config', 'logo'.'/'.$logo_value['image']) ?>" width="<?php echo $logo_value['width'] ?>" height="<?php echo $logo_value['height'] ?>">
			<?php
		}else{
			if(!empty($logo_value['title']))
			{
				echo $logo_value['title'];
			}else{
				?>
				<i class="fa fa-folder-o"></i> esoftgreat
				<?php
			}
		}
		?>
	</a>
</h1>
<?php
$data_config = get_block_config('menu_top', $config_template);
$data_menu   = $this->esg->parent_menu($data_config['table'], $data_config['id']);
?>
<nav id="nav">
	<ul>
		<?php
		foreach ($data_menu as $key => $value)
		{
			$sub_menu = $this->esg->child_menu($data_config['table'], $value['id']);
			if(empty($sub_menu))
    		{
    			?>
    			<li><a href="<?php echo menu_link($value['link']) ?>"><?php echo $value['title'] ?></a></li>
    			<?php
    		}else{
    			?>
    			<li>
	          <a href="#" ><?php echo $value['title'] ?></a>
	    			<ul>
	          	<?php
	          	foreach ($sub_menu as $skey => $svalue)
	          	{
	          		echo '<li><a href="'.$svalue['link'].'">'.$svalue['title'].'</a></li>';
	          	}
	          	?>
	    			</ul>
    			</li>
    			<?php
    		}
			?>
			<?php
		}
		?>
		<li>
			<?php search_form(); ?>
		</li>
		<li><a href="#" class="button special">Sign Up</a></li>
	</ul>
</nav>