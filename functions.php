<?php
/**
 * Piros Furnitures 2016 Theme Functions
 * @package WordPress
 * @subpackage Piros_Furnitures_2016
 * @since Piros Furnitures 2016 1.0
 */
/**
 * Piros Furnitures 2016 only works in WordPress 4.1 or later.
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}

if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('pirosfurnitures2016_setup')) {

    function pirosfurnitures2016_setup() {

// Support Post Formats
        add_theme_support('post-formats', array( 'gallery', ));
// Support Post Thumbnails
        add_theme_support('post-thumbnails');
// Support Custom Background
        add_theme_support('custom-background');
// Support Custom Header
        add_theme_support('custom-header');
// Support Automatic Feed Links
        add_theme_support('automatic-feed-links');
// Support HTML5
        add_theme_support('html5');
// Support Title Tag
        add_theme_support('title-tag');
// Support Editor Style
        add_theme_support('editor-style');
// Support Widgets        
        add_theme_support('widgets');
// Support Menus
        add_theme_support('menus');
// Support JetPack Infinite Scroll
        add_theme_support( 'infinite-scroll',
            array (
                'container' => 'page-content',
//                'render' => 'infinite_loop_render',
//                'footer' => 'content',
        ) );

    }

}
add_action('after_setup_theme', 'pirosfurnitures2016_setup');

function infinite_loop_render(){
    get_template_part('loop');
}

function jetpack_infinite_scroll_query_args( $args ) {
	$args['post_status'] = 'publish';
	$args['post_type'] = 'page';
	$args['posts_per_page'] = 10;

	return $args;
}
add_filter( 'infinite_scroll_query_args', 'jetpack_infinite_scroll_query_args' );

function pirosfurnitures2016_scripts() {
// Load main stylesheet
    wp_enqueue_style('pirosfurnitures2016-style', get_stylesheet_uri());
// Load theme fonts
    wp_enqueue_style('pirosfurnitures2016-font', 'https://fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic');
// Load Font-Awesome
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
// Load theme js script
    $url = get_stylesheet_directory_uri() . '/javascripts/';
    wp_enqueue_script( 'hash-change', "{$url}hashchange.js", array('jquery'), '', true);
    wp_enqueue_script('site-script', get_template_directory_uri() . '/javascripts/pirosfurnitures_scripts.js', array( 'hash-change', 'jquery'));
}

add_action('wp_enqueue_scripts', 'pirosfurnitures2016_scripts');

function pirosfurnitures2016_menus() {
// Theme menus and locations
    register_nav_menus(
            array(
                'primary_menu' => __('Primary Menu', 'piros-furnitures-2016'),
                'secondary_menu' => __('Secondary Menu', 'piros-furnitures-2016'),
                'footer_menu' => __('Footer Menu', 'piros-furnitures-2016'),
                'mobile_menu' => __('Mobile Menu', 'piros-furnitures-2016'),
                'social_media' => __('Social Media Icons', 'piros-furnitures-2016'),
            )
    );
}
add_action( 'after_setup_theme', 'pirosfurnitures2016_menus' );

function pirosfurnitures2016_sidebar(){
    register_sidebar( array (
	'name'          => __( 'Header Contact Widget', 'piros-furnitures-2016' ),
	'id'            => 'contact-widget',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s contact-sidebar">',
	'after_widget'  => '</div>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
    ));
}
add_action( 'widgets_init', 'pirosfurnitures2016_sidebar' ); 

/**
 * Javascript Detection
 * 
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 * 
 * @since Piros Furnitures 2016 1.0
 */
function pirosfurnitures_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'pirosfurnitures_javascript_detection', 0);

/**
 * @since Piros Furnitures 2016 1.0
 * @global type $paged
 * @global type $page
 * @param type $title
 * @param type $sep
 * @return string
 */
function pirosfurnitures_title($title, $sep) {

    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

// Add the site name.
    $title .= get_bloginfo('name');

// Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }
// Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'pirosfurnitures2016'), max($paged, $page));
    }
    return $title;
}

add_filter('wp_title', 'pirosfurnitures_title', 10, 2);

function include_pagecontent($post_slug) {


    $page = get_posts(array(
        'name' => $post_slug,
        'post_type' => 'piros_headline',
    ));

    if ($page) :
        ob_start();
        ?>
        <div class="headline-container">
            <?php
            echo $page[0]->post_content;
        endif;
        ?>
    </div><!-- closing headline -->
    <?php
    $html = ob_get_clean();

    return $html;
}

/**
 * @package WordPress
 * @since Piros Furnitures 2016 1.0
 */
function register_piros_services() {
    $labels = array(
        'name' => _x('Piros Services', 'Post Type General Name', 'piros-furnitures-2016'),
        'singular_name' => _x('Piros Service', 'Post Type Singular Name', 'piros-furnitures-2016'),
        'menu_name' => __('Piros Services', 'piros-furnitures-2016'),
        'name_admin_bar' => __('Piros Services', 'piros-furnitures-2016'),
        'archives' => __('Item Archives', 'piros-furnitures-2016'),
        'parent_item_colon' => __('Parent Item:', 'piros-furnitures-2016'),
        'all_items' => __('All Items', 'piros-furnitures-2016'),
        'add_new_item' => __('Add New Item', 'piros-furnitures-2016'),
        'add_new' => __('Add New', 'piros-furnitures-2016'),
        'new_item' => __('New Item', 'piros-furnitures-2016'),
        'edit_item' => __('Edit Item', 'piros-furnitures-2016'),
        'update_item' => __('Update Item', 'piros-furnitures-2016'),
        'view_item' => __('View Item', 'piros-furnitures-2016'),
        'search_items' => __('Search Item', 'piros-furnitures-2016'),
        'not_found' => __('Not found', 'piros-furnitures-2016'),
        'not_found_in_trash' => __('Not found in Trash', 'piros-furnitures-2016'),
        'featured_image' => __('Featured Image', 'piros-furnitures-2016'),
        'set_featured_image' => __('Set featured image', 'piros-furnitures-2016'),
        'remove_featured_image' => __('Remove featured image', 'piros-furnitures-2016'),
        'use_featured_image' => __('Use as featured image', 'piros-furnitures-2016'),
        'insert_into_item' => __('Insert into item', 'piros-furnitures-2016'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'piros-furnitures-2016'),
        'items_list' => __('Items list', 'piros-furnitures-2016'),
        'items_list_navigation' => __('Items list navigation', 'piros-furnitures-2016'),
        'filter_items_list' => __('Filter items list', 'piros-furnitures-2016'),
    );
    $args = array(
        'label' => __('Piros Service', 'piros-furnitures-2016'),
        'description' => __('Services list of Piros Furnitures', 'piros-furnitures-2016'),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'http://www.omegadesignslive.com/pirosfurnitures/wp-content/themes/pirosfurnitures2016/images/admin/piros_icon.png',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('piros_services', $args);
}

add_action('init', 'register_piros_services', 0);

// Register Custom Post Type
function register_piros_headline() {

    $labels = array(
        'name' => _x('Piros Headlines', 'Post Type General Name', 'piros-furnitures-2016'),
        'singular_name' => _x('Piros Headline', 'Post Type Singular Name', 'piros-furnitures-2016'),
        'menu_name' => __('Piros Headlines', 'piros-furnitures-2016'),
        'name_admin_bar' => __('Piros Headlines', 'piros-furnitures-2016'),
        'archives' => __('Item Archives', 'piros-furnitures-2016'),
        'parent_item_colon' => __('Parent Item:', 'piros-furnitures-2016'),
        'all_items' => __('All Items', 'piros-furnitures-2016'),
        'add_new_item' => __('Add New Item', 'piros-furnitures-2016'),
        'add_new' => __('Add New', 'piros-furnitures-2016'),
        'new_item' => __('New Item', 'piros-furnitures-2016'),
        'edit_item' => __('Edit Item', 'piros-furnitures-2016'),
        'update_item' => __('Update Item', 'piros-furnitures-2016'),
        'view_item' => __('View Item', 'piros-furnitures-2016'),
        'search_items' => __('Search Item', 'piros-furnitures-2016'),
        'not_found' => __('Not found', 'piros-furnitures-2016'),
        'not_found_in_trash' => __('Not found in Trash', 'piros-furnitures-2016'),
        'featured_image' => __('Featured Image', 'piros-furnitures-2016'),
        'set_featured_image' => __('Set featured image', 'piros-furnitures-2016'),
        'remove_featured_image' => __('Remove featured image', 'piros-furnitures-2016'),
        'use_featured_image' => __('Use as featured image', 'piros-furnitures-2016'),
        'insert_into_item' => __('Insert into item', 'piros-furnitures-2016'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'piros-furnitures-2016'),
        'items_list' => __('Items list', 'piros-furnitures-2016'),
        'items_list_navigation' => __('Items list navigation', 'piros-furnitures-2016'),
        'filter_items_list' => __('Filter items list', 'piros-furnitures-2016'),
    );
    $args = array(
        'label' => __('Piros Headline', 'piros-furnitures-2016'),
        'description' => __('Piros Furnitures Headlines', 'piros-furnitures-2016'),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'http://www.omegadesignslive.com/pirosfurnitures/wp-content/themes/pirosfurnitures2016/images/admin/piros_icon.png',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('piros_headline', $args);
}

add_action('init', 'register_piros_headline', 0);

// Register Custom Post Type
function register_piros_frontpageparts() {

    $labels = array(
        'name' => _x('Frontpage Parts', 'Post Type General Name', 'piros-furnitures-2016'),
        'singular_name' => _x('Frontpage Part', 'Post Type Singular Name', 'piros-furnitures-2016'),
        'menu_name' => __('Frontpage Parts', 'piros-furnitures-2016'),
        'name_admin_bar' => __('Frontpage Parts', 'piros-furnitures-2016'),
        'archives' => __('Item Archives', 'piros-furnitures-2016'),
        'parent_item_colon' => __('Parent Item:', 'piros-furnitures-2016'),
        'all_items' => __('All Items', 'piros-furnitures-2016'),
        'add_new_item' => __('Add New Item', 'piros-furnitures-2016'),
        'add_new' => __('Add New', 'piros-furnitures-2016'),
        'new_item' => __('New Item', 'piros-furnitures-2016'),
        'edit_item' => __('Edit Item', 'piros-furnitures-2016'),
        'update_item' => __('Update Item', 'piros-furnitures-2016'),
        'view_item' => __('View Item', 'piros-furnitures-2016'),
        'search_items' => __('Search Item', 'piros-furnitures-2016'),
        'not_found' => __('Not found', 'piros-furnitures-2016'),
        'not_found_in_trash' => __('Not found in Trash', 'piros-furnitures-2016'),
        'featured_image' => __('Featured Image', 'piros-furnitures-2016'),
        'set_featured_image' => __('Set featured image', 'piros-furnitures-2016'),
        'remove_featured_image' => __('Remove featured image', 'piros-furnitures-2016'),
        'use_featured_image' => __('Use as featured image', 'piros-furnitures-2016'),
        'insert_into_item' => __('Insert into item', 'piros-furnitures-2016'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'piros-furnitures-2016'),
        'items_list' => __('Items list', 'piros-furnitures-2016'),
        'items_list_navigation' => __('Items list navigation', 'piros-furnitures-2016'),
        'filter_items_list' => __('Filter items list', 'piros-furnitures-2016'),
    );
    $args = array(
        'label' => __('Frontpage Parts', 'piros-furnitures-2016'),
        'description' => __('Piros Frontpage Parts', 'piros-furnitures-2016'),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'http://www.omegadesignslive.com/pirosfurnitures/wp-content/themes/pirosfurnitures2016/images/admin/piros_icon.png',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('parts', $args);
}

add_action('init', 'register_piros_frontpageparts', 0);

// Page part thumbnail background //
function page_background(){
    global $post;
    if ( has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
        $url = $thumb['0'];
        
        echo "style=\"background: url('$url') no-repeat; background-size: cover;\" class=\"page-has-background\"";
    }
}

function project_categories( $atts ){
    $categories = '';
    $catObj = get_category_by_slug( 'projects' );
    $cat_id = $catObj->term_id;
    
    $args = array('child_of' => $cat_id);
    
    if ( is_category( $cat_id ) ) {
        $categories = get_categories($args);
        foreach($categories as $category) { 
    echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
    echo '<p> Description:'. $category->description . '</p>';
    echo '<p> Post Count: '. $category->count . '</p>';  
}
    }
    return $categories; 

}
add_shortcode( 'project_categories', 'project_categories' );

function services_items( $atts ){
    $args = array(
    'post_type' => 'piros_services',
    'status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
ob_start(); ?>
    
<div class="services-container">
    <div class="services-menu">
    <ul id="services">
        <?php
        $services = new WP_Query( $args );
if( $services->have_posts() ) {
  while ($services->have_posts()) : $services->the_post();      ?>
        
     <li class="service">
         <div class="service-item">
             <h5><a href="<?php the_permalink(); ?>" class="service-link"><?php the_title(); ?></a></h5>
         </div>
            </li>
    <?php
  endwhile;
}
?>
    </ul>
    </div><!-- closing <class:services-menu -->
    <div id="service-details">
    
    </div>
</div>
    <?php $output = ob_get_contents();
 wp_reset_postdata();
 ob_end_clean();
   // Restore global post data stomped by the_post().
 return $output;
}
add_shortcode( 'piros_services', 'services_items' );