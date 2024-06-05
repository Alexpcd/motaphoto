</div>
    <footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer menu',
        'container' => false,
        'menu_class' => 'menu-footer'
    ])
    ?>
    </footer>
    <?php wp_footer() ?>
</body>
</html>