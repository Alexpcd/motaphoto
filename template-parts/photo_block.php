<div class="related-photos-section">
                    <div class="related-photos-container">
                        <?php
                        // Récupérer les termes de la taxonomie pour le post actuel
                        $categories = get_the_terms(get_the_ID(), 'categorie');
                        if (!empty($categories) && !is_wp_error($categories)) {
                            $current_category = $categories[0];
                            $related_args = array(
                                'post_type' => 'photo',
                                'posts_per_page' => 2,
                                'order_by_rand' => 'rand',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'categorie',
                                        'field' => 'term_id',
                                        'terms' => $current_category->term_id,
                                    ),
                                ),
                                'post__not_in' => array(get_the_ID()), // Exclure la photo actuelle
                            );

                            // Exécuter la requête pour récupérer les photos apparentées
                            $related_query = new WP_Query($related_args);

                            // Afficher les miniatures des photos apparentées
                            if ($related_query->have_posts()) {
                                while ($related_query->have_posts()) {
                                    $related_query->the_post();
                                    $image_id = get_post_meta(get_the_ID(), 'image', true);
                                    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'desktop-home') : '';
                                    $category_list = get_the_terms(get_the_ID(), 'categorie');
                                    $category_name = $category_list ? esc_html($category_list[0]->name) : 'Uncategorized';
                                    ?>
                                    <div class="related-photo-thumbnail photo-item"><?php
                                            if ($image_url) {
                                                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="photo-thumbnail photo-image" />';
                                            } else {
                                                // Afficher une image de remplacement si aucune miniature n'est disponible
                                                echo '<img src="' . esc_url(get_template_directory_uri()) . '" class="photo-thumbnail photo-image" />';
                                            }
                                            ?>                                            

                            <span class="icon-container">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="photo-info-icon">
                        <i class="fas fa-eye"></i>
                    </a>
                    <span class="fullscreen-icon">
                        <i class="fas fa-expand"></i>
                    </span>
                </span></div>                    
                                    <?php
                                }
                                wp_reset_postdata();
                            } else {
                                echo '<p>Aucune photo apparentée trouvée.</p>';
                            }
                        } else {
                            echo '<p>Erreur de catégorie ou catégorie non trouvée.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>