<?php

/*
 * Template Name: Frontpage section
 */

global $post;

?>

        <section id="<?php echo $post->post_name; ?>" <?php page_background(); ?> >

        <div class="overlay-bg">

        <div class="inner-container">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <?php the_content(); ?>



                </div><!-- closing <class:inner-content> -->

        </div><!-- closing <class:overlay-bg> -->

        </section><!-- closing <section> -->

<?php wp_reset_postdata(); ?>