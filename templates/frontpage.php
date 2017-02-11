<?php
/**
 * Template Name: Front-page Template
 * @since Piros Furnitures 2016 1.0
 */
global $post;
query_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'exclude' => array( 'home' ),
));
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section id="<?php echo $post->post_name; ?>">
    <div id="content" class="inner-container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
    </div>
</section><!-- closing <section> -->
  <?php endwhile; ?>
            <?php else: ?>
                <p>Sorry, this page is empty. Please try again later.</p>
            <?php endif; ?>

<?php get_footer(); ?>
