<?php
// $dataku = $this->esg->get_content_data($config_template['content']);
// $data_config  = get_block_config('content', $config_template);
// $this->db->select('id,title,slug,image,created,content');
// $this->db->order_by('id', 'desc');
// $content = $this->db->get_where($data_config['table'], $data_config['where'], $data_config['limit'])->result_array();
$i = 0;

$data_config = get_block_config('content', $config_template);
$content     = $this->esg->get_content($data_config['where'], $data_config['limit']);

foreach ($content as $key => $value)
{
	$class_content = ($i%2 == 0) ? 'content-section-a' : 'content-section-b';
	$class_push = ($i%2 == 0) ? '': 'col-lg-offset-1 col-sm-push-6';
	$class_push2 = ($i%2 == 0) ?  'col-lg-offset-2' : 'col-sm-pull-6';
	$i++;
	?>
	<div class="<?php echo $class_content ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-sm-6 <?php echo $class_push ?>">
					<hr class="section-heading-spacer">
					<div class="clearfix"></div>
					<h2 class="section-heading"><?php echo $value['title'] ?></h2>
					<p class="lead"><?php echo $value['content'] ?></p>
				</div>
				<div class="col-lg-5 <?php echo $class_push2 ?> col-sm-6">
					<img class="img-responsive" src="<?php echo image_module('content',$value['id'].'/'.$value['image']) ?>" alt="" style="object-fit: cover; height: 350px; width: 457px;">
				</div>
			</div>
		</div>
	</div>
	<?php
}
// $data_config  = get_block_config('content_bottom', $config_template);
// $this->db->select('id,title,slug,image,created,content');
// $this->db->order_by('id', 'desc');
// $content = $this->db->get_where($data_config['table'], $data_config['where'], 1)->row_array();

$data_config = get_block_config('content_bottom', $config_template);
$content     = $this->esg->get_content($data_config['where'], $data_config['limit']);
$content     = $content['0'];
?>

<div class="content-section-a">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-sm-6">
				<hr class="section-heading-spacer">
				<div class="clearfix"></div>
				<h2 class="section-heading"><?php echo $content['title'] ?></h2>
				<p class="lead"><?php echo $content['content'] ?></p>
			</div>
			<div class="col-lg-5 col-lg-offset-2 col-sm-6">
				<img class="img-responsive" src="<?php echo image_module('content', $content['id'].'/'.$content['image']) ?>" alt="" style="object-fit: cover;width: 457px; height: 352px;">
			</div>
		</div>
	</div>
</div>