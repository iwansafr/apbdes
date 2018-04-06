<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	.banner {
    padding: 100px 0;
    color: #f8f8f8;
    background: url(<?php echo image_module('config', 'header_bottom/'.$bottom_value['image']) ?>) no-repeat center center;
    background-size: cover;
	}
</style>
<div class="container">
	<?php
	$this->db->select('value');
	$additional_js = $this->db->get_where('config',"name = 'js_extra'")->row_array();
	$additional_js = $additional_js['value'];
	$additional_js = json_decode($additional_js,1);
	$additional_js = $additional_js['code'];
	echo $additional_js;
	?>
</div>
<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2><?php echo $bottom_value['title'] ?></h2>
			</div>
			<div class="col-lg-6">
				<ul class="list-inline banner-social-buttons">
					<?php
					$esg = new esg();
					$data_config = get_block_config('menu_bottom', $config_template);
			    $data_menu = $esg->parent_menu($data_config['table'], $data_config['id']);
			    foreach ($data_menu as $dkey => $dvalue)
			    {
			    	$sub_menu = $esg->child_menu($data_config['table'], $dvalue['id']);
			    	if(empty($sub_menu))
			    	{
				      ?>
				      <li>
								<a href="<?php echo $dvalue['link']; ?>" target="_blank" class="btn btn-default btn-lg"><i class="fa fa-<?php echo $dvalue['title']?> fa-fw"></i> <span class="network-name"><?php echo ucfirst($dvalue['title']) ?></span></a>
							</li>
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
					?>
				</ul>
			</div>
		</div>
	</div>
</div>