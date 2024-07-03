<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage None
 * @since Themeperso 1.0
 */

/*
Template Name: Accueil
*/

get_header(); ?>


<div class="hero-header">
    <?php 
        // Configuration de la requête
        $the_query = new WP_Query(array( 
            'orderby' => 'rand',
            'posts_per_page' => 1,                   
            'post_type' => 'photo',                  
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',           
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
        ));
                
        // Boucle WordPress
        if ($the_query->have_posts()) {               
            while ($the_query->have_posts()) {       
                $the_query->the_post();               
                the_post_thumbnail();                 // Afficher l'image mise en avant du post
            } 
            // Réinitialise les données du post
            wp_reset_postdata();                      
        } else {
            // Aucun post trouvé
            echo '<p>Aucune photo trouvée.</p>';      
        }
    ?>
        <div class="titre-header">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/titre-header.png'); ?>" alt="Photographe event"> <!-- Affiche l'image du titre -->
    </div>
</div>
<?php get_footer(); ?>
