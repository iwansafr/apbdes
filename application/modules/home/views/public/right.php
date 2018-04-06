<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data_config  = get_block_config('right_1', $config_template);
$cat = $this->content_model->get_cat($data_config['id']);
$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
$content = $this->content_model->block_content($data_config['table'], $data_config['where'], 5);
?>
<div class="panel panel-default">
	<div class="panel-body">
		<h4><?php echo $cat['title'];?></h4>
		<hr>
		<?php
		foreach ($content as $t_key => $t_value)
		{
			?>
			<div class="content">
				<h5 class="block_title">
					<?php
        	if(!empty($t_value['slug']))
        	{
        		?>
	        	<a href="<?php echo content_link($t_value['slug']); ?>"><?php echo $t_value['title'] ?></a>
	        	<?php
        	}else{
        		?>
	        	<a href="<?php echo content_link($t_value['id'], $t_value['title']); ?>"><?php echo $t_value['title'] ?></a>
		        <?php
        	}
        	?>
				</h5>
				<span class="small"><?php echo $t_value['created'] ?></span>
			</div>
			<?php
		}
		?>
	</div>
</div>
<div class="panel panel-default">
	<?php
	$data_config  = get_block_config('right_2', $config_template);
	$cat = $this->content_model->get_cat($data_config['id']);
	$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
	$content = $this->content_model->block_content($data_config['table'], $data_config['where'], 5);
	?>
	<div class="panel-body">
		<h4><?php echo $cat['title'];?></h4>
		<hr>
		<?php
		foreach ($content as $t_key => $t_value)
		{
			?>
			<div class="content">
				<h5 class="block_title">
					<?php
        	if(!empty($t_value['slug']))
        	{
        		?>
	        	<a href="<?php echo content_link($t_value['slug']); ?>"><?php echo $t_value['title'] ?></a>
	        	<?php
        	}else{
        		?>
	        	<a href="<?php echo content_link($t_value['id'], $t_value['title']); ?>"><?php echo $t_value['title'] ?></a>
		        <?php
        	}
        	?>
				</h5>
				<span class="small"><?php echo $t_value['created'] ?></span>
			</div>
			<?php
		}
		?>
	</div>
</div>
<?php
$data_config  = get_block_config('right_1', $config_template);
$cat = $this->content_model->get_cat($data_config['id']);
$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
$content = $this->content_model->block_content($data_config['table'], $data_config['where'], 5);
?>
<div class="panel panel-default">
	<div class="panel-body">
		<h4><?php echo $cat['title'];?></h4>
		<hr>
		<?php
		foreach ($content as $t_key => $t_value)
		{
			?>
			<div class="content">
				<h5 class="block_title">
					<?php
        	if(!empty($t_value['slug']))
        	{
        		?>
	        	<a href="<?php echo content_link($t_value['slug']); ?>"><?php echo $t_value['title'] ?></a>
	        	<?php
        	}else{
        		?>
	        	<a href="<?php echo content_link($t_value['id'], $t_value['title']); ?>"><?php echo $t_value['title'] ?></a>
		        <?php
        	}
        	?>
				</h5>
				<span class="small"><?php echo $t_value['created'] ?></span>
			</div>
			<?php
		}
		?>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<?php
		$data_config  = get_block_config('right_1', $config_template);
		$cat = $this->content_model->get_cat($data_config['id']);
		$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
		$content = $this->content_model->block_content($data_config['table'], $data_config['where'], 5);
		?>
		<h4><?php echo $cat['title'] ?></h4>
		<hr>
		<?php
		foreach ($content as $db_key => $db_value)
		{
			?>
			<img src="<?php echo image_module('content', $db_value['id'].'/'.$db_value['image']) ?>" class="img-responsive">
			<?php
		}
		?>
	</div>
</div>