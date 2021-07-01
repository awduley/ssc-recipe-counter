<?php
/*
Plugin Name: Recipe Counter
Plugin URI: https://crookedfallstudios.com
Description: Plugin to create a widget that keeps count of how many recipes are in whatever categories we choose.
Version: 1.0.0
Author: Andrew Duley
Author URI: https://crookedfallstudios.com
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Load scripts
require_once( plugin_dir_path(__FILE__) . '/includes/recipe-counter-scripts.php' );

// Load class
require_once( plugin_dir_path(__FILE__) . '/includes/recipe-counter-class.php' );

// Register widget
function register_recipe_counter() {
  register_widget( 'Recipe_Counter_Widget' );
}
add_action( 'widgets_init', 'register_recipe_counter' );