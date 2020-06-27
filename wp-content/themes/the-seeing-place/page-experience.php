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
 * Template Name: Experience
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/responsive-background' ) ); ?>

<article>

	<div class="details-experience">

	<h2><?php the_title(); ?></h2>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

			<?php

				if( get_field('experience') ): ?>

					<?php while( has_sub_field('experience') ): ?>

						<div class="details-experience-individual">

						<h3><?php the_sub_field('title'); ?></h3>
						<h4><?php the_sub_field('company_freelance'); ?></h4>
						<h5><?php the_sub_field('area'); ?> | <?php the_sub_field('year'); ?>
							<?php if (get_sub_field('still_ongoing')) : ?>
							- Present
							<?php endif; ?></h5>

						<?php the_sub_field('additional_info'); ?>

						</div>

					<?php endwhile; ?>

				<?php endif;

				?>

				<div class="details-experience-individual">
				<?php the_field('qualifications_skills'); ?>
				</div>
		
		<?php endwhile; ?>

	</div>
	
</article>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>