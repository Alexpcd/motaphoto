<?php get_header() ?>

<?php 
/* Start the Loop */
if (have_posts()): while (have_posts()): the_post(); ?>
<article>
    <h2><?php the_title(); ?></h2>
    <?php the_content() ?>
</article>
<?php endwhile; else: ?>
<p>Aucun article</p>
<?php endif; ?>


<?php get_footer() ?>