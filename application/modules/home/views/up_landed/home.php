<!DOCTYPE HTML>
<html>
	<head>
		<?php $this->load->view('home/meta'); ?>
	</head>
	<body class="landing">
		<div id="page-wrapper">
			<header id="header">
				<?php $this->load->view('home/top') ?>
			</header>
			<?php
			if($content == 'home/content')
			{
				?>
				<section id="banner">
					<?php $this->load->view('home/header') ?>
				</section>
				<section id="one" class="spotlight style1 bottom">
					<?php $this->load->view('home/bottom') ?>
				</section>
				<section id="two" class="spotlight style2 right">
					<?php
					$this->load->view('home/right');
					?>
				</section>
				<section id="three" class="spotlight style3 left">
					<?php
					$this->load->view('home/left')
					?>
				</section>
				<section id="four" class="wrapper style1 special fade-up">
					<?php $this->load->view('home/portofolio'); ?>
				</section>
				<section id="five" class="wrapper style2 special fade-up">
					<?php $this->load->view('subscribe'); ?>
				</section>
				<?php
			}else{
				?>
				<div id="main" class="wrapper style1">
					<div class="container">
						<?php
						$this->load->view($content);
						?>
					</div>
				</div>
				<?php
			}
			?>
			<footer id="footer">
				<?php $this->load->view('home/footer'); ?>
			</footer>
		</div>
		<!-- Scripts -->
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/jquery.scrolly.min.js"></script>
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/jquery.dropotron.min.js"></script>
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/jquery.scrollex.min.js"></script>
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/skel.min.js"></script>
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="<?php echo base_url().'templates/up_landed/';?>assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="<?php echo base_url().'templates/up_landed/';?>assets/js/main.js"></script>
		<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap.min.js"></script>
		<?php
		$this->esg->js();
		?>
	</body>
</html>