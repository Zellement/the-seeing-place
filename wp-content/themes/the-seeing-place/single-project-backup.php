<?php
/**
 * The Template for displaying all single posts
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

			<div class="row project-title">

				<p class="breadcrumbs">
					<a href="<?php echo site_url(); ?>/projects">Projects</a>
					&raquo;
					<?php the_taxonomies(array('template' => '% %l')); ?>
					&raquo;
					<?php the_title(); ?>
					</p>

				<h2><?php the_title(); ?></h2>

				<p>Completed <?php the_field('project_date'); ?></p>

			</div>

			<div class="row project-description">

				<?php the_field('description'); ?>

				<ul class="next-prev">
					<li class="prev"><?php next_post_link( '%link', '&laquo; Previous' ); ?></li>
					<li class="next"><?php previous_post_link( '%link', 'Next &raquo;' ); ?></li>
					<li class="back"><a href="<?php echo site_url(); ?>/projects">Back to Projects</a></li>
				</ul>

			</div>

		</div>

		<div class="col gallery">

		<?php 

			$images = get_field('images');

			if( $images ): ?>
			    <ul class="bxslider">
			        <?php foreach( $images as $image ): ?>
			            <li>
			                <img src="<?php echo $image['sizes']['square-large']; ?>" alt="<?php echo $image['alt']; ?>" />

			                <p><?php echo $image['caption']; ?></p>
			            </li>
			        <?php endforeach; ?>
			    </ul>

			<?php else : ?>
				<ul class="bxslider">
				<li><img class="whoops" src="<?php echo get_stylesheet_directory_uri(); ?>/img/whoops.png" /></li>
				</ul>

			<?php endif; ?>

		</div>

		<div class="construction">

		<?php 

			$images = get_field('construction');

			if( $images ): ?>

				<h2>Design &amp; Construction</h2>

				<?php the_field('dc_info'); ?>

			        <?php foreach( $images as $image ): ?>

		                <a rel="lightbox[gallery-0]" href="<?php echo $image['url']; ?>">
		                     <img src="<?php echo $image['sizes']['square-medium']; ?>" alt="<?php echo $image['alt']; ?>" />
		                </a>

			        <?php endforeach; ?>

			<?php endif; ?>

			</div>

	<?php endwhile; ?>
	
</article>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>