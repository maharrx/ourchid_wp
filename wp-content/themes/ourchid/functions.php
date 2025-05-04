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

//wp_mail(' maharrx@gmail.com', 'Test Email', 'This is a test email.');


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



// Add Department dropdown during registration
add_action('register_form', 'add_department_dropdown');
function add_department_dropdown() {
    $value = (isset($_POST['department'])) ? esc_attr($_POST['department']) : '';
    ?>
    <p>
        <label for="department"><?php _e('Department', 'your-textdomain'); ?><br />
            <select name="department" id="department" required>
                <option value="">Select Department</option>
                <option value="N/A" <?php selected($value, 'N/A'); ?>>N/A</option>
                <option value="Visual Communication" <?php selected($value, 'Visual Communication'); ?>>Visual Communication</option>
                <option value="Art Technology & Culture" <?php selected($value, 'Art Technology & Culture'); ?>>Art Technology & Culture</option>
                <option value="Art History" <?php selected($value, 'Art History'); ?>>Art History</option>
            </select>
        </label>
    </p>
    <?php
}


//Show Editable Field in Admin Profile
add_action('show_user_profile', 'show_edit_department_dropdown');
add_action('edit_user_profile', 'show_edit_department_dropdown');

function show_edit_department_dropdown($user) {
    $department = get_user_meta($user->ID, 'department', true);
    ?>
    <h3>Department Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="department">Department</label></th>
            <td>
                <select name="department" id="department">
                    <option value="">Select Department</option>
                    <option value="VisComm" <?php selected($department, 'VisComm'); ?>>VisComm</option>
                    <option value="Art History" <?php selected($department, 'Art History'); ?>>Art History</option>
                    <option value="ATC" <?php selected($department, 'ATC'); ?>>ATC</option>
                </select>
                <p class="description">Select or update the user's department.</p>
            </td>
        </tr>
    </table>
    <?php
}

//Save Department on Profile Update
add_action('personal_options_update', 'save_department_dropdown_admin');
add_action('edit_user_profile_update', 'save_department_dropdown_admin');

function save_department_dropdown_admin($user_id) {
    if (current_user_can('edit_user', $user_id) && isset($_POST['department'])) {
        update_user_meta($user_id, 'department', sanitize_text_field($_POST['department']));
    }
}


//Validate the Field Input
add_filter('registration_errors', 'validate_department_field', 10, 3);
function validate_department_field($errors, $sanitized_user_login, $user_email) {
    if (empty($_POST['department'])) {
        $errors->add('department_error', __('<strong>ERROR</strong>: Please select a department.', 'your-textdomain'));
    }
    return $errors;
}

//Save the Department to User Meta
add_action('user_register', 'save_department_field');
function save_department_field($user_id) {
    if (!empty($_POST['department'])) {
        update_user_meta($user_id, 'department', sanitize_text_field($_POST['department']));
    }
}

//use it like this:
// $department = get_user_meta($user_id, 'department', true);



//MEMBERS CUSTOM POST TYPE
require get_template_directory().'/cpt_members.php';


//enable selecition of PIs as Co-PIs in research projects
add_action( 'cmb2_admin_init', 'investigator_register_metabox' );

function investigator_register_metabox() {

    $cmb = new_cmb2_box( array(
        'id'           => 'investigators',
        'title'        => 'Investigators',
        'object_types' => array( 'research' ), // post type
        'context'      => 'side', //  'normal', 'advanced', or 'side'
        'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
        'show_names'   => true, // Show field names on the left
    ) );

    // Get all WordPress users
    $users = get_users();
    $user_options = array();
    foreach ($users as $user) {
        $user_options[$user->ID] = $user->display_name;
    }

    // Select PI from the users
    $cmb->add_field( array(
        'name'             => 'Primary Investigator',
        'desc'             => 'Select Primary Investigator',
        'id'               => 'PI_select',
        'cmb_styles'       => false, 
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'custom',
        'options'          => $user_options
    ) );

    // Select primary co-PIs from the users
    $cmb->add_field( array(
        'name'             => 'Other Investigator(s)',
        'desc'             => 'Other Investigator(s)',
        'id'               => 'investigators_select',
        'cmb_styles'       => false, 
        'type'             => 'multicheck',
        'show_option_none' => false,
        'default'          => 'custom',
        'options'          => $user_options
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




}



//RESEARCH CUSTOM POST TYPE
require get_template_directory().'/cpt_research.php';



//RESOURCE CUSTOM POST TYPE
require get_template_directory().'/cpt_resource.php';

//ADD CUSTOM METABOXES
add_action( 'cmb2_admin_init', 'resources_register_metabox' );

function resources_register_metabox() {
    $prefix = '_resources_'; // Prefix for field IDs to avoid name collisions

    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Item Status', 'cmb2' ),
        'object_types'  => array( 'resources' ), // Post type
        'context'       => 'side',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Is this item checked out?', 'cmb2' ),
        'desc'    => __( 'Check if it is checked out.', 'cmb2' ),
        'id'      => $prefix . 'item_checked_out',
        'type'    => 'checkbox',
    ) );
}

// Add custom column for Department
function add_department_column($columns) {
    $columns['department'] = __('Department', 'textdomain');
    return $columns;
}
add_filter('manage_research_posts_columns', 'add_department_column');

// Populate the Department column with data for Research post type
function populate_department_column_research($column, $post_id) {
    if ($column === 'department') {
        $author_id = get_post_field('post_author', $post_id);
        $department = get_user_meta($author_id, 'department', true);
        echo $department ? esc_html($department) : __('N/A', 'textdomain');
    }
}
add_action('manage_research_posts_custom_column', 'populate_department_column_research', 10, 2);



add_filter('manage_resources_posts_columns', 'add_department_column');

// Populate the Department column with data for Resource post type
function populate_department_column_resource($column, $post_id) {
    if ($column === 'department') {
        $author_id = get_post_field('post_author', $post_id);
        $department = get_user_meta($author_id, 'department', true);
        echo $department ? esc_html($department) : __('N/A', 'textdomain');
    }
}
add_action('manage_resources_posts_custom_column', 'populate_department_column_resource', 10, 2);



function load_dashicons(){
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'load_dashicons');