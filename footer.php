</div>
    <footer>
        <?php 
        get_template_part('template-parts/modal'); 
        get_template_part('template-parts/lightbox');
        ?>
        <div class="footer">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'menu_class' => 'footer-menu'
                    ])
                ?>
                <span>TOUS DROITS RÉSERVÉS</span>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>