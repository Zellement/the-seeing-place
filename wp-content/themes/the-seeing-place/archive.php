<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts() 
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/responsive-background' ) ); ?>

<section>

<h2>Projects: <?php the_taxonomies(array('template' => '% %l')); ?></h2>

<ul class="projects-list">

<?php while ( have_posts() ) : the_post(); ?>

		<li><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">

		<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('square-medium');
			}
			else {
				echo '<img src="'. get_stylesheet_directory_uri() . '/img/whoops.png" />';
			}
		?>

    	<span class="title"><?php the_title(); ?></span>
    	</a>

    	<span class="category"><?php the_taxonomies(array('template' => '% %l')); ?></span>
    	</li>

<?php endwhile; ?>

</ul>
	
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>