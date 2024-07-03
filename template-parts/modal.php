<!-- Template de la popup "modal" -->

<div id="contactModal" class="modale-overlay">
    <div class="modale-global">    
        <div class="modale-header">
            <span class="closeBtn">X</span>
            <img class="img_contact_modale" src="<?php echo get_template_directory_uri() . '/images/Contact-header.png'; ?>" alt="Titre de la modale de contact">
        </div>
        <div class="modale">
            <?php echo do_shortcode('[contact-form-7 id="636d14e" title="Contact form 1"]');?>
        </div>
    </div>
</div>