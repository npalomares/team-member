<?
/*
Plugin Name: EK Team Members
Plugin URI: http://www.evenkeeltattoo.com
Description: Team member custom post type. <strong>Requires <a href="http://wordpress.org/extend/plugins/meta-box/">Meta Box.</a></strong>
Version: 1.0
Author: Nicholas Palomares
Author URI: http://www.evenkeeltattoo.com/
License: All Rights Reserved
*/
require("inc/post_type.php");
//require("inc/meta_boxes.php");
require("inc/taxonomy.php");
require("inc/shortcodes.php");
//require("inc/admin.php");

function tm_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );

    //register slideshow css
    wp_register_style( 'tmStyle', $plugin_url . 'inc/css/tm_styles.css' );
    wp_enqueue_style( 'tmStyle' );
	
	//load javascript    
    //wp_register_script( 'slideshowScript', $plugin_url . 'inc/js/tm.js' );
    //wp_enqueue_script( 'slideshowScript' );
}
add_action( 'wp_enqueue_scripts', 'tm_scripts' );
?>
