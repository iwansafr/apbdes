<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('home/meta');?>
	</head>
	<body>
		<div class="container" style="box-shadow: 0 0 3px #CACACA;">
			<div class="top">
				<div class="menu-top">
					<div class="row no-margin">
						<?php echo $this->load->view('home/top'); ?>
					</div>
				</div>
				<hr>
				<div class="logo main_color">
					<?php echo $this->load->view('home/logo'); ?>
				</div>
			</div>
			<div class="menu hidden-sm hidden-xs">
				<?php echo $this->load->view('home/menu'); ?>
			</div>
			<div class="breaking_news hidden-xs hidden-sm">
				<?php echo $this->load->view('home/news'); ?>
			</div>
			<div class="clearfix"></div>
			<hr>
			<div class="main">
				<div class="row">
					<div class="col-md-8">
						<?php
					 	$this->load->view($content);
					 	?>
					</div>
					<div class="col-md-4">
						<?php echo $this->load->view('home/right') ?>
					</div>
				</div>
			</div>
			<hr>
			<footer>
		    <?php echo $this->load->view('home/bottom'); ?>
				<div class="row footer_bottom">
					<?php $this->load->view('home/footer') ?>
				</div>
			</footer>
		</div>
		<script src="<?php echo base_url().'templates/public/vendor/'; ?>jquery/jquery.min.js"></script>
		<script src="<?php echo base_url().'templates/public/vendor/'; ?>bootstrap/js/bootstrap.min.js"></script>
		<?php
		// $link_js = @$this->session->userdata('link_js');
		// if(!empty($link_js))
		// {
		// 	echo '<script src="'.$link_js.'"></script>';
		// }
		// echo $this->session->userdata('js_extra');
		js();
		?>
	</body>
</html>
