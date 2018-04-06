<?php
$content_detail_config = $this->esg->get_config('content_config');
$slug = $this->uri->segment(1);
if($slug != 'content')
{
	$data = $this->db->get_where('content', "slug = '{$slug}' AND publish = 1",1)->row_array();
}else{
	$id   = @intval($this->uri->segment(2));
	$data = $this->db->get_where('content', 'id = '.$id.' AND publish = 1',1)->row_array();
}
if(!empty($data))
{
	$cat_ids = $data['cat_ids'];
	$cat_ids = array_filter(explode(',', $cat_ids));
	$this->db->where_in('id', $cat_ids);
	$this->db->select('id');
	$this->db->select('title');
	$this->db->select('slug');
	$categories = $this->db->get_where('content_cat')->result_array();

	if(!empty($data['tag_ids']))
	{
		$tag_ids = $data['tag_ids'];
		$tag_ids = array_filter(explode(',', $tag_ids));
		$this->db->where_in('id', $tag_ids);
		$this->db->select('id');
		$this->db->select('title');
		$tags = $this->db->get_where('content_tag')->result_array();
	}
	$update_data = array(
		'hits' => $data['hits']+1,
		'last_hits' => date('Y-m-d h-i-s')
	);
	$this->data_model->set_data('content', $data['id'], $update_data);
	?>
	<div class="col-md-12">
		<div class="col-md-12">
			<header class="major">
				<h2><?php echo $data['title'] ?></h2>
				<p></p>
			</header>
		</div>
		<div class="col-md-12" style="margin-bottom: 10px;">
			<span>category : </span>
			<?php
			if(!empty($categories))
			{
				foreach ($categories as $c_key => $c_value)
				{
					if(!empty($c_value['slug']))
					{
						?>
						<a href="<?php echo content_cat_link($c_value['slug']); ?>">
							<button class="btn btn-info btn-xs"><?php echo $c_value['title'] ?></button>
						</a>
						<?php
					}else{
						?>
						<a href="<?php echo content_cat_link($c_value['id'], $c_value['title']) ?>">
							<button class="btn btn-info btn-xs"><?php echo $c_value['title'] ?></button>
						</a>
						<?php
					}
				}
			}
			?>
		</div>
		<div class="col-md-12">
			<?php
			if(!empty($data['image']))
			{
				?>
				<img src="<?php echo image_module('content', $data['id'].'/'.$data['image']); ?>" style="object-fit: cover;width: 100%;">
				<?php
			}
			if(!empty($data['images']))
			{
				echo '<div style="text-align: center; padding: 1px;">';
				$data['images'] = json_decode($data['images'], 1);
				$i = 0;
				foreach ($data['images'] as $imkey => $imvalue)
				{
					?>
					<a href="#img_image_<?php echo $i?>">
						<img src="<?php echo image_module('content', 'gallery'.'/'.$data['id'].'/'.$imvalue) ?>" class="" style="object-fit: cover;width: 100px;height: 100px;" data-toggle="modal" data-target="#img_image_<?php echo $i?>">
					</a>
					<div class="modal fade" id="img_image_<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="img_image_<?php echo $i?>">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					        <h4 class="modal-title" id="img_title_image_<?php echo $i?>">image <?php echo $i; ?></h4>
					      </div>
					      <div class="modal-body" style="text-align: center;">
					        <img src="<?php echo image_module('content', 'gallery'.'/'.$data['id'].'/'.$imvalue) ?>" class="img-thumbnail img-responsive">
					      </div>
					      <div class="modal-footer">
					      </div>
					    </div>
					  </div>
					</div>
					<?php
					$i++;
				}
				echo '</div>';
			}
			echo $data['content'];
			if(!empty($tags) && !empty($content_detail_config['tag_detail']))
			{
				foreach ($tags as $t_key => $t_value)
				{
					?>
					<a href="<?php echo content_tag_link($t_value['title']) ?>">
						<button class="btn btn-info btn-xs"><?php echo $t_value['title'] ?></button>
					</a>
					<?php
				}
			}
			?>
		</div>
		<div class="col-md-12">
			<div class="col-md-6" style="padding-left: 0;">
				<?php
				if($content_detail_config['created_detail'] == 1)
				{
					?>
					<span class="small pull-left">created : <?php echo content_date($data['created']); ?></span>
					<?php
				}?>
			</div>
			<div class="col-md-6">
				<?php
				if($content_detail_config['author_detail'] == 1)
				{
					?>
					<span class="small pull-right">author : <?php echo $data['author'] ?></span>
					<?php
				}?>
			</div>
		</div>
	</div>
	<?php
	if(@intval($content_detail_config['comment_detail']) == 1)
	{
		$this->esg->set_comment_module_id($data['id']);
		$this->esg->comment_form();
	}

	$ext = array();
	ob_start();
	$data['description'] = strip_tags($data['description']);
	$data['description'] = trim(preg_replace('/\s+/', ' ', $data['description']));
	?>
	<script type="text/javascript">
		var keyword = $(document).find('head').find('meta[name="keywords"]');
		keyword.attr('content', '<?php echo $data["title"]?>');
		var description = $(document).find('head').find('meta[name="description"]');
		description.attr('content', '<?php echo $data["description"]?>');
		var title = $(document).find('head').find('title');
		title.prepend('<?php echo $data["title"]?>, ');
	</script>
	<?php
	$ext = ob_get_contents();
	ob_end_clean();
	$this->session->set_userdata('js_extra', $ext);
}else{
	echo msg('please check your url, make sure that your url is correct', 'warning');
}