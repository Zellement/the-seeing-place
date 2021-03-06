<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/responsive-background' ) ); ?>

<article>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div class="col details">

			<div class="row">

				<h2><?php the_title(); ?></h2>

				<?php the_content(); ?>

			</div>

		</div>

		<div class="col image">

		<?php 

			$image = get_field('profile_picture');
			$size = 'square-x-large'; // (thumbnail, medium, large, full or custom size)

			if( $image ) {

				echo wp_get_attachment_image( $image, $size );

			}

		?>

		</div>
	
	<?php endwhile; ?>
	
</article>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>