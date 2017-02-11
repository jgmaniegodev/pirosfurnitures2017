<div id="service-detail">
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="service-title"><?php the_title(); ?></div>
    <div class="service-item-container">
    <div class="service-thumb"><p><?php the_post_thumbnail(); ?></p></div>
    <div class="service-text"><?php the_content(); ?></div>
    </div>
    <?php endwhile; ?>
    <?php else: ?>
    <p>Sorry, this page seems to be empty. Please try again later.</p>
<?php endif; ?>
    
</div>
