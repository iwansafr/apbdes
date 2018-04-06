<?php defined('BASEPATH') OR exit('No direct script access allowed');
$header_value = $header['value'];
$header_value = json_decode($header_value,1);
if(!empty($header_value['image']))
{
	?>
	<style type="text/css">
		header{
			background: url(<?php echo image_src('config/header', $header_value['image'], $header['id']) ; ?>);
		}
	</style>
	<?php
}
?>
<div class="header-content">
	<div class="header-content-inner">
		<h1 id="homeHeading"><?php echo $header_value['title'] ?></h1>
		<hr>
		<p><?php echo $header_value['description'] ?></p>
		<a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
	</div>
</div>