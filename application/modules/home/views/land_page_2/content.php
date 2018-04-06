<?php
$data_config = get_block_config('content', $config_template);
$data        = $this->esg->get_content($data_config['where'], 7);

foreach ($data as $key => $value)
{
	?>
	<div class="col-md-4">
		<div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-12">
          	<a href="<?php echo content_link($value['slug']) ?>">
							<img src="<?php echo image_module('content', $value['id'].'/'.$value['image']) ?>" class="img-thumbnail img-responsive" style="cursor:pointer; object-fit: cover;width: 250px;height: 250px;">
          	</a>
          </div>
          <div class="col-xs-12" style="text-align: center;">
            <div class="huge"></div>
            <div><?php echo $value['title'] ?></div>
          </div>
        </div>
      </div>
      <a href="<?php echo content_link($value['slug']) ?>">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
	</div>
	<?php
}