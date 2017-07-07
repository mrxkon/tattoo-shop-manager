<?php
//////////
// INKS //
//////////

////////////////////////////
// Inks - Custom Taxonomy //
////////////////////////////

function tattoo_shop_manager_inks_taxonomy()
{
    $labels = array(
        'name' => _x('Ink Companies & Sets', 'Taxonomy General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Ink Company & Set', 'Taxonomy Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Ink Companies  & Sets', 'tattoo-shop-manager'),
        'all_items' => __('All Ink Companies  & Sets', 'tattoo-shop-manager'),
        'parent_item' => __('Parent Ink Company & Set', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Ink Company & Set:', 'tattoo-shop-manager'),
        'new_item_name' => __('New Ink Company & Set', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Ink Company & Set', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Ink Company & Set', 'tattoo-shop-manager'),
        'update_item' => __('Update Ink Company & Set', 'tattoo-shop-manager'),
        'view_item' => __('View Ink Company & Set', 'tattoo-shop-manager'),
        'separate_items_with_commas' => __('Separate with commas', 'tattoo-shop-manager'),
        'add_or_remove_items' => __('Add or remove Ink Company & Set', 'tattoo-shop-manager'),
        'choose_from_most_used' => __('Choose from the most used', 'tattoo-shop-manager'),
        'popular_items' => __('Popular Ink Companies  & Sets', 'tattoo-shop-manager'),
        'search_items' => __('Search Ink Companies  & Sets', 'tattoo-shop-manager'),
        'not_found' => __('Ink Company & Set not found', 'tattoo-shop-manager'),
        'no_terms' => __('No items', 'tattoo-shop-manager'),
        'items_list' => __('Ink Companies & Sets list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Ink Companies & Sets list navigation', 'tattoo-shop-manager'),
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

    register_taxonomy('tsm-inks-taxonomy', array('tsm-inks'), $args);

}

add_action('init', 'tattoo_shop_manager_inks_taxonomy', 0);

/////////////////////////////
// Inks - Custom Post Type //
/////////////////////////////

function tattoo_shop_manager_inks_post_type()
{
    $labels = array(
        'name' => _x('Inks', 'Post Type General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Ink', 'Post Type Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Inks', 'tattoo-shop-manager'),
        'name_admin_bar' => __('Ink', 'tattoo-shop-manager'),
        'archives' => __('Archives', 'tattoo-shop-manager'),
        'attributes' => __('Attributes', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Ink:', 'tattoo-shop-manager'),
        'all_items' => __('All Inks', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Ink', 'tattoo-shop-manager'),
        'add_new' => __('Add New Ink', 'tattoo-shop-manager'),
        'new_item' => __('New Ink', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Ink', 'tattoo-shop-manager'),
        'update_item' => __('Update Ink', 'tattoo-shop-manager'),
        'view_item' => __('View Ink', 'tattoo-shop-manager'),
        'view_items' => __('View Inks', 'tattoo-shop-manager'),
        'search_items' => __('Search Inks', 'tattoo-shop-manager'),
        'not_found' => __('No results', 'tattoo-shop-manager'),
        'not_found_in_trash' => __('No results', 'tattoo-shop-manager'),
        'featured_image' => __('Featured Image', 'tattoo-shop-manager'),
        'set_featured_image' => __('Set featured image', 'tattoo-shop-manager'),
        'remove_featured_image' => __('Remove featured image', 'tattoo-shop-manager'),
        'use_featured_image' => __('Use as featured image', 'tattoo-shop-manager'),
        'insert_into_item' => __('Insert into Ink', 'tattoo-shop-manager'),
        'uploaded_to_this_item' => __('Uploaded to this Ink', 'tattoo-shop-manager'),
        'items_list' => __('Inks list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Inks list navigation', 'tattoo-shop-manager'),
        'filter_items_list' => __('Filter Inks list', 'tattoo-shop-manager'),
    );

    $args = array(
        'label' => __('Ink', 'tattoo-shop-manager'),
        'description' => __('Inks', 'tattoo-shop-manager'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array('tsm-inks-taxonomy'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 80,
        'menu_icon' => 'dashicons-art',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('tsm-inks', $args);
}

add_action('init', 'tattoo_shop_manager_inks_post_type', 0);

///////////////////////////
// Create Ink Meta-Boxes //
///////////////////////////

function tattoo_shop_manager_inks_metaboxes($meta_boxes)
{
    $prefix = 'tsm_ink_meta_';
    $meta_boxes[] = array(
        'id' => 'inks_metabox',
        'title' => esc_html__('Ink Details', 'tattoo-shop-manager'),
        'post_types' => array('tsm-inks'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'fields' => array(
            array(
                'id' => $prefix . 'hue',
                'name' => esc_html__('Ink Hue:', 'tattoo-shop-manager'),
                'type' => 'color',
            ),
            array(
                'id' => $prefix . 'expiration',
                'name' => esc_html__('Expiration Date:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'size',
                'name' => esc_html__('Size:', 'tattoo-shop-manager'),
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

add_filter('rwmb_meta_boxes', 'tattoo_shop_manager_inks_metaboxes');

/////////////////////////////////
// Custom Ink Taxonomy Columns //
/////////////////////////////////

function tattoo_shop_manager_manage_inks_taxonomy_columns($columns)
{
    unset($columns['description']);
    unset($columns['slug']);
    return $columns;
}

add_filter('manage_edit-tsm-inks-taxonomy_columns', 'tattoo_shop_manager_manage_inks_taxonomy_columns');

////////////////////////
// Custom Ink Columns //
////////////////////////

// show columns

function tattoo_shop_manager_manage_inks_columns($columns)
{
    unset($columns['description']);
    unset($columns['date']);
    $columns['title'] = __('Name', 'tattoo-shop-manager');
    $columns['picture'] = __('Picture', 'tattoo-shop-manager');
    $columns['hue'] = __('Hue', 'tattoo-shop-manager');
    $columns['expiration'] = __('Expiration Date', 'tattoo-shop-manager');
    $columns['size'] = __('Size', 'tattoo-shop-manager');
    $columns['notes'] = __('Notes', 'tattoo-shop-manager');
    return $columns;
}

add_filter('manage_tsm-inks_posts_columns', 'tattoo_shop_manager_manage_inks_columns');

// show column data

function tattoo_shop_manager_ink_columns_data($column, $post_id)
{
    global $post;
    switch ($column) {
        case 'picture' :
            echo get_the_post_thumbnail($post->ID, array(80, 80));
            break;

        case 'hue' :
            echo '<div style="height:15px!important;float:left;width:50%!important;background:' . get_post_meta($post->ID, 'tsm_ink_meta_hue', true) . '!important"></div>';
            break;

        case 'expiration' :
            echo date("d-M-Y", strtotime(get_post_meta($post->ID, 'tsm_ink_meta_expiration', true)));
            break;

        case 'size' :
            echo get_post_meta($post->ID, 'tsm_ink_meta_size', true);
            break;

        case 'notes' :
            echo get_post_meta($post->ID, 'tsm_ink_meta_notes', true);
            break;
    }
}

add_action('manage_tsm-inks_posts_custom_column', 'tattoo_shop_manager_ink_columns_data', 10, 2);

// make columns sortable

function tattoo_shop_manager_inks_columns_sort($columns)
{
    $columns['taxonomy-tsm-inks-taxonomy'] = 'taxonomy-tsm-inks-taxonomy';
    $columns['picture'] = 'picture';
    $columns['hue'] = 'hue';
    $columns['expiration'] = 'expiration';
    $columns['size'] = 'size';
    $columns['notes'] = 'notes';
    return $columns;
}

add_filter('manage_edit-tsm-inks_sortable_columns', 'tattoo_shop_manager_inks_columns_sort');
