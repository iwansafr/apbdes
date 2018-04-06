<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  <span class="sr-only">Toggle navigation</span>
</a>
<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">

    <li class="dropdown user user-menu">
    	<?php
			$user_data = $this->session->userdata('logged_in');
			?>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      	<?php
				if(!empty($user_data['image']))
				{
					?>
					<img src="<?php echo image_module('user', $user_data['id'].'/'.$user_data['image']) ?>" class="user-image">
	        <span class="hidden-xs"><?php echo $user_data['username'] ?></span>
					<?php
				}else{
					?>
					<i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $this->session->userdata['logged_in']['username'] ?> </span>
					<?php
				}
				?>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
		      <?php
					if(!empty($user_data['image']))
					{
						?>
						<img src="<?php echo image_module('user', $user_data['id'].'/'.$user_data['image']) ?>" class="img-circle">
						<p><?php echo $user_data['username'] ?></p>
						<?php
					}else{
						?>
						<i class="fa fa-user"></i> <p><?php echo $this->session->userdata['logged_in']['username'] ?> </p>
						<?php
					}
					?>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-xs-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Friends</a>
            </div>
          </div>
          <!-- /.row -->
          <div class="row">

          </div>
          <div class="row">
            <div class="col-xs-12 text-center">
              <a href="<?php echo base_url() ?>" class="btn btn-default btn-flat" target="_blank">
                  Visit Site
              </a>
            </div>
          </div>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="<?php echo base_url('admin/user_edit/'.$user_data['id']); ?>" class="btn btn-default btn-flat">Profile</a>
          </div>
          <div class="pull-right">
            <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
          </div>
        </li>
      </ul>
    </li>
    <li>
      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
  </ul>
</div>