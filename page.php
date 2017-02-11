<?php get_header(); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Sorry, this page is empty. Please try again later.</p>
            <?php endif; ?>
<?php get_footer(); ?>