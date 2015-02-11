<?php
require_once( 'assets/aphid.php' ); // if you remove this, bones will break

require_once( 'assets/admin.php' ); // this comes turned off by default


/************* IMAGE SIZE OPTIONS *************\
/*
	From the Wordpress codex 
	add_image_size( $name, $width, $height, $crop );
*/

add_image_size( 'aphid-thumb', 300, 300, true );
// add_image_size( 'aphid-example', 650, 9999, false );


/************* SIDEBARS ********************/

function reg_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'aphid' ),
		'description' => __( 'The first (primary) sidebar.', 'aphid' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	// Just copy above code for more sidebar widgets

}



/************* SEARCH FORM LAYOUT *****************/

// Search Form
function wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'aphid' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'aphid' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!

//Add code to the end of a single post  
// function example_append_post_content( $content ) {
 
//     if ( is_single() ) {
 
//         $html = '<div class="post-suffix">';
//             $html .= 'This content will appear at the end of a post.';
//         $html .= '</div>';
 
//         $content .= $html;
//     }
 
//     return $content;
 
// }
// add_filter( 'the_content', 'example_append_post_content' );

// //if user is an admin, redirect them to the dashboard. Otherwise redirect them to the homepage.
// function example_login_redirect( $redirect_to, $request, $user  ) {
//     return ( isset( $user->roles ) && is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? home_url( '/wp-admin/' ) : home_url();
// } // end soi_login_redirect
// add_filter( 'login_redirect', 'example_login_redirect', 10, 3 );


function showMessage($message, $errormsg = false)
{
	if ($errormsg) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated fade">';
	}
	echo "<p><strong>$message</strong></p></div>";
} 

/* Display a notice that can be dismissed */
add_action('admin_notices', 'message_admin_notice');
function message_admin_notice() {
	global $current_user ;
		if ( is_admin() ) {
      $user_id = $current_user->ID;
			if ( ! get_user_meta($user_id, 'license_ignore_notice') ) {
        echo '<div class="updated"><p>';
        printf(__('You can find this text on in the functions.php file'), '?message_nag_ignore=0');
        echo "</p></div>";
			}
		}
}

add_action('admin_init', 'message_nag_ignore');
function message_nag_ignore() {
	global $current_user; 
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['message_nag_ignore']) && '0' == $_GET['message_nag_ignore'] ) {
             add_user_meta($user_id, 'license_ignore_notice', 'true', true);
				}
}


?>