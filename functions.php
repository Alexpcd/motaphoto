<?php

// Emplacement de menu //
function register_my_menus() {
   register_nav_menus(
   array(
   'header-menu' => __( 'Menu Header' ),
   'footer-menu' => __( 'Menu Footer' ),
   )
   );
  }
add_action( 'init', 'register_my_menus' );

function add_scripts() {
  
// Fichier CSS principal
wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/style.css' );
 
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );

?>