<?php
/**
 * Register `resources` post type
 */
function resources_post_type() {
   
    // Labels
     $labels = array(
         'name' => _x("Resources", "post type general name"),
         'singular_name' => _x("Item", "post type singular name"),
         'menu_name' => 'Resources',
         'add_new' => _x("Add New Item", "Item"),
         'add_new_item' => __("Add New Item"),
         'edit_item' => __("Edit Item"),
         'new_item' => __("New Item"),
         'view_item' => __("View Item"),
         'search_items' => __("Search Item"),
         'not_found' =>  __("No Item Found"),
         'not_found_in_trash' => __("No Item Found in Trash"),
         'parent_item_colon' => '',
     );

     $template = array(        
                // array( 'core/image', array() ),
                array( 'core/paragraph', array('placeholder' => 'Item description') ),
                array( 'core/paragraph', array('placeholder' => 'External link to the product (E.g., https://www.meta.com/quest/quest-3s)') ),
    );

     // Register post type
     register_post_type('resources', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-kitchensink',
        'rewrite' => array('slug' => 'resource'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'template' => $template,
        'template_lock' => 'all',
        'taxonomies' => array('type'),
        'capability_type' => ['resource', 'resources'], // plural and singular
        'map_meta_cap' => true, // This must be true!
        'capabilities' => array(
            'edit_post' => 'edit_resource',
            'read_post' => 'read_resource',
            'delete_post' => 'delete_resource',
            'edit_posts' => 'edit_resources',
            'edit_others_posts' => 'edit_others_resources',
            'publish_posts' => 'publish_resources',
            'read_private_posts' => 'read_private_resources',
        ),
    ));

    // Ensure authors can edit and delete their own resource posts
    $role = get_role('author');
    if ($role) {
        $role->add_cap('edit_resource');
        $role->add_cap('read_resource');
        $role->add_cap('delete_resource');
        $role->add_cap('edit_resources');
        $role->add_cap('publish_resources');
        $role->add_cap('edit_published_resources');
        $role->add_cap('delete_published_resources');
    }
 }
 add_action( 'init', 'resources_post_type');
 





// //  // Let us create Taxonomy for Custom Post Project
// add_action( 'init', 'create_project_custom_taxonomy', 0 );
 
// // //create a custom taxonomy name it "type" for your posts
// function create_project_custom_taxonomy() {
 
//   $labels = array(
//     'name' => _x( 'Project Type', 'taxonomy general name' ),
//     'singular_name' => _x( 'Project Type', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Project Type' ),
//     'all_items' => __( 'All Project Types' ),
//     'parent_item' => __( 'Parent Project Type' ),
//     'parent_item_colon' => __( 'Parent Project Type:' ),
//     'edit_item' => __( 'Edit Project Type' ), 
//     'update_item' => __( 'Update Project Type' ),
//     'add_new_item' => __( 'Add New Project Type' ),
//     'new_item_name' => __( 'New Project Type Name' ),
//     'menu_name' => __( 'Project Type' ),
//   );  
 
//   register_taxonomy('type',array('project'), array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'project_type' ),
//   ));

// }

?>