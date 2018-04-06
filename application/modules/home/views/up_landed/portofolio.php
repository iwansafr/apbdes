<?php
$data_config = get_block_config('portofolio', $config_template);
$category    = $this->esg->get_cat($data_config['id']);
$data        = $this->esg->get_content($data_config['where'], 6);
?>
<div class="container">
	<header class="major">
		<h2><?php echo $category['title'] ?></h2>
		<p><?php echo $category['description'] ?></p>
	</header>
	<div class="box alt">
		<div class="row uniform">
			<?php
			foreach ($data as $key => $value)
			{
				?>
				<section class="4u 6u(medium) 12u$(xsmall)">
					<span class="icon alt major <?php echo $value['icon'] ?>"></span>
					<h3><?php echo $value['title'] ?></h3>
					<p><?php echo $value['content'] ?></p>
				</section>
				<?php
			}
			?>
			<!-- <section class="4u 6u$(medium) 12u$(xsmall)">
				<span class="icon alt major fa-comment"></span>
				<h3>Eleifend lorem ornare</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section>
			<section class="4u 6u$(medium) 12u$(xsmall)">
				<span class="icon alt major fa-comment"></span>
				<h3>Eleifend lorem ornare</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section>
			<section class="4u$ 6u(medium) 12u$(xsmall)">
				<span class="icon alt major fa-flask"></span>
				<h3>Cubilia cep lobortis</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section>
			<section class="4u 6u$(medium) 12u$(xsmall)">
				<span class="icon alt major fa-paper-plane"></span>
				<h3>Non semper interdum</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section>
			<section class="4u 6u(medium) 12u$(xsmall)">
				<span class="icon alt major fa-file"></span>
				<h3>Odio laoreet accumsan</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section>
			<section class="4u$ 6u$(medium) 12u$(xsmall)">
				<span class="icon alt major fa-lock"></span>
				<h3>Massa arcu accumsan</h3>
				<p>Feugiat accumsan lorem eu ac lorem amet accumsan donec. Blandit orci porttitor.</p>
			</section> -->
		</div>
	</div>
	<footer class="major">
		<ul class="actions">
			<li><a href="<?php echo content_cat_link($category['slug']) ?>" class="button">Read More</a></li>
		</ul>
	</footer>
</div>