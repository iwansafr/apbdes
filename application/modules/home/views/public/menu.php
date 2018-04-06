<?php defined('BASEPATH') OR exit('No direct script access allowed');
$data_config  = get_block_config('menu_left', $config_template);
$menu_middle  = $this->content_model->get_data_menu($data_config['table'], $data_config['id']);
$data_config  = get_block_config('menu_right', $config_template);
$middle_right = $this->content_model->get_data_menu($data_config['table'], $data_config['id']);
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span><i class="fa fa-home"></i></span></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        if(!empty($menu_middle))
        {
          foreach ($menu_middle as $menu_middle_k => $menu_middle_v)
          {
            $sub_menu = $this->content_model->get_data_menu('menu', $menu_middle_v['id']);
            if(empty($sub_menu))
            {
              ?>
              <li><a href="<?php echo $menu_middle_v['link'] ?>"><?php echo $menu_middle_v['title'] ?></a></li>
              <?php
            }else{
              ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu_middle_v['title'] ?> <span class="caret"></span></a>
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
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if(!empty($middle_right))
        {
          foreach ($middle_right as $middle_right_k => $middle_right_v)
          {
            $sub_menu = $this->content_model->get_data_menu('menu', $middle_right_v['id']);
            if(empty($sub_menu))
            {
              ?>
              <li><a href="<?php echo $middle_right_v['link'] ?>"><?php echo $middle_right_v['title'] ?></a></li>
              <?php
            }else{
              ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $middle_right_v['title'] ?> <span class="caret"></span></a>
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
        }
        ?>
      </ul>
    </div>
  </div>
</nav>