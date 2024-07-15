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

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article>
        <h2><?php the_title(); ?></h2>
        <?php the_content() ?>
    </article>
 <?php endwhile; else: ?>
    <p>Aucun article</p>
 <?php endif; ?>

<?php get_footer(); ?>
