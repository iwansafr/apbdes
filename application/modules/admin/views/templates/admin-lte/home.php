<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('admin/header');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <?php $this->load->view('admin/logo');?>
    <nav class="navbar navbar-static-top">
    	<?php $this->load->view('admin/top_menu');?>
    </nav>
  </header>
  <aside class="main-sidebar">
  	<?php $this->load->view('admin/sidebar_menu');?>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
    	<?php $this->load->view('admin/heading'); ?>
    </section>
    <div class="row">
    	<hr>
    	<div class="col-md-1">

    	</div>
    	<div class="col-md-10">
		    <?php
				if(!empty($config_alert))
				{
					echo msg($config_alert, 'danger');
				}
					$data['msg']    = @$msg;
					$data['alert']  = @$alert;
					$data['module'] = @$module;
					$data['task']   = @$task;
					$this->load->view($content, $data);
					// pr(@($this->session));
				?>
    	</div>
    	<div class="col-md-1">

    	</div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <!-- <b>Version</b> 2.3.12 -->
    </div>
    <strong>Supported by <a href="http://esoftgreat.com">esoftgreat</a></strong>
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <?php
        // $this->load->view('admin/config/templates');
        ?>
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">

      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
$this->load->view('admin/footer');
$esg = new esg();
$esg->js();
?>
</body>
</html>
