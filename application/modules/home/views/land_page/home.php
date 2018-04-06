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
		<?php
		if($content == 'home/content')
		{
			$this->load->view($content);
		}else{
			?>
			<div class="content-section-b">
				<div class="container">
					<div class="row">
						<?php
						$this->load->view($content);
						?>
					</div>
				</div>
			</div>
			<?php
		}

		?>
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
