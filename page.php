<?php get_header(); ?>
<section id="<?php echo $post->post_name; ?>" <?php page_background(); ?> >

        <div class="overlay-bg">

        <div class="inner-container">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (have_posts()) : the_post(); ?>
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <?php endif; ?>

                </div><!-- closing <class:inner-content> -->

        </div><!-- closing <class:overlay-bg> -->

        </section><!-- closing <section> -->
<?php get_footer(); ?>