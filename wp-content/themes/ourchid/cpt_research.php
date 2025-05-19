<?php
/**
 * Register `research` post type
 */
function research_post_type() {
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
        'not_found' => __("No Research Found"),
        'not_found_in_trash' => __("No Research Found in Trash"),
    );

    register_post_type('research', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'rewrite' => array('slug' => 'research'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'show_in_rest' => true,
        // 'capability_type' => ['research', 'researches'],
        // 'map_meta_cap' => true,
        // 'capabilities' => array(
        //     'edit_post' => 'edit_research',
        //     'read_post' => 'read_research',
        //     'delete_post' => 'delete_research',
        //     'edit_posts' => 'edit_researches',
        //     'edit_others_posts' => 'edit_others_researches',
        //     'publish_posts' => 'publish_researches',
        //     'read_private_posts' => 'read_private_researches',
        // ),
    ));

    // $roles = ['author', 'administrator'];
    // foreach ($roles as $role_name) {
    //     $role = get_role($role_name);
    //     if ($role) {
    //         $capabilities = [
    //             'edit_research', 'read_research', 'delete_research',
    //             'edit_researches', 'publish_researches', 'edit_published_researches',
    //             'delete_published_researches', 'edit_others_researches',
    //             'read_private_researches', 'delete_researches',
    //             'delete_private_researches', 'delete_others_researches',
    //             'edit_private_researches'
    //         ];
    //         foreach ($capabilities as $cap) {
    //             $role->add_cap($cap);
    //         }
    //     }
    // }
}
add_action('init', 'research_post_type');

function investigator_register_metabox() {
    $cmb = new_cmb2_box(array(
        'id' => 'investigators',
        'title' => 'Investigators',
        'object_types' => array('research'),
        'context' => 'side',
        'priority' => 'low',
        'show_names' => true,
    ));

    // Fetch members from the 'members' custom post type
    $members_query = new WP_Query(array(
        'post_type' => 'members',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    $member_options = array();
    if ($members_query->have_posts()) {
        while ($members_query->have_posts()) {
            $members_query->the_post();
            $member_options[get_the_ID()] = get_the_title();
        }
        wp_reset_postdata();
    }

    $cmb->add_field(array(
        'name' => 'Primary Investigator',
        'desc' => 'Select Primary Investigator',
        'id' => 'PI_select',
        'type' => 'select',
        'show_option_none' => true,
        'options' => $member_options,
    ));

    $cmb->add_field(array(
        'name' => 'Other Investigator(s)',
        'desc' => 'Other Investigator(s)',
        'id' => 'investigators_select',
        'type' => 'multicheck',
        'options' => $member_options,
    ));
}
add_action('cmb2_admin_init', 'investigator_register_metabox');

function funding_register_metabox() {
    $cmb = new_cmb2_box(array(
        'id' => 'funding_repeater',
        'title' => 'Funding',
        'object_types' => array('research'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => false,
    ));

    $group_field_id = $cmb->add_field(array(
        'id' => 'funding_repeat_group',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Funding {#}', 'cmb2'),
            'add_button' => __('Add Another Entry', 'cmb2'),
            'remove_button' => __('Remove Entry', 'cmb2'),
            'sortable' => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => 'Funding Title',
        'id' => 'title',
        'type' => 'text',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => 'URL',
        'description' => 'URL of the funding',
        'id' => 'url',
        'type' => 'text_url',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => 'Entry Image',
        'id' => 'image',
        'type' => 'file',
        'options' => array(
            'url' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'funding_register_metabox');


