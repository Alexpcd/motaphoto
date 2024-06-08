</div>
    <footer>
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
        <?php get_template_part( 'template-parts/modal.php' ); ?>
    </footer>
</body>
</html>