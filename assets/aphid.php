<?php
/**
 * A lot of head clean up and setup is from http://themble.com/bones/
 *
 */

add_action( 'after_setup_theme', 'run_after_setup', 16 );

function run_after_setup() {
    // launching operation cleanup
    add_action( 'init', 'head_cleanup' );
    // remove WP version from RSS
    add_filter( 'the_generator', 'rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'gallery_style' );

    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'scripts_and_styles', 999 );
    // ie conditional wrapper

    // launching this stuff after theme setup
    theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'reg_sidebars' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'wpsearch' );

    // cleaning up random code around images
    add_filter( 'the_content', 'remove_ptags_around_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'excerpt_more' );

}

function head_cleanup() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */


// remove WP version from RSS
function rss_version() { return ''; }

// remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
   if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/********************* WP Enqueue *********************/

function scripts_and_styles() {
  global $wp_styles;
  if (!is_admin()) {

    wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/js/vendor/modernizr.min.js', array(), '', false );

    // register main stylesheet
    wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

    //adding scripts file in the footer
    wp_register_script( 'js', get_stylesheet_directory_uri() . '/assets/js/main.min.js', array(), '', true );

  	wp_deregister_script('jquery');
  	wp_register_script('jquery', "//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js", array(), '', true);

    wp_enqueue_script( 'modernizr' );
    wp_enqueue_style( 'stylesheet' );

    wp_enqueue_script('jquery');
    wp_enqueue_script( 'js' );

  }
}

/********************* Theme Support *********************/

function theme_support() {

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(150, 150, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// adding wp menus support
	add_theme_support( 'menus' );

	// registering menu locations
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'bonestheme' ) // secondary nav in footer
		)
	);
}


/********************* Menus ********************/
// Bones http://themble.com/bones/ setup
// the main menu
function main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'nav',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    	'menu_class' => 'nav main-nav',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'main_nav_fallback'      // fallback function
	));
} /* end bones main nav */

// the footer menu (should you choose to use one)
function footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    	'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'footer_links_fallback'  // fallback function
	));
} /* end bones footer link */

// this is the fallback for header menu
function main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'nav top-nav clearfix',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}


// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function remove_ptags_around_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

?>