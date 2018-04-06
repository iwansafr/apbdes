<?php
if(!empty($contact))
{
	$contact_value = $contact['value'];
	$contact_value = json_decode($contact_value,1);
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 class="section-heading"><?php echo $contact_value['title'] ?></h2>
				<hr class="primary">
				<p><?php echo $contact_value['description'] ?></p>
			</div>
			<div class="col-lg-4 col-lg-offset-2 text-center">
				<i class="fa fa-envelope-o fa-3x sr-contact"></i>
				<p><a href="mailto:<?php echo $contact_value['email'] ?>"><?php echo $contact_value['email'] ?></a></p>
			</div>
			<div class="col-lg-4 text-center">
				<i class="fa fa-google-plus fa-3x sr-contact"></i>
				<p><a href=""><?php echo $contact_value['gplus'] ?></a></p>
			</div>
			<div class="col-lg-12 text-center">
				<i class="fa fa-phone fa-3x sr-contact"></i>
				<p><?php echo $contact_value['phone'] ?></p>
			</div>
			<div class="col-lg-4 col-lg-offset-2 text-center">
				<i class="fa fa-facebook fa-3x sr-contact"></i>
				<p><a href=""><?php echo $contact_value['facebook'] ?></a></p>
			</div>
			<div class="col-lg-4 text-center">
				<i class="fa fa-twitter fa-3x sr-contact"></i>
				<p><a href=""><?php echo $contact_value['twitter'] ?></a></p>
			</div>
		</div>
	</div>
	<?php
}