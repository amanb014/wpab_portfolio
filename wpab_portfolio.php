<?php
/*
Plugin Name: Portfolio Management
Plugin URI: http://amanbhimani.com
Description: A plugin to manage experience, projects, and portfolio items and display with shortcodes on the front-end.
Version: 0.1
Author: Aman Bhimani
Author URI: http://amanbhimani.com/
*/

define('WP_DEBUG', true);
if( !defined('ABSPATH')) {
  exit;
}

//Function that loads in the admin scripts whenever the admin pages "post" and "post-new" are loaded. 
//The styles and scripts in this are loading the CSS/JS for the particular forms that the admin edits.
function wpab_portfolio_admin_scripts() {
  //These varibales allow us to target the post type and the post edit screen.
  global $pagenow, $typenow;
  if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'book' ) {
    //Plugin Main CSS File.
    wp_enqueue_style( 'readinglist-css', plugins_url( 'scripts/css/wpab_portfolio_admin.css', __FILE__ ) );
  }
}

//Function that loads the public CSS for the display of the portfolio items. These will be used in the shortcodes.
function wpab_public_scripts() {
	wp_enqueue_style( 'readinglist-css', plugins_url( 'scripts/css/wpab_portfolio_public.css', __FILE__ ) );
}

//Hook into the admin_enqueue_scripts, and wp_head for loading the scripts
add_action('admin_enqueue_scripts', 'wpab_portfolio_admin_scripts');
add_action('wp_head', 'wpab_public_scripts');

/*===========================
	SEGREGATED FUNCTIONS 
===========================*/

//Registers the skill taxonomy with wordpress. This is registered under both experience and projects.
require_once(plugin_dir_path(__FILE__) . 'wpab_skill_taxonomy.php');

//Loads in the file for creating a new custom post type called "projects".
require_once(plugin_dir_path(__FILE__) . 'wpab_cpt_projects.php');

//Loads in the file for creating a new custom post type called "experience".
require_once(plugin_dir_path(__FILE__) . 'wpab_cpt_experience.php');



?>