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

<main>
<section>
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
</section>
<section class="photo-list-section">
<?php    // Requète pour obtenir les 8 photos
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
		'order'=> 'DESC',
		'paged'=> 1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
    ?>
            <div class="photo-list-container">
                <?php 
                while ($query->have_posts()) : $query->the_post(); 
                get_template_part('template-parts/photo_block', 'photo');
                endwhile;
                wp_reset_postdata(); 
                ?>
            </div>
        </section>
        <div class="load-more-container">
                <button id="load-more-button">Charger plus</button>
            </div>
        <?php else :
        echo 'Aucune photo trouvée.';
    endif;
    ?>
    </main>
<?php get_footer(); ?>
