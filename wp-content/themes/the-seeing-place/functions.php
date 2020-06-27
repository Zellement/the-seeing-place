<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );


	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		
		// overall theme js file
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
		
		// add jquery to theme
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http://code.jquery.com/jquery-1.9.1.min.js", false, null);
		wp_enqueue_script('jquery');
		
		/** import theme style.css **/
		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
		
		/** import scripts required for responsive goodness **/
		wp_enqueue_style( 'custom',  get_template_directory_uri().'/css/custom.css', '', '', 'screen' );
		
		wp_enqueue_style( 'fontawesome',  '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '', '', 'screen' );
		wp_enqueue_style( 'sourceserif',  'http://fonts.googleapis.com/css?family=Source+Serif+Pro:400,700', '', '', 'screen' );
		
		// nav
		wp_register_script( 'modernizr.custom', get_template_directory_uri().'/js/modernizr.custom.js' );
		wp_enqueue_script( 'modernizr.custom' );
		
		// nav
		wp_register_script( 'jquery.bxslider.min', get_template_directory_uri().'/js/jquery.bxslider.min.js' );
		wp_enqueue_script( 'jquery.bxslider.min' );
		
		// classie
		wp_register_script( 'classie', get_template_directory_uri().'/js/classie.js' );
		wp_enqueue_script( 'classie' );
		
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	/* ========================================================================================================================

	Sidebars

	======================================================================================================================== */

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar 1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
	}
	
	/* ========================================================================================================================

	Misc.

	======================================================================================================================== */
	
	// Hide annoying frontend toolbar
	add_filter('show_admin_bar', '__return_false'); 

	
	/* ========================================================================================================================

	Custom image sizes

	======================================================================================================================== */

	add_image_size( 'square-medium', 300, 300, true ); 
	add_image_size( 'square-large', 800, 800, true ); 
	add_image_size( 'square-x-large', 1500, 1500, true ); 




	// Register Custom Post Type
	function project_post_type() {

		$labels = array(
			'name'                => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Projects', 'text_domain' ),
			'name_admin_bar'      => __( 'Post Type', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Project:', 'text_domain' ),
			'all_items'           => __( 'All Projects', 'text_domain' ),
			'add_new_item'        => __( 'Add New Project', 'text_domain' ),
			'add_new'             => __( 'New Project', 'text_domain' ),
			'new_item'            => __( 'New Item', 'text_domain' ),
			'edit_item'           => __( 'Edit Project', 'text_domain' ),
			'update_item'         => __( 'Update Project', 'text_domain' ),
			'view_item'           => __( 'View Project', 'text_domain' ),
			'search_items'        => __( 'Search projects', 'text_domain' ),
			'not_found'           => __( 'No projects found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No projects found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'project', 'text_domain' ),
			'description'         => __( 'Project information pages', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-image',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'project', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'project_post_type', 0 );


// Register Custom Taxonomy
function project_types_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Project Types', 'text_domain' ),
		'all_items'                  => __( 'All Project Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Project Type', 'text_domain' ),
		'add_new_item'               => __( 'Add Project Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Project Type', 'text_domain' ),
		'update_item'                => __( 'Update Project Type', 'text_domain' ),
		'view_item'                  => __( 'View Project Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'project-types', array( 'project' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'project_types_taxonomy', 0 );


/**
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  // Hide the editor on the page titled 'Pr'
  $homepgname = get_the_title($post_id);
  if($homepgname == 'Projects'){ 
    remove_post_type_support('page', 'editor');
  }

  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  if($template_file == 'my-page-template.php'){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}



// CUSTOM ADMIN LOGIN HEADER LOGO
 
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-wp-admin.png);
            padding-bottom: 140px;
            height: auto;
            width: 500px;
            max-width: 300px;
            background-size: 250px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );