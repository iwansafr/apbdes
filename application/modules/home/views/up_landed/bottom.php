<?php
$data_config = get_block_config('bottom', $config_template);
$bottom = $this->esg->get_content($data_config['where'], 1);
$bottom = $bottom[0];
?>
<span class="image fit main"><img src="<?php echo image_module('content', $bottom['id'].'/'.$bottom['image'])?>" alt="" /></span>
<div class="content">
	<div class="container">
		<div class="row">
			<?php
			$data_config = get_block_config('bottom_left', $config_template);
			$bottom = $this->esg->get_content($data_config['where'], 1);
			$bottom = $bottom[0];
		 	?>

			<div class="4u 12u$(medium)">
				<header>
					<h2><?php echo $bottom['title'] ?></h2>
					<p><?php echo $bottom['description'] ?></p>
				</header>
			</div>
			<?php
			$data_config = get_block_config('bottom_middle', $config_template);
			$bottom = $this->esg->get_content($data_config['where'], 1);
			$bottom = $bottom[0];
		 	?>
			<div class="4u 12u$(medium)">
				<p><?php echo $bottom['description'] ?></p>
			</div>
			<?php
			$data_config = get_block_config('bottom_right', $config_template);
			$bottom = $this->esg->get_content($data_config['where'], 1);
			$bottom = $bottom[0];
		 	?>
			<div class="4u$ 12u$(medium)">
				<p><?php echo $bottom['description'] ?></p>
			</div>
		</div>
	</div>
</div>
<a href="#two" class="goto-next scrolly">Next</a>