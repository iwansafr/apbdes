<?php

$data_config = get_block_config('menu_footer', $config_template);
$esg = new esg();
?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="list-inline">
						<?php
			    	$data_menu = $esg->parent_menu($data_config['table'], $data_config['id']);
			    	foreach ($data_menu as $dkey => $dvalue)
			    	{
			    		$sub_menu = $esg->child_menu($data_config['table'], $dvalue['id']);
			    		if(empty($sub_menu))
			    		{
			    			?>
			    			<li><a href="<?php echo menu_link($dvalue['link']) ?>"><?php echo $dvalue['title'] ?></a></li>
			    			<?php
			    		}else{
			    			?>
			    			<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $dvalue['title'] ?> <span class="caret"></span></a>
				          <ul class="dropdown-menu">
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
			    	}
			    	date_default_timezone_set('Asia/Jakarta');
			    	?>
					</ul>
					<p class="copyright text-muted small">Copyright &copy; <?php echo date('Y') ?> <?php echo '<a href="'.base_url().'">'.$site_value['title'].'</a>' ?> | Powered By <a href="http://esoftgreat.com">esoftgreat</a>. All Rights Reserved</p>
				</div>
			</div>
		</div>