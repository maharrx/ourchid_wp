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


 /**
 * Filter the excerpt length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function theme_slug_excerpt_length( $length ) {
    if ( is_admin() ) {
            return $length;
    }
    return 40;
}
add_filter( 'excerpt_length', 'theme_slug_excerpt_length', 999 );

 
// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Read More</a>';
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





//enable selecition of PIs as Co-PIs in research projects
add_action( 'cmb2_admin_init', 'investigator_register_metabox' );

function investigator_register_metabox() {

    $cmb = new_cmb2_box( array(
        'id'           => 'investigarors',
        'title'        => 'Investigarors',
        'object_types' => array( 'research' ), // post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'
        'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
        'show_names'   => true, // Show field names on the left
    ) );

    // get the members
    $args = array('post_type' => 'members', 'post_per_page' => -1);
    $loop = new WP_Query($args);
    if($loop->have_posts()) {  
        while($loop->have_posts()) : $loop->the_post();
            //
            $varID = get_the_id();
            $varName = get_the_title();
            $pageArray[$varID]=$varName;
        endwhile;   
    }
    // Select PI from the members
    $cmb->add_field( array(
        'name'             => 'Primary Investigator',
        'desc'             => 'Select Primary Investigator',
        'id'               => 'PI_select',
        'cmb_styles'        => false, 
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'custom',
        'options'          => $pageArray
    ) );

    // Select primary co-PIs from the members
    $cmb->add_field( array(
        'name'             => 'Other Investigator(s)',
        'desc'             => 'Other Investigator(s)',
        'id'               => 'investigators_select',
        'cmb_styles'        => false, 
        'type'             => 'multicheck',
        'show_option_none' => false,
        'default'          => 'custom',
        'options'          => $pageArray
    ) );

}


//enable funding


add_action( 'cmb2_admin_init', 'funding_register_metabox' );

function funding_register_metabox() {

    $cmb = new_cmb2_box( array(
		'id'            => 'funding_repeater',  // Belgrove Bouncing Castles
		'title'         => 'Funding',
		'object_types'  => array( 'research', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false, // Show field names on the left
	) );


    $group_field_id = $cmb->add_field( array(
        'id'          => 'funding_repeat_group',
        'type'        => 'group',
        // 'description' => __( 'Generates reusable form entries', 'cmb2' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'Funding {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Entry', 'cmb2' ),
            'remove_button'     => __( 'Remove Entry', 'cmb2' ),
            'sortable'          => true,
            'closed'         => false, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );
    
    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Funding Title',
        'id'   => 'title',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'URL',
        'description' => 'URL of the funding',
        'id'   => 'url',
        'type' => 'text_url',
    ) );
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Entry Image',
        'id'   => 'image',
        'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        )
    ) );


    // // Add funding
    // $funding_group_id = $cmb->add_field( array(
	// 	'id'          => 'funding_source',
	// 	'type'        => 'group',
	// 	'repeatable'  => true,
	// 	'options'     => array(
	// 		'group_title'   => 'Funding {#}',
	// 		'add_button'    => 'Add Another Funding',
	// 		'remove_button' => 'Remove Funding',
	// 		'closed'        => false,  // Repeater fields closed by default - neat & compact.
	// 		'sortable'      => true,  // Allow changing the order of repeated groups.
    //         'remove_confirm' => esc_html__( 'Are you sure you want to remove this?', 'cmb2' ), // Performs confirmation before removing group.
            
	// 	),
	// ) );

    // $cmb->add_group_field( $funding_group_id, array(
	// 	// 'name' => 'Funding Source',
	// 	'desc' => 'Enter the title for the Funding.',
	// 	'id'   => 'title',
	// 	'type' => 'text',
	// ) );
	
    // $cmb->add_group_field( $funding_group_id, array(
	// 	// 'name' => 'Funding URL',
	// 	'desc' => 'Enter the url of the funding.',
	// 	'id'   => 'url',
	// 	'type' => 'text_url',
	// ) );
    
    // $cmb->add_group_field( $funding_group_id, array(
    //     // 'name' => 'Funding image',
    //     'desc' => 'Upload an image/logo of the funding',
    //     'id'   => 'image',
    //     'type' => 'file_list',
    //     'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    //     'query_args' => array( 'type' => 'image' ), // Only images attachment
    //     // Optional, override default text strings
    //     'text' => array(
    //         'add_upload_files_text' => '+', // default: "Add or Upload Files"
    //         'remove_image_text' => 'Remove', // default: "Remove Image"
    //         'file_text' => 'Replacement', // default: "File:"
    //         // 'file_download_text' => 'Replacement', // default: "Download"
    //         'remove_text' => 'Remove', // default: "Remove"
    //     ),
    // ) );



}