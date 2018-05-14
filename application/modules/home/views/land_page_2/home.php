<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$this->load->view('home/meta');
	?>
</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
			<?php
		 	$this->load->view('home/top');
			?>
		</nav>
		<a name="about"></a>
		<div class="intro-header">
			<?php
			$this->load->view('home/header');
			?>
		</div>
		<a  name="popular"></a>

		<div class="content-section-b">
			<div class="container">
				<div class="row">
					<div class="row" style="padding: 10px;">
						<div class="row">
							<?php
							$this->load->view('apbdes/pendapatan');
							?>
						</div>
						<div class="col-md-9" class="pull-right-md">
							<?php
							$this->load->view($content);
							?>
						</div>
						<div class="col-md-3" class="pull-left-md">
							<?php
							$this->load->view('home/left');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<a  name="contact"></a>
		<?php
	 	$this->load->view('home/bottom');
	 	?>
		<footer>
			<?php
			$data['site'] = @$site;
			$this->load->view('home/'.$active_template.'/footer', $data);
			?>
		</footer>
		<script src="<?php echo base_url().'templates/admin/'; ?>js/jquery.js"></script>
		<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url().'templates/admin/'; ?>js/script.js"></script>
		<?php
		$this->session->set_userdata('link_js', base_url().'templates/'.$active_template.'/'.'js/'.'script.js');
		$this->esg->js();
		?>
	</body>
</html>
