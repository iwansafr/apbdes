<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data_config  = get_block_config('news', $config_template);
$cat = $this->content_model->get_cat($data_config['id']);
$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
$breaking_news = $this->content_model->block_content($data_config['table'], $data_config['where']);
?>

<div class="row" style="border:solid #CACACA 1px;">
	<div class="col-md-2 main_color" style="color:white;">
		<h5>
			<?php
    	if(!empty($cat['slug']))
    	{
    		?>
      	<a href="<?php echo content_cat_link($cat['slug']); ?>"><?php echo $cat['title'] ?></a>
      	<?php
    	}else{
    		?>
      	<a href="<?php echo content_cat_link($cat['id'], $cat['title']); ?>"><?php echo $cat['title'] ?></a>
        <?php
    	}
    	?>
		</h5>
	</div>
	<div class="col-md-10">
		<h6>
			<?php
    	if(!empty($breaking_news['slug']))
    	{
    		?>
      	<a href="<?php echo content_link($breaking_news['slug']); ?>"><?php echo $breaking_news['title'] ?></a>
      	<?php
    	}else{
    		?>
      	<a href="<?php echo content_link($breaking_news['id'], $breaking_news['title']); ?>"><?php echo $breaking_news['title'] ?></a>
        <?php
    	}
    	?>
		</h6>
	</div>
</div>
