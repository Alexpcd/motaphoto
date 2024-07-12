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

// Enqueue script
wp_enqueue_script('jquery');
wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/js/load-more.js', array('jquery'), '', true);
wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/js/filter.js', array('jquery'), null, true);

wp_localize_script('load-more-photos', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php'),
));

wp_localize_script('ajax-filter', 'afp_vars', array(
    'afp_nonce' => wp_create_nonce('afp_nonce'), // Crée une nonce, qui est ensuite associée à la requête
    'afp_ajax_url' => admin_url('admin-ajax.php')
));
}
add_action( 'wp_enqueue_scripts', 'add_scripts');



/*** Ajout option de thème  ***/
function themesupport() {
add_theme_support('post-thumbnails');

}
add_action('after_setup_theme', 'themesupport');



/***  Ajax ***/


// Fonction pour charger plus de photos
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



// Fonction pour charger les photos via les filtres

function filter_and_sort_photos() {
    // Initialiser le tableau de requête des taxonomies avec une relation 'AND'
    $taxonomy_query = array('relation' => 'AND');

    // Définir les taxonomies personnalisées à utiliser pour les filtres
    $custom_taxonomies = ['categorie', 'format'];

    // Boucle sur chaque taxonomie personnalisée pour vérifier si elle est définie dans $_POST
    foreach ($custom_taxonomies as $custom_taxonomy) {
        if (isset($_POST[$custom_taxonomy]) && !empty($_POST[$custom_taxonomy])) {
            // Ajouter une condition de taxonomie au tableau de requête des taxonomies
            $taxonomy_query[] = array(
                'taxonomy' => $custom_taxonomy,
                'field' => 'slug',
                'terms' => $_POST[$custom_taxonomy],
            );
        }
    }

    // Créer une nouvelle requête WP_Query avec les filtres appliqués
    $ajax_filters = new WP_Query([
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => $_POST['date'],
        'tax_query'      => $taxonomy_query,
    ]);

    // Initialiser la variable de réponse
    $response = '';

    // Vérifier si la requête a des posts
    if ($ajax_filters->have_posts()) {
        while ($ajax_filters->have_posts()) {
            $ajax_filters->the_post();
            // Ajouter le template-part de chaque post trouvé à la réponse
            $response .= get_template_part('template-parts/photo_block', 'photo');
        }
    } else {
        // Si aucun post n'est trouvé, afficher un message d'aucun résultat
        echo '<p class="no-photo">Aucun résultat</p>';
    }

    // Afficher la réponse (les posts filtrés)
    echo $response;
    // Réinitialiser les données post
    wp_reset_postdata();
    // Terminer le script pour éviter toute autre sortie
    exit;
}

// Ajouter l'action pour gérer les requêtes AJAX pour les utilisateurs connectés
add_action('wp_ajax_filter_and_sort_photos', 'filter_and_sort_photos');
// Ajouter l'action pour gérer les requêtes AJAX pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_filter_and_sort_photos', 'filter_and_sort_photos');