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

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="entry-title">
	    <a href="<?php the_permalink(); ?>">
	    	<?php the_title(); ?>
	    </a>
	</h2>

    <?php the_excerpt(); ?>
</article>