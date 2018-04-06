<?php
echo '<h2 style="text-align: center;">'.$header_title.'</h2>';

if(!empty($data))
{
	?>
	<div class="row">
		<div class="col-md-12">
			<?php
			foreach ($data as $key => $value)
			{
				?>
				<div class="col-md-6" style="text-align: center;">
					<div class="panel panel-default">
						<div class="panel-body">
							<hr>
							<div class="col-md-12">
								<img src="<?php echo image_module('content', $value['id'].'/'.$value['image']); ?>" style="object-fit: cover; height: 200px; width: 200px;">
							</div>
							<div class="col-md-12">
								<?php
								if(!empty($value['slug']))
								{
									?>
									<a href="<?php echo content_link($value['slug']) ?>"><h4><?php echo $value['title'] ?></h4></a>
									<?php
								}else{
									?>
									<a href="<?php echo content_link($value['id'], $value['title']) ?>"><h4><?php echo $value['title'] ?></h4></a>
									<?php
								}
								?>
							</div>
							<div class="col-md-12">
								<p>
									<?php echo strip_tags($value['description']);?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}?>
		</div>
	</div>
	<?php
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
	title.prepend('<?php echo $data["title"]?>, ');
</script>
<?php
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_meta', $ext);