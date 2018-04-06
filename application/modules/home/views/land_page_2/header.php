<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<?php
		$data_config = get_block_config('header', $config_template);
		$slider      = $this->esg->get_content($data_config['where'], 5);

		if(!empty($slider))
		{
			?>
		  <ol class="carousel-indicators">
		  	<?php
		  	$i = 0;
		  	foreach ($slider as $slider_k => $slider_v)
		  	{
		  		?>
		    	<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php echo $i==0 ? 'class="active"' : ''; ?> ></li>
		    	<?php
		    	$i++;
		  	}
		  	?>
		  </ol>
		  <div class="carousel-inner" role="listbox">
		  	<?php
		  	$i = 0;
		  	foreach ($slider as $slider_k => $slider_v)
		  	{
		  		?>
			    <div class="item <?php echo $i == 0 ? 'active': ''; ?>" style="text-align: center;">
			      	<img src="<?php echo image_module('content',$slider_v['id'].'/'.$slider_v['image']) ?>" class="img-responsive image_slider" style="">
			      <div class="carousel-caption">
			        <h4>
			        	<?php
			        	if(!empty($slider_v['slug']))
			        	{
			        		?>
				        	<a href="<?php echo content_link($slider_v['slug']); ?>"><?php echo $slider_v['title'] ?></a>
				        	<?php
			        	}else{
			        		?>
				        	<a href="<?php echo content_link($slider_v['id'], $slider_v['title']); ?>"><?php echo $slider_v['title'] ?></a>
					        <?php
			        	}
			        	?>
			        </h4>
		    			<h4 style="text-align: center;"><?php echo substr($slider_v['content'],0,100); ?></h4>
			      </div>
			    </div>
		    	<?php
		    	$i++;
		  	}
		  	?>
		  </div>
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
			<?php
		}
		?>
	</div>
</div>




