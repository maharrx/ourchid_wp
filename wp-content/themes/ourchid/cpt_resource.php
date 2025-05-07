<?php
/**
 * Register `resources` post type
 */
function resources_post_type() {
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
        'not_found' => __("No Item Found"),
        'not_found_in_trash' => __("No Item Found in Trash"),
    );

    register_post_type('resources', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-kitchensink',
        'rewrite' => array('slug' => 'resource'),
        'supports' => array('title', 'thumbnail', 'excerpt', 'author'),
        'show_in_rest' => true,
        'capability_type' => ['resource', 'resources'],
        'map_meta_cap' => true,
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

    $roles = ['author', 'administrator'];
    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            $capabilities = [
                'edit_resource', 'read_resource', 'delete_resource',
                'edit_resources', 'publish_resources', 'edit_published_resources',
                'delete_published_resources', 'edit_others_resources',
                'read_private_resources', 'delete_resources',
                'delete_private_resources', 'delete_others_resources',
                'edit_private_resources'
            ];
            foreach ($capabilities as $cap) {
                $role->add_cap($cap);
            }
        }
    }
}
add_action('init', 'resources_post_type');

function register_cmb2_meta_boxes() {
    $prefix = '_resources_';

    // External Link Meta Box
    $cmb_external_link = new_cmb2_box(array(
        'id' => $prefix . 'external_link_metabox',
        'title' => __('External Link', 'cmb2'),
        'object_types' => array('resources'),
        'context' => 'side',
        'priority' => 'default',
    ));

    $cmb_external_link->add_field(array(
        'name' => __('External Link', 'cmb2'),
        'id' => $prefix . 'external_link',
        'type' => 'text_url',
        'desc' => __('Enter the external link URL.', 'cmb2'),
    ));

    // Description Meta Box
    $cmb_description = new_cmb2_box(array(
        'id' => $prefix . 'description_metabox',
        'title' => __('Description', 'cmb2'),
        'object_types' => array('resources'),
        'context' => 'normal',
        'priority' => 'default',
    ));

    $cmb_description->add_field(array(
        'name' => __('Description', 'cmb2'),
        'id' => $prefix . 'description',
        'type' => 'textarea',
        'desc' => __('Enter a short description for the resource.', 'cmb2'),
    ));

    // Item Status Meta Box
    $cmb_item_status = new_cmb2_box(array(
        'id' => $prefix . 'item_checked_out_metabox',
        'title' => __('Item Status', 'cmb2'),
        'object_types' => array('resources'),
        'context' => 'side',
        'priority' => 'high',
    ));

    $cmb_item_status->add_field(array(
        'name' => __('Is this item checked out?', 'cmb2'),
        'id' => $prefix . 'item_checked_out',
        'type' => 'checkbox',
        'desc' => __('Check if it is checked out.', 'cmb2'),
    ));
}
add_action('cmb2_admin_init', 'register_cmb2_meta_boxes');

// Register a custom taxonomy for the resources post type
function register_resource_taxonomy() {
    $labels = array(
        'name' => _x('Resource Types', 'taxonomy general name'),
        'singular_name' => _x('Resource Type', 'taxonomy singular name'),
        'search_items' => __('Search Resource Types'),
        'all_items' => __('All Resource Types'),
        'parent_item' => __('Parent Resource Type'),
        'parent_item_colon' => __('Parent Resource Type:'),
        'edit_item' => __('Edit Resource Type'),
        'update_item' => __('Update Resource Type'),
        'add_new_item' => __('Add New Resource Type'),
        'new_item_name' => __('New Resource Type Name'),
        'menu_name' => __('Resource Types'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'resource-type'),
    );

    register_taxonomy('resource_type', array('resources'), $args);
}
add_action('init', 'register_resource_taxonomy');