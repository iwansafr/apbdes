<div class="row footer_top main_color" style="padding-top: 50px;">
  <?php
  $positions = array(1,2,3,4);
  foreach ($positions as $positions_k => $positions_v)
  {
    $data_config = get_block_config('menu_bottom_'.$positions_v, $config_template);
    ?>
    <div class="col-sm-3">
    	<?php
      $position_id = $positions_v;
      $menu_title = $this->db->get_where('menu_position', 'id = '.$data_config['id'], '1');
      $menu_title = $menu_title->row_array();
      echo '<h5>'.$menu_title['title'].'</h5>';
      $data_menu = $this->db->get_where($data_config['table'], 'publish = 1 AND par_id = 0 AND position_id = '.$data_config['id'])->result_array();
      echo '<ul class="list-unstyled">';
    	foreach ($data_menu as $dkey => $dvalue)
    	{
    		$sub_menu = $this->db->get_where($data_config['table'], 'publish = 1 AND par_id = '.$dvalue['id'])->result_array();
    		if(empty($sub_menu))
    		{
    			?>
    			<li><a class="white_color" href="<?php echo $dvalue['link'] ?>"><?php echo $dvalue['title'] ?></a></li>
    			<?php
    		}else{
    			?>
    			<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $dvalue['title'] ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
            	<?php
            	foreach ($sub_menu as $skey => $svalue)
            	{
            		echo '<li><a href="'.$svalue['link'].'">'.$svalue['title'].'</a></li>';
            	}
            	?>
            </ul>
          </li>
    			<?php
    		}
    	}
      echo '</ul>';
    	?>
    </div>
    <?php
  }?>
</div>