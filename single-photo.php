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

 get_header(); ?>

 <main id="main-container" class="main-site">
 <?php if (have_posts()) : ?>
     <?php while (have_posts()) : the_post(); ?>  
         <div class="post">
             <div class="post-top-container">
                 <div class="post-left-container">
                     <h2 class="post-left-container__title"><?php the_title(); ?></h2>
                     <div class="post-left-container__fields">
                         <ul>
                             <li>Référence : <?php the_field('reference'); ?></li>
                             <li>Catégorie : <?php echo strip_tags(get_the_term_list($post->slug, 'categorie')); ?></li>
                             <li>Format : <?php echo strip_tags(get_the_term_list($post->slug, 'format')); ?></li>
                             <li>Type : <?php the_field('type'); ?></li>
                             <li>Année : <?php echo get_the_date('Y'); ?></li>
                         </ul>
                     </div>
                 </div>
 
                 <div class="post-right-container">
                     <div class="post__image photo-item">
                         <?php 
                         $image_id = get_post_meta(get_the_ID(), 'image', true);
                         $image_url = wp_get_attachment_image_url($image_id, 'desktop-home');
                         if ($image_id) {
                             echo '<img src="' . esc_url($image_url) . '" class="photo-image">';
                         }
                         ?>
                         </div>
                </div>
            </div>

            <div class="post-center-container">
                <div class="post__contact">
                    <div class="post-contact-content">
                        <p>Cette photo vous intéresse ?</p>
                        <button class="open-contact-modal contactLink" data-reference="<?php the_field('reference'); ?>">Contact</button>
                    </div>
                </div>

            <div class="post__navigation">
                    <div class="post-navigation__previous-thumbnail">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) {
                            $prev_image_id = get_post_meta($prev_post->ID, 'image', true);
                            if ($prev_image_id) {
                                $prev_image_url = wp_get_attachment_image_url($prev_image_id, 'single-photo-thumbnail-size');
                                if ($prev_image_url) {
                                    echo '<img src="' . esc_url($prev_image_url) . '" class="photo-thumbnail">';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="post-navigation__next-thumbnail">
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) {
                            $next_image_id = get_post_meta($next_post->ID, 'image', true);
                            if ($next_image_id) {
                                $next_image_url = wp_get_attachment_image_url($next_image_id, 'single-photo-thumbnail-size');
                                if ($next_image_url) {
                                    echo '<img src="' . esc_url($next_image_url) . '" class="photo-thumbnail">';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="post-navigation__arrows">
                        <div class="post-navigation__previous-arrow">
                            <?php previous_post_link('%link', '&#10229;'); ?>
                        </div>
                        <div class="post-navigation__next-arrow">
                            <?php next_post_link('%link', '&#10230;'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
         <div class="bottom-container">
         <h3>VOUS AIMEREZ AUSSI</h3>
        </div>
        <div><?php include('template-parts/photo_block.php'); ?></div>
    <?php endwhile; ?>
<?php endif; ?>
</main>

<?php get_footer(); ?>
