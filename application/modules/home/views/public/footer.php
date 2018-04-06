<div class="col-md-6">
	<div class="btn-group" role="group">
		<?php
		$site_value = $this->db->get_where('config',"name = 'site'")->row_array();
		$site_value = json_decode($site_value['value'], 1);

		$title = !empty($site_value['title']) ? $site_value['title'] : 'esoftgreat';
		$link = !empty($site_value['link'])  ? $site_value['link'] : 'http://esoftgreat.com';
		?>
		<h5 class="copyright text-muted small">Copyright &copy; 2017 <?php echo '<a class="white_color" href="'.$link.'">'.$title.'</a>' ?> | Powered By <a class="white_color" href="http://esoftgreat.com">esoftgreat</a>. All Rights Reserved</h5>
	</div>
</div>
<div class="col-md-6 pull-right">
	<div class="btn-group pull-right" role="group">
		<?php
		$data_config = get_block_config('menu_sosmed_footer', $config_template);
    $data_menu = $this->db->get_where($data_config['table'], 'publish = 1 AND par_id = 0 AND position_id = '.$data_config['id'])->result_array();
    foreach ($data_menu as $dkey => $dvalue)
    {
      ?>
      <button type="button" class="btn btn-success" onclick="window.open('<?php echo $dvalue["link"]?>', '_blank')"> <span><i class="fa fa-<?php echo $dvalue['title'];?>"></i></span></button>
      <?php
    }
    ?>
	</div>
</div>