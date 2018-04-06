<?php
$site       = $this->config_model->get_config('site');
$site_value = $site['value'];
$site_value = json_decode($site_value,1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $site_value['description'] ?>">
	<meta name="author" content="iwan@esoftgreat.com">
	<title><?php echo $site_value['title'] ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo image_module('config','site/'.@$site_value['image']) ?>">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/animate/animate.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/select2/select2.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>css/util.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'templates/login/';?>css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url().'templates/login/'; ?>images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo base_url('admin/login') ?>" method="post">
					<span class="login100-form-logo">
						<!-- <i class="fa fa-folder-o"></i> -->
						<img src="<?php echo image_module('config','site/'.@$site_value['image']) ?>" style="object-fit: contain;width: 100px;height: auto;border-radius: 50%;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						<?php echo $site_value['title'] ?>
					</span>
					<?php
					if(!empty($msg))
					{
						?>
						<div class="text-center">
							<a class="txt1" href="#" style="color: white; background: pink;">
								<?php
								echo msg($msg,$alert);
								?>
							</a>
						</div>
					 	<?php
					}?>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" value="<?php echo @$_COOKIE['username']; ?>" autofocus>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" value="<?php echo @$_COOKIE['password']; ?>">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember_me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url().'templates/login/';?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url().'templates/login/';?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'templates/login/';?>js/main.js"></script>

</body>
</html>