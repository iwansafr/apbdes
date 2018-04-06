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
			if($content == 'home/content')
			{
				$this->load->view('home/header');
			}
			?>
		</div>
		<a  name="popular"></a>

		<div class="content-section-b">
			<div class="container">
				<div class="row">
					<hr>
					<div class="row" style="padding: 10px;">
						<div class="col-md-9 pull-right">
							<?php
							$this->load->view($content);
							?>
						</div>
						<div class="col-md-3 pull-left">
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
		<?php
		$this->session->set_userdata('link_js', base_url().'templates/'.$active_template.'/'.'js/'.'script.js');
		$this->esg->js();
		?>
	</body>
</html>
