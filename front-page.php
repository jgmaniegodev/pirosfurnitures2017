<?php

get_header();

global $post;

query_posts(array(

    'post_type' => 'page',

    'post_status' => 'publish',

    'order' => 'ASC',

    'orderby' => 'menu_order',

    'post__not_in' => array(3),

    'meta_query' => array(
            array(
                'key' => '_wp_page_template',
                'value' => 'page-loop.php', // template name as stored in the dB
            )
        )

));



?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                 <?php get_template_part('page', 'loop'); ?>

    <?php endwhile; ?>

<?php else: ?>

    <p>Sorry, this page is empty. Please try again later.</p>

<?php endif; ?>



<?php get_footer(); ?> 