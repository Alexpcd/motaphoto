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
            } 
            else {
                echo '<p>No image available.</p>';
            }
        } 
        else {
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
        <i class="fa-regular fa-eye fa-xl" style="color: #FFFFFF;"></i>
    </a>
    <span class="fullscreen-icon">
        <i class="fas fa-expand" style="color: #FFFFFF;"></i>
    </span>
    </span>
</div>
