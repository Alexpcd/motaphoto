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


// function add_last_nav_item($items) {
//   return $items .= '<li><a href="#myModal" role="button" id="myBtn" data-toggle="myModal">Contact</a></li>';
// }
// add_filter('wp_nav_menu_items','add_last_nav_item');

function add_scripts() {
  
// Fichier CSS + scripts
wp_enqueue_style( 'main-css', get_template_directory_uri() . '/style.css' );
wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );



?>

