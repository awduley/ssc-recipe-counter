<?php 
// Enqueue scripts and styles
function rc_add_scripts() {

  // Add main CSS
  wp_enqueue_style( 'main-css', plugins_url() . '/recipe-counter/css/rc-main.css', [], '1.0.0', 'all' );

  // Add main JS
  wp_enqueue_script( 'main.js', plugins_url() . '/recipe-counter/js/main.js', [], '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'rc_add_scripts' );