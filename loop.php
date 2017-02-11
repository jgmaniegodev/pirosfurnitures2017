<section id="page-content">
    <div class="inner-container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Sorry, this page is empty. Please try again later.</p>
            <?php endif; ?>
        </article>
    </div>
</section><!-- closing <section> -->