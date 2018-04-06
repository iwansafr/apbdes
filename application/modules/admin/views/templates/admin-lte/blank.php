<!DOCTYPE html>
<html>
	<head>
	 <?php
	 	$site            = $this->config_model->get_config('site');
		$data['site']    = @$site;
	  $this->load->view('admin/header', $data); ?>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<?php $this->load->view('admin/logo'); ?>
				</div>
				<ul class="nav navbar-right top-nav">
					<?php $this->load->view('admin/top_menu'); ?>
				</ul>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php $this->load->view('admin/sidebar_menu'); ?>
				</div>
			</nav>
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php $this->load->view('admin/heading'); ?>
					<?php
						// $this->session->unset_userdata('link_js');
						// pr($this->session->user);
						msg($msg,$alert);
						// pr(@($this->session));
					?>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer'); ?>
	</body>
</html>