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

	add_action( 'wp_enqueue_scripts', 'script_enqueuer' );


	add_filter( 'body_class', 'add_slug_to_body_class' );

	if ( ! function_exists(my_body_class) ) {
add_filter('body_class', 'my_body_class');
function my_body_class($classes) {
if ( is_page('cp-work') || is_home() ) { 
	$classes[] = 'index_page'; 
}
if ( is_page('work-archive') ) { 
	$classes[] = "archive_page";
	$classes[] = "work";
}
if ( is_page('cp-work')) {
	$classes[] = 'work';
}
if ( 'work' == get_post_type() && is_single() ) {
	$classes[] = 'view';
	$classes[] = 'work';
}

return $classes;
}
}

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */

	 add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'work',
		array(
		'label' => __('Work'),
		'public' => true,
		'has_archive' => true,
		'singular_name' => work,
		'show_ui' => true,
		'menu_position' => 5,
		'supports' => array('title','editor')
		)
	);
}

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
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
		<?php endif; ?>
		</li>
		<?php 
	}

	/* ========================================================================================================================
	
	Custom Fields
	
	======================================================================================================================== */

	/**
	* Adding Runtime to media uploads */

/**
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
 
function runtime_field( $form_fields, $post ) {
	$form_fields['runtime-value'] = array(
		'label' => 'Runtime',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'runtime-value', true ),
		'helps' => 'Enter a runtime for the video',
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'runtime_field', 10, 2 );

/**
 * Save values runtime-value and URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function runtime_field_save( $post, $attachment ) {
	if( isset( $attachment['runtime-value'] ) )
		update_post_meta( $post['ID'], 'runtime-value', $attachment['runtime-value'] );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'runtime_field_save', 10, 2 );

// Register Sidebar
    register_sidebar();

    // disable the admin bar (front end only)
  add_filter('show_admin_bar', '__return_false');
  
  
 // custom menu example @ http://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_menus() {
	$menu_name = 'primary'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<div id="vertical_nav">' ."\n";
		$menu_list .= "\t\t\t\t". '<ul>' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		$menu_list .= "\t\t\t". '</div>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}

// add Client Login link to nav

add_filter('wp_nav_menu_items','custom_login_link', 10, 2);
function custom_login_link( $items, $args ) {
    return $items.'<li id="vertical_nav_client_login"><a href="http://postspots.com/job_login.php?p=centralplanning" onclick="popup_window(\'http://postspots.com/job_login.php?p=centralplanning\',\'\',\'scrollbars=yes,width=800,height=500\'); return false;"><span>CLIENT LOGIN</span></a></li>';
}

// Add current class to Work nav item if page == work archive, or single work post

add_filter( 'nav_menu_css_class', 'work_nav_star', 10, 2 );
function work_nav_star( $classes, $item ){ 
if  ( ( (is_page('work-archive')) || ('work' == get_post_type()) ) &&  ($item->title == 'Work') ) {
    $classes[] = 'current-menu-item';
}
    return $classes;
}
