<style type="text/css">
	#banner{
		background-image: url(<?php echo image_module('config','header'.'/'.$header_value['image']) ?>);
	}
</style>
<div class="content">
	<header>
		<h2><?php echo @$header_value['title'] ?></h2>
		<p><?php echo @$header_value['description'] ?></p>
	</header>
	<span class="image">
		<img src="<?php echo image_module('config','header'.'/'.$header_value['image']) ?>" width="312" height="312"/>
	</span>
</div>
<a href="#one" class="goto-next scrolly">Next</a>