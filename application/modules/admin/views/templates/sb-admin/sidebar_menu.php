<ul class="nav navbar-nav side-nav">
	<?php
  foreach ($menu as $key => $value)
  {
    if(!empty($value['list']))
    {
      ?>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#<?php echo $value['title'] ?>">
        	<i class="fa fa-fw <?php echo $value['icon'] ?>"></i> <?php echo $value['title'] ?> <i class="fa fa-fw fa-caret-down"></i>
      	</a>
        <ul class="collapse" id="<?php echo $value['title'] ?>">
          <?php
          foreach ($value['list'] as $vkey => $vvalue)
          {
            ?>
            <li><a href="<?php echo $vvalue['link'] ?>"><i class="fa <?php echo $vvalue['icon'] ?>"></i> <?php echo $vvalue['title'] ?></a></li>
            <?php
          }?>
        </ul>
      </li>
      <?php
    }else{
      ?>
      <li>
        <a href="<?php echo $value['link'] ?>">
          <i class="fa <?php echo $value['icon'] ?>"></i> <span><?php echo $value['title'] ?></span>
        </a>
      </li>
      <?php
    }
  }
  ?>
</ul>