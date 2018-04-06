<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data_config  = get_block_config('content_top', $config_template);

$this->db->select('id,title,content,image,slug');
$this->db->order_by('id', 'desc');
$slider = $this->db->get_where($data_config['table'],$data_config['where']." AND image != ''", 5)->result_array();
?>

<div class="slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<?php
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
			    <div class="item <?php echo $i == 0 ? 'active': ''; ?>">
			      	<img src="<?php echo image_module('content',$slider_v['id'].'/'.$slider_v['image']) ?>" class="img-responsive" style="object-fit: cover;height: 400px;width: 800px;">
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
<hr>
<div class="content_home">
	<?php
	$data_config  = get_block_config('content_middle', $config_template);
	$this->db->select('title');
	$cat = $this->db->get_where('content_cat', 'id = '.$data_config['id'], 1)->row_array();
	$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
	$this->db->select('id,title,slug,image,created,content');
	$this->db->order_by('id', 'desc');
	$content = $this->db->get_where($data_config['table'], $data_config['where'], 5)->result_array();
	?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><?php echo $cat['title'] ?></h4>
			<?php
			if(!empty($content))
			{
				?>
				<div class="block">
					<div class="row">
						<div class="col-md-6">
							<?php
							if(!empty($content['0']['image']))
							{
								?>
								<img src="<?php echo image_module('content',$content['0']['id'].'/'.$content['0']['image']) ?>" class="img-responsive" style="object-fit: cover;height: 100px;width: 300px;">
								<?php
							}
							?>
							<h5 class="block_title">
								<?php
			        	if(!empty($content['0']['slug']))
			        	{
			        		?>
				        	<a href="<?php echo content_link($content['0']['slug']); ?>"><?php echo $content['0']['title'] ?></a>
				        	<?php
			        	}else{
			        		?>
				        	<a href="<?php echo content_link($content['0']['id'], $content['0']['title']); ?>"><?php echo $content['0']['title'] ?></a>
					        <?php
			        	}
			        	?>
							</h5>
							<span class="small"><?php echo date('l, d M Y') ?></span>
							<span class="small"><?php echo $content['0']['created'] ?></span>
							<p><?php echo substr($content['0']['content'], 0,100) ?></p>
						</div>
						<div class="col-md-6">
							<?php
							unset($content['0']);
							foreach ($content as $key_c => $value_c)
							{
								?>
								<div class="row widget">
									<?php
									if(!empty($value_c['image']))
									{
										?>
										<div class="col-md-3">
												<img src="<?php echo image_module('content',$value_c['id'].'/'.$value_c['image']) ?>" class="img-responsive img_thumbnail">
										</div>
										<?php
									}
									?>
									<div class="col-md-9">
										<h5 class="block_title">
											<?php
						        	if(!empty($value_c['slug']))
						        	{
						        		?>
							        	<a href="<?php echo content_link($value_c['slug']); ?>"><?php echo $value_c['title'] ?></a>
							        	<?php
						        	}else{
						        		?>
							        	<a href="<?php echo content_link($value_c['id'], $value_c['title']); ?>"><?php echo $value_c['title'] ?></a>
								        <?php
						        	}
						        	?>
										</h5>
										<span class="small"><?php echo $value_c['created'] ?></span>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<div class="content_home">
	<?php
	$data_config  = get_block_config('content_bottom', $config_template);
	$this->db->select('title');
	$cat = $this->db->get_where('content_cat', 'id = '.$data_config['id'], 1)->row_array();
	$cat = empty($cat) ? array('id'=>0,'title'=>$data_config['header']) : $cat;
	$this->db->select('id,title,slug,image,created,content');
	$this->db->order_by('id','desc');
	$content = $this->db->get_where($data_config['table'], $data_config['where'], 5)->result_array();
	?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><?php echo $cat['title'] ?></h4>
			<?php
			if(!empty($content))
			{
				?>
				<div class="block">
					<div class="row">
						<div class="col-md-6 pull-right">
							<img src="<?php echo image_module('content',$content['0']['id'].'/'.$content['0']['image']) ?>" class="img-responsive" style="object-fit: cover;height: 100px;width: 300px;">
							<h5 class="block_title">
								<?php
			        	if(!empty($content['0']['slug']))
			        	{
			        		?>
				        	<a href="<?php echo content_link($content['0']['slug']); ?>"><?php echo $content['0']['title'] ?></a>
				        	<?php
			        	}else{
			        		?>
				        	<a href="<?php echo content_link($content['0']['id'], $content['0']['title']); ?>"><?php echo $content['0']['title'] ?></a>
					        <?php
			        	}
			        	?>
							</h5>
							<span class="small"><?php echo date('l, d M Y') ?></span>
							<span class="small"><?php echo $content['0']['created'] ?></span>
							<p><?php echo substr($content['0']['content'], 0,100) ?></p>
						</div>
						<div class="col-md-6">
							<?php
							unset($content['0']);
							foreach ($content as $key_c => $value_c)
							{
								?>
								<div class="row widget">
									<div class="col-md-3">
										<img src="<?php echo image_module('content',$value_c['id'].'/'.$value_c['image']) ?>" class="img-responsive img_thumbnail">
									</div>
									<div class="col-md-9">
										<h5 class="block_title">
											<?php
						        	if(!empty($value_c['slug']))
						        	{
						        		?>
							        	<a href="<?php echo content_link($value_c['slug']); ?>"><?php echo $value_c['title'] ?></a>
							        	<?php
						        	}else{
						        		?>
							        	<a href="<?php echo content_link($value_c['id'], $value_c['title']); ?>"><?php echo $value_c['title'] ?></a>
								        <?php
						        	}
						        	?>
										</h5>
										<span class="small"><?php echo $value_c['created'] ?></span>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>