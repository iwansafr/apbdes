<?php
echo '<h2>'.$header_title.'</h2>';

if(!empty($data))
{
	foreach ($data as $key => $value)
	{
		?>
		<div class="col-md-12">
			<hr>
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
			<?php
			if(!empty($value['image']) || !empty($value['image_link']))
			{
				$img_src = !empty($value['image_link']) ? $value['image_link'] : image_module('content', $value['id'].'/'.$value['image']);;
				?>
				<div class="col-md-2">
					<img src="<?php echo $img_src; ?>" style="object-fit: cover; height: 100px; width: 100px;">
				</div>
				<div class="col-md-10">
					<span class="small"><?php echo $value['created'] ?></span>
					<span class="small pull-right"><?php echo !empty($value['author']) ? 'created by : '.@$value['author'] : ''; ?></span>
					<p>
						<?php echo strip_tags($value['description']);?>
					</p>
				</div>
				<?php
			}else{
				?>
				<div class="col-md-12">
					<span class="small"><?php echo $value['created'] ?></span>
					<span class="small pull-right"><?php echo !empty($value['author']) ? 'created by : '.@$value['author'] : ''; ?></span>
					<p>
						<?php echo strip_tags($value['description']);?>
					</p>
				</div>
				<?php
			}
			?>
		</div>
		<br>
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