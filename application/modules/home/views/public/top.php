<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data_config = get_block_config('menu_top', $config_template);
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top_navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php
			if(!empty($logo_value['image']))
			{
				?>
				<a href="<?php echo base_url(); ?>" style="padding-top: 5px;" class="navbar-brand"><img src="<?php echo image_module('config', 'logo/'.@$logo_value['image']) ?>" height="40"></a>
				<?php
			}else if(!empty($logo_value['title'])){
				echo $logo_value['title'];
			}else{
				echo '<a class="navbar-brand" href="'.base_url().'"><span><i class="fa fa-home"></i></span></a>';
			}
			?>
    </div>
    <div class="collapse navbar-collapse" id="top_navbar">
      <ul class="nav navbar-nav">
      	<?php
      	$data_menu = $this->content_model->get_data_menu($data_config['table'], $data_config['id']);
      	foreach ($data_menu as $dkey => $dvalue)
      	{
      		$sub_menu = $this->content_model->get_data_menu($data_config['table'], $data_config['id'], $dvalue['id']);
      		if(empty($sub_menu))
      		{
      			?>
      			<li><a href="<?php echo menu_link($dvalue['link']) ?>"><?php echo $dvalue['title'] ?></a></li>
      			<?php
      		}else{
      			?>
      			<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $dvalue['title'] ?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		          	<?php
		          	foreach ($sub_menu as $skey => $svalue)
		          	{
		          		echo '<li><a href="'.menu_link($svalue['link']).'">'.$svalue['title'].'</a></li>';
		          	}
		          	?>
		          </ul>
		        </li>
      			<?php
      		}
      	}
      	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        $data_config = get_block_config('menu_sosmed', $config_template);
        $data_menu = $this->content_model->get_data_menu($data_config['table'], $data_config['id']);
        foreach ($data_menu as $dkey => $dvalue)
        {
          ?>
          <li style="margin: 7px 7px 7px 0;">
            <button type="button" class="btn btn-default" onclick="window.open('<?php echo $dvalue["link"]?>', '_blank')"> <a href="#esoftgreat" ><span><i class="fa fa-<?php echo $dvalue['title'];?>"></i></span></a></button>
          </li>
          <?php
        }
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
</nav>