<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <header id="" class="site-header">
		<nav id="" class="main-navigation">
            <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) );?>"> <img class="menu__logo" src="<?php echo get_stylesheet_directory_uri() . '/images/logo.svg'; ?> " alt="logo du site Nathalie Mota"></img></a></div>
            <div>  
                    <?php   wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'menu-header'
                    ]) 
                    ?> 
            </div>

            <div id="icons"></div>

		</nav>
    </header>

<div class="container">