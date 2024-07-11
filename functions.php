<?php

/*** Emplacement de menu ***/
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
wp_enqueue_script('jquery');
wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/js/load-more.js', array('jquery'), '', true);
    
wp_localize_script('load-more-photos', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    
));
}
add_action( 'wp_enqueue_scripts', 'add_scripts');



/*** Ajout option de thème  ***/
function themesupport() {
add_theme_support('post-thumbnails');

}
add_action('after_setup_theme', 'themesupport');



/***  Ajax ***/


// Fonction pour charger plus de photos via AJAX
function load_more_photos() {

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $_POST['paged'],
    );

    $query = new WP_Query($args);

  $response = '';
    $max_pages = $query->max_num_pages;


    if ($query->have_posts()) {
 ob_start();
        while ($query->have_posts()) :
            $query->the_post();
            $response .= get_template_part('template-parts/photo_block', 'photo');
        endwhile;
         $output = ob_get_contents();
    ob_end_clean();
    }
    else {
        $response='';
    }
    $result = [
        'max' => $max_pages,
        'html' => $output,
      ];
    
     echo json_encode($result);
     exit;
    }
    
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
