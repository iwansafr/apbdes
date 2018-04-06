<?php
echo '<h2>'.$header_title.'</h2>';

if(!empty($data))
{
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
}else{
	echo msg('<h2>'.ucwords('data not found').'</h2>','warning');
}
?>
<div class="col-md-12">
	<hr>
	<?php echo $page_nation;?>
</div>
<?php
$ext = array();
ob_start();
?>
<script type="text/javascript">
	var keyword = $(document).find('head').find('meta[name="keywords"]');
	keyword.attr('content', '<?php echo $header_title?>');
	var description = $(document).find('head').find('meta[name="description"]');
	description.attr('content', '<?php echo $header_title?>');
	var title = $(document).find('head').find('title');
	title.prepend('<?php echo $header_title?>, ');
</script>
<?php
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_meta', $ext);
$this->session->set_userdata('link_js', base_url().'templates/land_page/js/script.js');