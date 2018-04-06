<?php
$data_config = get_block_config('left', $config_template);
$left = $this->esg->get_content($data_config['where'], 1);
$left = $left[0];
?>
<span class="image fit main bottom"><img src="<?php echo image_module('content',$left['id'].'/'.$left['image']) ?>" alt="" /></span>
<div class="content">
	<header>
		<h2><?php echo $left['title'] ?></h2>
		<p><?php echo $left['keyword'] ?></p>
	</header>
	<p><?php echo $left['description'] ?></p>
	<ul class="actions">
		<li><a href="<?php echo content_link($left['slug']) ?>" class="button">Learn More</a></li>
	</ul>
</div>
<a href="#four" class="goto-next scrolly">Next</a>