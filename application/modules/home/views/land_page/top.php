<div class="container topnav">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand topnav" href="<?php echo base_url(); ?>">
			<?php
			if(!empty($logo_value['image']))
			{
				?>
				<img src="<?php echo image_module('config', 'logo/'.@$logo_value['image']) ?>" height="<?php echo $logo_value['height'] ?>">
				<?php
			}else{
				echo $logo_value['title'];
			}
			?>
		</a>
	</div>
	<?php
	$esg = new esg();
	$menu = $this->esg->get_menu($config_template['menu_top']);
	function menu_horizontal($menus, $y='', $x='', $level = -1) // $y = 'down' || 'top' AND $x = 'right'|| 'left'
	{
		$output = '';
		if (!empty($menus))
		{
			if ($level == -1)
			{
				$output = call_user_func(__FUNCTION__, $menus, $y,$x,++$level);
			}else
			if (empty($level))
			{
				$cls = !empty($y) ? ' nav-'.$y : '';
				$cls.= !empty($x) ? ' nav-'.$x : '';
				$out = '';
				foreach ($menus as $k => $menu)
				{
					$sub = call_user_func(__FUNCTION__, $menu['child'], $y,$x,++$level);
					if (!empty($sub))
					{
						$out .= '<li class="dropdown"><a role="button" data-toggle="dropdown" tabindex="-1" href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].' <b class="caret"></b></a>'.$sub.'</li>';
					}else{
						$act = @$_GET['menu_id']==$menu['id'] ? ' class="active"' : '';
						$out.= '<li'.$act.'><a href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a></li>';
					}
				}
				$output = '<ul class="nav navbar-nav'.$cls.'">'.$out.'</ul>';
			}else {
				$out = '';
				foreach ($menus as $k => $menu)
				{
					$sub = call_user_func(__FUNCTION__, $menu['child'], $y,$x,++$level);
					if (!empty($sub))
					{
						$out .= '<li class="dropdown-submenu"><a tabindex="-1" href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a>'.$sub.'</li>';
					}else{
						$act = @$_GET['menu_id']==$menu['id'] ? ' class="active"' : '';
						$out.= '<li'.$act.'><a href="'.$menu['link'].'" title="'.$menu['title'].'">'.$menu['title'].'</a></li>';
					}
				}
				$output = '<ul class="dropdown-menu" role="menu">'.$out.'</ul>';
			}
		}
		return $output;
	}
	function land_page_menu_top($data = array())
	{
		if(!empty($data) && is_array($data))
		{
			foreach ($data as $key => $value)
			{
				if(empty($value['child']))
				{
					?>
					<li><a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a></li>
					<?php
				}else{
					?>
					<li class="dropdown">
			      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $value['title'] ?> <span class="caret"></span></a>
			      <ul class="dropdown-menu" role="menu">
			      	<?php
			      	call_user_func(__FUNCTION__, $value['child']);
			      	?>
			      </ul>
			  	</li>
			  	<?php
				}
			}
		}
	}
	?>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<?php
			land_page_menu_top($menu);
			// echo menu_horizontal($menu);
    	?>
      <li>
        <form action="<?php echo base_url('content/search') ?>" method="get">
          <?php $keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';?>
      	 <input type="text" name="keyword" class="form-control" placeholder="search" value="<?php echo $keyword?>"  style="margin-top: 7px;">
        </form>
      </li>
		</ul>
	</div>
</div>
