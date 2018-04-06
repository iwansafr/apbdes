<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
	.intro-header {
    padding-top: 50px;
    padding-bottom: 50px;
    text-align: center;
    color: #f8f8f8;
    background: url(<?php echo image_module('config', 'header/'.$header_value['image']) ?>) no-repeat center center;
    background-size: cover;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="intro-message">
				<h1><?php echo $header_value['title'] ?></h1>
				<h3><?php echo $header_value['description'] ?></h3>
				<hr class="intro-divider">
				<ul class="list-inline intro-social-buttons">
					<?php
					$data_config = get_block_config('menu_header', $config_template);
			    $data_menu = $this->db->get_where($data_config['table'], 'publish = 1 AND par_id = 0 AND position_id = '.$data_config['id'])->result_array();
			    foreach ($data_menu as $dkey => $dvalue)
			    {
			      ?>
			      <li>
							<a href="<?php echo $dvalue['link']; ?>" target="_blank" class="btn btn-default btn-lg"><i class="fa fa-<?php echo $dvalue['title']?> fa-fw"></i> <span class="network-name"><?php echo ucfirst($dvalue['title']) ?></span></a>
						</li>
			      <?php
			    }
					?>
				</ul>
			</div>
		</div>
	</div>
</div>