<?php
$data_config = get_block_config('right', $config_template);
$right = $this->esg->get_content($data_config['where'], 1);
$right = $right[0];
?>
<span class="image fit main"><img src="<?php echo image_module('content',$right['id'].'/'.$right['image']) ?>" alt="" /></span>
<div class="content">
	<header>
		<h2><?php echo $right['title'] ?></h2>
		<p><?php echo $right['keyword'] ?></p>
	</header>
	<p><?php echo $right['content'] ?></p>
	<ul class="actions">
		<li><a href="<?php echo content_link($right['slug']) ?>" class="button">Learn More</a></li>
	</ul>
</div>
<a href="#three" class="goto-next scrolly">Next</a>