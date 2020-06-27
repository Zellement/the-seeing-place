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
 * Template Name: Projects
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/responsive-background' ) ); ?>

<article>

<?php $loop = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => 999 ) ); ?>

<h2>Projects</h2>

<ul class="projects-list">

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

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
	
</article>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>