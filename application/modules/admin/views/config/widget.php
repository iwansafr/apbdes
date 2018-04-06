<?php
$this->db->select('value');
$active_template = $this->db->get_where('config',"name = 'templates'")->row_array();
if(!empty($active_template))
{
	$active_template = json_decode($active_template['value'], 1);
	$active_template = $active_template['templates'];
	foreach(glob(FCPATH.'application/modules/home/views/'.$active_template.'/index.esg') as $file)
	{
		if(!empty($_POST))
		{
			$config       = $_POST;
			$config_title = $config['template'].'_widget';
			$form         = new ECRUD();
			$form->init('param');
			$form->setTable('config');
			$form->setParamName($config_title);
			$message = $form->action();
			if(!empty($message))
			{
				msg($message['msg'], $message['alert']);
			}
		}
		$config_name = $active_template.'_widget';
		$data = $this->data_model->get_one_data('config', "WHERE `name` = '{$config_name}'");
		$data = json_decode($data['value'],1);
		$view = file_get_contents($file);
		preg_match_all('~{.*?}~', $view, $blocks);
		$block = array();
		foreach ($blocks as $key => $value)
		{
			$block = $value;
		}
		$blocks = array();
		$this->db->select('id,title');
		$cat = $this->db->get_where('content_cat', 'publish = 1')->result_array();
		$cat[] = array('id'=>0, 'title'=>'Latest');
		foreach ($cat as $catkey => &$catvalue)
		{
			$catvalue['id'] = 'cat_'.$catvalue['id'];
		}

		$this->db->select('id,title');
		$menu = $this->db->get_where('menu_position')->result_array();
		foreach ($menu as $menukey => &$menuvalue)
		{
			$menuvalue['id'] = 'menu_'.$menuvalue['id'];
		}
		// $option_block = array_merge($cat, $menu);
		echo '<form method="post" action="">';
		echo '<input type="hidden" name="template" value="'.$active_template.'">';
		foreach ($block as $blockkey => $blockvalue)
		{
			$block_title = str_replace('{','', $blockvalue);
			$block_title = str_replace('}','', $block_title);

			ob_start();
			$this->ecrud->open_collapse($block_title, $block_title,'default');
			echo '<h3>'.$block_title.'</h3>';
			echo '<label>content</label>';
			?>
			<select class="form-control" name="<?php echo $block_title?>[content]">
			<?php
			$option_block = array();
			if(preg_match('~menu_~', $block_title))
			{
				$option_block = $menu;
			}else{
				$option_block = $cat;
			}
			foreach ($option_block as $keys => $values)
			{
				$selected = ($values['id'] == $data[$block_title]['content']) ? 'selected' : '';
				echo '<option value="'.$values['id'].'" '.$selected.'>'.$values['title'].'</option>';
			}
			echo '</select>';
			if(!preg_match('~menu_~', $block_title))
			{
				echo '<label>limit</label>';
				$limit = !empty($data[$block_title]['limit']) ? $data[$block_title]['limit'] : '7';
				?>
				<input type="number" name="<?php echo $block_title ?>[limit]" class="form-control" value="<?php echo $limit ?>">
				<?php
			}
			$this->ecrud->close_collapse();
			$options = ob_get_contents();
			ob_end_clean();
			$view = preg_replace('~'.$blockvalue.'~', $options, $view);
		}
		// $view = preg_replace('~{top}~', $array, $view);
		echo $view;
		echo '<hr>';
		echo '<button class="btn btn-success" name="submit" value="submit"><span><i class="fa fa-floppy-o"></i></span> SAVE</button>';
		echo '</form>';
	}
}

