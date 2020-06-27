	


	<div class="full-bg"></div>

	<div class="container">

	<header>
		<a href="<?php echo home_url(); ?>"><img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="The Seeing Place" /></a>

		<i id="trigger-overlay" class="fa fa-bars"></i>

		<div class="overlay overlay-door">
			<button type="button" class="overlay-close">Close</button>
			<nav>
				<?php wp_nav_menu( array('menu' => 'Primary', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', )); ?>
			</nav>
		</div>
	</header>