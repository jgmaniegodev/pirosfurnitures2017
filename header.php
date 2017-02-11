<?php
/**
 * Piros Furnitures 2016
 * @package WordPress
 * @subpackage Piros_Furnitures_2016
 * @since Piros Furnitures 2016 1.0
 */
?>
<!DOCTYPE html>
<html <?php get_language_attributes(); ?>>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="<?php bloginfo('charset'); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <title><?php wp_title('&raquo', true, 'right'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="site">
            <div id="headerbg-overlay">
                <div id="headerbg">
                    <header id="page-header">
                        <div class="inner-container">
                            <div id="branding">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/piros_furnitures_logo.png" />
                                <span class="logo-shadow"></span>
                            </div>
                            <div class="contact-sidebar">
                            <?php if (!dynamic_sidebar('contact-widget')) : ?>
                                <?php dynamic_sidebar( 'contact-widget' ); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </header><!-- closing <header> -->
                    <nav id="navigation">
                        <div class="inner-container">
                            <button type="button" id="menu-bar"><i class="fa fa-bars"></i> MENU</button>
                            <?php
                            wp_nav_menu(array(
                                'menu' => 'Primary Menu',
                                'menu_id' => 'primary-menu',
                                'container_class' => 'primary-nav'
                            ));

                            wp_nav_menu(array(
                                'menu' => 'Social Media Icons',
                                'menu_id' => 'social-media-menu',
                                'container_class' => 'social-media-nav',
                            ));
                            ?>

                        </div>
                    </nav><!-- closing <nav> -->
                    <section id="headline">
                        <div class="inner-container">
                            <?php echo include_pagecontent('custom-made-quality-furnitures'); ?>
                        </div>
                    </section><!-- closing <section id:headline> -->
                </div><!-- closing <headerbg> -->
            </div><!-- closing <headerbg-overlay> -->