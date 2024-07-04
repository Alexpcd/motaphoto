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
<?php    // Requète pour obtenir les 8 photos
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
    ?>
<section class="photo-list-section">
            <div class="photo-list-container">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="post__image photo-item">
                            <?php
                            // récupérer l'ID
                            $image_id = get_post_meta(get_the_ID(), 'image', true);

                            // vérifier si l'ID existe
                            if ($image_id) {
                                // récupérer l'URL
                                $image_url = wp_get_attachment_image_url($image_id, 'desktop-home');

                                if ($image_url) {
                                    // afficher l'image
                                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="photo-image">';
                                } else {
                                    echo '<p>No image available.</p>';
                                }
                            } else {
                                echo '<p>No image available.</p>';
                            }
                            ?>
                        <span class="icon-container">
                            <span class="photo-reference">
                                <?php
                                $reference = get_post_meta(get_the_ID(), 'reference', true);
                                if ($reference) {
                                    echo esc_html($reference);
                                }
                                
                                ?>
                            </span>
                            <span class="photo-category">
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'categorie');
                                if ($categories) {
                                    echo esc_html($categories[0]->name);
                                }
                                ?>
                            </span>
                            <span>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="photo-info-icon">
                    <i class="fa-regular fa-eye" style="color: #FFFFFF;"></i>
                    </a>
                    <span class="fullscreen-icon">
                        <i class="fas fa-expand" style="color: #FFFFFF;"></i>
                    </span>
                </span>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <div class="load-more-container">
                <button id="load-more-button">Charger plus</button>
            </div>
        </section>
        <?php else :
        echo 'Aucune photo trouvée.';
    endif;
    ?>
    </main>
<?php get_footer(); ?>
