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
  
// Fichier CSS + scripts
wp_enqueue_style( 'main-css', get_template_directory_uri() . '/style.css' );

// Enqueue modale script
wp_enqueue_script( 'modale-script', get_template_directory_uri() . '/js/modale.js', array(), '1.2', true );

}

add_action( 'wp_enqueue_scripts', 'add_scripts');

// Ajout option de thème 
function themesupport() {
  
add_theme_support('post-thumbnails');

}

add_action('after_setup_theme', 'themesupport');

?>

