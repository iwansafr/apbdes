<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		$data['site'] = @$site;
		$this->load->view('home/meta', $data);
		?>
	</head>
	<body id="page-top">

		<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
			<?php $this->load->view('home/top') ?>
		</nav>

		<header>
			<?php echo $this->load->view('home/header') ?>
		</header>

		<section class="bg-primary" id="about">
			<?php echo $this->load->view('home/about') ?>
		</section>

		<section id="services">
			<?php echo $this->load->view('home/content') ?>
		</section>

		<section class="no-padding" id="portfolio">
			<?php echo $this->load->view('home/portofolio') ?>
		</section>

		<aside class="bg-dark">
			<div class="container text-center">
				<div class="call-to-action">
					<h2>Free Download at Start Bootstrap!</h2>
					<a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a>
				</div>
			</div>
		</aside>

		<section id="contact">
			<?php echo $this->load->view('home/contact') ?>
		</section>
		<footer style="background: #222;">
			<?php
			$this->load->view('home/footer');
			?>
		</footer>
		<script src="<?php echo base_url().'templates/creative_page/'; ?>vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url().'templates/creative_page/'; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
		<script src="<?php echo base_url().'templates/creative_page/'; ?>vendor/scrollreveal/scrollreveal.min.js"></script>
		<script src="<?php echo base_url().'templates/creative_page/'; ?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo base_url().'templates/creative_page/'; ?>js/creative.min.js"></script>
	</body>
</html>
