<?php
/**
 * Register `research` post type
 */
function research_post_type() {
   
    // Labels
     $labels = array(
         'name' => _x("Research", "post type general name"),
         'singular_name' => _x("Project", "post type singular name"),
         'menu_name' => 'Research',
         'add_new' => _x("Add New Project", "Project"),
         'add_new_item' => __("Add New Project"),
         'edit_item' => __("Edit Project"),
         'new_item' => __("New Project"),
         'view_item' => __("View Project"),
         'search_items' => __("Search Research"),
         'not_found' =>  __("No Research Found"),
         'not_found_in_trash' => __("No Research Found in Trash"),
         'parent_item_colon' => '',
     );

     $template = array(
        
                array( 'core/image', array() ),
                array( 'core/paragraph', array('placeholder' => 'Project Description') ),
    );

     // Register post type
    register_post_type('research' , array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-welcome-learn-more',
        'rewrite' => array('slug' => 'research'),
        'supports' => array('gutenberg','title', 'editor', 'thumbnail','excerpt'),
        'show_in_rest' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'template' => $template,
        'taxonomies' => array( 'type' ),
        'template_lock' => 'all'
    ) );
 }
 add_action( 'init', 'research_post_type');
 





//  // Let us create Taxonomy for Custom Post Course
// add_action( 'init', 'create_project_custom_taxonomy', 0 );
 
// //create a custom taxonomy name it "type" for your posts
// function create_project_custom_taxonomy() {
 
//   $labels = array(
//     'name' => _x( 'Type', 'taxonomy general name' ),
//     'singular_name' => _x( 'Course', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Type' ),
//     'all_items' => __( 'All Type' ),
//     'parent_item' => __( 'Parent Course' ),
//     'parent_item_colon' => __( 'Parent Course:' ),
//     'edit_item' => __( 'Edit Course' ), 
//     'update_item' => __( 'Update Course' ),
//     'add_new_item' => __( 'Add New Course' ),
//     'new_item_name' => __( 'New Course Name' ),
//     'menu_name' => __( 'Type' ),
//   );  
 
//   register_taxonomy('type',array('project'), array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'type' ),
//   ));

// }

?>