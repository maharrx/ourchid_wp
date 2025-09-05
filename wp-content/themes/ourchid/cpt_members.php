<?php
/**
 * Register `members` post type
 */
function members_post_type() {
   
    // Labels
     $labels = array(
         'name' => _x("People", "post type general name"),
         'singular_name' => _x("Member", "post type singular name"),
         'menu_name' => 'People',
         'add_new' => _x("Add New Member", "Member"),
         'add_new_item' => __("Add New Member"),
         'edit_item' => __("Edit Member"),
         'new_item' => __("New Member"),
         'view_item' => __("View Member"),
         'search_items' => __("Search Members"),
         'not_found' =>  __("No Members Found"),
         'not_found_in_trash' => __("No Members Found in Trash"),
         'parent_item_colon' => '',
     );

     $template = array(        
                // array( 'core/image', array() ),
                array( 'core/paragraph', array('placeholder' => 'Email') ),
                array( 'core/paragraph', array('placeholder' => 'Position') ),
                array( 'core/paragraph', array('placeholder' => 'Affiliation') ),
    );

     // Register post type
    register_post_type('members' , array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-media-text',
        'rewrite' => array('slug' => 'people'),
        'supports' => array('gutenberg','title', 'editor', 'thumbnail','excerpt'),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'template' => $template,
        'taxonomies' => array( 'type' ),
        'template_lock' => 'all'
    ) );
 }
 add_action( 'init', 'members_post_type');
 





//  // Let us create Taxonomy for Custom Post Project
add_action( 'init', 'create_members_custom_taxonomy', 0 );
 
// //create a custom taxonomy name it "type" for your posts
function create_members_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Member Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Member Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Member Type' ),
    'all_items' => __( 'All Member Types' ),
    'parent_item' => __( 'Parent Member Type' ),
    'parent_item_colon' => __( 'Parent Member Type:' ),
    'edit_item' => __( 'Edit Member Type' ), 
    'update_item' => __( 'Update Member Type' ),
    'add_new_item' => __( 'Add New Member Type' ),
    'new_item_name' => __( 'New Member Type Name' ),
    'menu_name' => __( 'Member Type' ),
  );  
 
  register_taxonomy('type',array('members'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'member_type' ),
  ));

}

?>