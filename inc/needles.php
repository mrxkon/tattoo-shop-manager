<?php
/////////////
// NEEDLES //
/////////////

///////////////////////////////
// Needles - Custom Taxonomy //
///////////////////////////////

function tattoo_shop_manager_needles_taxonomy()
{
    $labels = array(
        'name' => _x('Needle Companies', 'Taxonomy General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Needle Company', 'Taxonomy Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Needle Companies', 'tattoo-shop-manager'),
        'all_items' => __('All Needle Companies', 'tattoo-shop-manager'),
        'parent_item' => __('Parent Needle Company', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Needle Company:', 'tattoo-shop-manager'),
        'new_item_name' => __('New Needle Company', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Needle Company', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Needle Company', 'tattoo-shop-manager'),
        'update_item' => __('Update Needle Company', 'tattoo-shop-manager'),
        'view_item' => __('View Needle Company', 'tattoo-shop-manager'),
        'separate_items_with_commas' => __('Separate with commas', 'tattoo-shop-manager'),
        'add_or_remove_items' => __('Add or remove Needle Company', 'tattoo-shop-manager'),
        'choose_from_most_used' => __('Choose from the most used', 'tattoo-shop-manager'),
        'popular_items' => __('Popular Needle Companies', 'tattoo-shop-manager'),
        'search_items' => __('Search Needle Companies', 'tattoo-shop-manager'),
        'not_found' => __('Needle Company not found', 'tattoo-shop-manager'),
        'no_terms' => __('No items', 'tattoo-shop-manager'),
        'items_list' => __('Needle Companies list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Needle Companies list navigation', 'tattoo-shop-manager'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
    );

    register_taxonomy('tsm-needles-taxonomy', array('tsm-needles'), $args);

}

add_action('init', 'tattoo_shop_manager_needles_taxonomy', 0);

////////////////////////////////
// Needles - Custom Post Type //
////////////////////////////////

function tattoo_shop_manager_needles_post_type()
{
    $labels = array(
        'name' => _x('Needles', 'Post Type General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Needle', 'Post Type Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Needles', 'tattoo-shop-manager'),
        'name_admin_bar' => __('Needle', 'tattoo-shop-manager'),
        'archives' => __('Archives', 'tattoo-shop-manager'),
        'attributes' => __('Attributes', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Needle:', 'tattoo-shop-manager'),
        'all_items' => __('All Needles', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Needle', 'tattoo-shop-manager'),
        'add_new' => __('Add New Needle', 'tattoo-shop-manager'),
        'new_item' => __('New Needle', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Needle', 'tattoo-shop-manager'),
        'update_item' => __('Update Needle', 'tattoo-shop-manager'),
        'view_item' => __('View Needle', 'tattoo-shop-manager'),
        'view_items' => __('View Needles', 'tattoo-shop-manager'),
        'search_items' => __('Search Needles', 'tattoo-shop-manager'),
        'not_found' => __('No results', 'tattoo-shop-manager'),
        'not_found_in_trash' => __('No results', 'tattoo-shop-manager'),
        'featured_image' => __('Featured Image', 'tattoo-shop-manager'),
        'set_featured_image' => __('Set featured image', 'tattoo-shop-manager'),
        'remove_featured_image' => __('Remove featured image', 'tattoo-shop-manager'),
        'use_featured_image' => __('Use as featured image', 'tattoo-shop-manager'),
        'insert_into_item' => __('Insert into Needle', 'tattoo-shop-manager'),
        'uploaded_to_this_item' => __('Uploaded to this Needle', 'tattoo-shop-manager'),
        'items_list' => __('Needles list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Needles list navigation', 'tattoo-shop-manager'),
        'filter_items_list' => __('Filter Needles list', 'tattoo-shop-manager'),
    );

    $args = array(
        'label' => __('Needle', 'tattoo-shop-manager'),
        'description' => __('Needles', 'tattoo-shop-manager'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array('tsm-needles-taxonomy'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 80,
        'menu_icon' => 'dashicons-image-filter',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('tsm-needles', $args);
}

add_action('init', 'tattoo_shop_manager_needles_post_type', 0);

//////////////////////////////
// Create Needle Meta-Boxes //
//////////////////////////////

function tattoo_shop_manager_needles_metaboxes($meta_boxes)
{
    $prefix = 'tsm_needle_meta_';
    $meta_boxes[] = array(
        'id' => 'needles_metabox',
        'title' => esc_html__('Needle Details', 'tattoo-shop-manager'),
        'post_types' => array('tsm-needles'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'fields' => array(
            array(
                'id' => $prefix . 'expiration',
                'name' => esc_html__('Expiration Date:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'before' => '<hr style="margin-bottom:20px;"/>',
                'id' => $prefix . 'notes',
                'name' => esc_html__('Notes:', 'tattoo-shop-manager'),
                'type' => 'textarea',
            ),
        ),
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'tattoo_shop_manager_needles_metaboxes');

////////////////////////////////////
// Custom Needle Taxonomy Columns //
////////////////////////////////////

function tattoo_shop_manager_manage_needles_taxonomy_columns($columns)
{
    unset($columns['description']);
    unset($columns['slug']);
    return $columns;
}

add_filter('manage_edit-tsm-needles-taxonomy_columns', 'tattoo_shop_manager_manage_needles_taxonomy_columns');

///////////////////////////
// Custom Needle Columns //
///////////////////////////

// show columns

function tattoo_shop_manager_manage_needles_columns($columns)
{
    unset($columns['description']);
    unset($columns['date']);
    $columns['title'] = __('Size & Type', 'tattoo-shop-manager');
    $columns['picture'] = __('Picture', 'tattoo-shop-manager');
    $columns['expiration'] = __('Expiration Date', 'tattoo-shop-manager');
    $columns['notes'] = __('Notes', 'tattoo-shop-manager');
    return $columns;
}

add_filter('manage_tsm-needles_posts_columns', 'tattoo_shop_manager_manage_needles_columns');

// show column data

function tattoo_shop_manager_needle_columns_data($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'picture' :
            echo get_the_post_thumbnail($post->ID, array(80, 80));
            break;

        case 'expiration' :
            echo date("d-M-Y", strtotime(get_post_meta($post->ID, 'tsm_needle_meta_expiration', true)));
            break;

        case 'size' :
            echo get_post_meta($post->ID, 'tsm_needle_meta_size', true);
            break;

        case 'notes' :
            echo get_post_meta($post->ID, 'tsm_needle_meta_notes', true);
            break;
    }
}

add_action('manage_tsm-needles_posts_custom_column', 'tattoo_shop_manager_needle_columns_data', 10, 2);

// make columns sortable

function tattoo_shop_manager_needles_columns_sort($columns)
{
    $columns['taxonomy-tsm-needles-taxonomy'] = 'taxonomy-tsm-needles-taxonomy';
    $columns['picture'] = 'picture';
    $columns['expiration'] = 'expiration';
    $columns['notes'] = 'notes';
    return $columns;
}

add_filter('manage_edit-tsm-needles_sortable_columns', 'tattoo_shop_manager_needles_columns_sort');
