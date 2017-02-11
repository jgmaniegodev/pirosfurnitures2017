<?php
/*
 * Template Name: Services Template
 */

$args = array(
    'post_type' => 'piros_services',
    'orderby' => 'menu_order',
    'status' => 'publish',
);
?>
<div class="services-container">
    <ul id="services">
        <?php
        $my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) : $my_query->the_post(); ?>
        
     <li class="service">
         <?php the_post_thumbnail(); ?>
                <h3><?php the_title(); ?></a></h3>
                <?php the_content(); ?>
            </li>
    <?php
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
    </ul>
</div>