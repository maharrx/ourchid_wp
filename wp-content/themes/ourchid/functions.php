<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
/**
 * Proper way to enqueue scripts and styles
 */
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );
add_theme_support( 'post-thumbnails' );
// Add support for responsive embeds.
add_theme_support( 'responsive-embeds' );
// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );


// random color
add_action('wp_head', 'rand_colors', 100);
function rand_colors(){        
    // Declare an associative array
    $arr = array( 
            //"a"=>"<style>:root{ --color-primary: #ff5317;--color-secondary: #ffdece;}</style>", 
            "b"=>"<style>:root{ --color-primary: #22006f;--color-secondary: #daf7ee;}</style>", 
            "c"=>"<style>:root{ --color-primary: #841617;--color-secondary: #fffdf1;}</style>",
            //"d"=>"<style>:root{ --color-primary: #0041a0;--color-secondary: #fff4c0;}</style>",
        );
    //Use shuffle function to randomly assign numeric
    shuffle($arr);    
    // // Display the first shuffle element of array
    echo $arr[0];
}

function raju_styles() { 
	wp_enqueue_style( 'basscss', get_template_directory_uri() . '/basscss.css');
	wp_enqueue_style( 'font-playfair', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700', false );
	wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800', false );
	wp_enqueue_style( 'css', get_stylesheet_uri());    
}
add_action( 'wp_enqueue_scripts', 'raju_styles' );



// register nav
register_nav_menus(
    array(
    'primary-menu' => __( 'Primary Menu' ),
    'secondary-menu' => __( 'Secondary Menu' )
    )
);

// Adding class to menu > li 
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
  

/**
* Add li > a class menu
*/
function add_additional_class_on_a( $atts, $item, $args ) {
    $class = 'nav-link py1 center block'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
 }
 add_filter( 'nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3 );

 
// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});

require get_template_directory().'/cpt_members.php';
require get_template_directory().'/cpt_research.php';

