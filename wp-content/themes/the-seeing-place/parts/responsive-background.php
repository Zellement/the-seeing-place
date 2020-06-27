	<?php 

	$customLarge = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square-x-large' );
	$displayLarge = $customLarge['0'];

	$customMedium = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square-large' );
	$displayMedium = $customMedium['0'];

	if ( has_post_thumbnail() ) : ?>

		<style>

			.full-bg {
				background-image: url(<?php echo $displayMedium; ?>);
			}

			@media (min-width: 600px) {
				.full-bg {background-image: url(<?php echo $displayLarge; ?>);
			}

		</style>

	<?php endif; ?>