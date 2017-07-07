<?php
//////////////////
// APPOINTMENTS //
//////////////////

////////////////////////////////////
// Appointments - Custom Taxonomy //
////////////////////////////////////

function tattoo_shop_manager_appointments_taxonomy()
{
    $labels = array(
        'name' => _x('Appointment Types', 'Taxonomy General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Appointment Type', 'Taxonomy Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Appointment Types', 'tattoo-shop-manager'),
        'all_items' => __('All Appointment Types', 'tattoo-shop-manager'),
        'parent_item' => __('Parent Appointment Type', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Appointment Type:', 'tattoo-shop-manager'),
        'new_item_name' => __('New Appointment Type', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Appointment Type', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Appointment Type', 'tattoo-shop-manager'),
        'update_item' => __('Update Appointment Type', 'tattoo-shop-manager'),
        'view_item' => __('View Appointment Type', 'tattoo-shop-manager'),
        'separate_items_with_commas' => __('Separate with commas', 'tattoo-shop-manager'),
        'add_or_remove_items' => __('Add or remove Appointment Type', 'tattoo-shop-manager'),
        'choose_from_most_used' => __('Choose from the most used', 'tattoo-shop-manager'),
        'popular_items' => __('Popular Appointment Types', 'tattoo-shop-manager'),
        'search_items' => __('Search Appointment Types', 'tattoo-shop-manager'),
        'not_found' => __('Appointment Type not found', 'tattoo-shop-manager'),
        'no_terms' => __('No items', 'tattoo-shop-manager'),
        'items_list' => __('Appointment Types list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Appointment Types list navigation', 'tattoo-shop-manager'),
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

    register_taxonomy('tsm-appointments-taxonomy', array('tsm-appointments'), $args);

}

add_action('init', 'tattoo_shop_manager_appointments_taxonomy', 0);

/////////////////////////////////////
// Appointments - Custom Post Type //
/////////////////////////////////////

function tattoo_shop_manager_appointments_post_type()
{
    $labels = array(
        'name' => _x('Appointments', 'Post Type General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Appointment', 'Post Type Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Appointments', 'tattoo-shop-manager'),
        'name_admin_bar' => __('Appointment', 'tattoo-shop-manager'),
        'archives' => __('Archives', 'tattoo-shop-manager'),
        'attributes' => __('Attributes', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Appointment:', 'tattoo-shop-manager'),
        'all_items' => __('All Appointments', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Appointment', 'tattoo-shop-manager'),
        'add_new' => __('Add New Appointment', 'tattoo-shop-manager'),
        'new_item' => __('New Appointment', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Appointment', 'tattoo-shop-manager'),
        'update_item' => __('Update Appointment', 'tattoo-shop-manager'),
        'view_item' => __('View Appointment', 'tattoo-shop-manager'),
        'view_items' => __('View Appointments', 'tattoo-shop-manager'),
        'search_items' => __('Search Appointments', 'tattoo-shop-manager'),
        'not_found' => __('No results', 'tattoo-shop-manager'),
        'not_found_in_trash' => __('No results', 'tattoo-shop-manager'),
        'featured_image' => __('Featured Image', 'tattoo-shop-manager'),
        'set_featured_image' => __('Set featured image', 'tattoo-shop-manager'),
        'remove_featured_image' => __('Remove featured image', 'tattoo-shop-manager'),
        'use_featured_image' => __('Use as featured image', 'tattoo-shop-manager'),
        'insert_into_item' => __('Insert into Appointment', 'tattoo-shop-manager'),
        'uploaded_to_this_item' => __('Uploaded to this Appointment', 'tattoo-shop-manager'),
        'items_list' => __('Appointments list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Appointments list navigation', 'tattoo-shop-manager'),
        'filter_items_list' => __('Filter Appointments list', 'tattoo-shop-manager'),
    );

    $args = array(
        'label' => __('Appointment', 'tattoo-shop-manager'),
        'description' => __('Appointments', 'tattoo-shop-manager'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array('tsm-appointments-taxonomy'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 80,
        'menu_icon' => 'dashicons-calendar',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('tsm-appointments', $args);
}

add_action('init', 'tattoo_shop_manager_appointments_post_type', 0);

////////////////////////////////////
// Create Appointments Meta-Boxes //
////////////////////////////////////

function tattoo_shop_manager_appointments_metaboxes($meta_boxes)
{
    $prefix = 'tsm_appointment_meta_';
    $meta_boxes[] = array(
        'id' => 'appointments_metabox',
        'title' => esc_html__('Appointment Details', 'tattoo-shop-manager'),
        'post_types' => array('tsm-appointments'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'validation' => array(
            'rules' => array(
                "{$prefix}price" => array(
                    'number' => true
                ),
            ),
        ),
        'fields' => array(
            array(
                'id' => $prefix . 'date',
                'name' => esc_html__('Date:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'time',
                'name' => esc_html__('Time:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'artist',
                'type' => 'post',
                'name' => esc_html__('Employee:', 'tattoo-shop-manager'),
                'post_type' => 'tsm-employees',
                'field_type' => 'select',
                'query_args' => array(),
            ),
            array(
                'id' => $prefix . 'client',
                'type' => 'post',
                'name' => esc_html__('Client:', 'tattoo-shop-manager'),
                'post_type' => 'tsm-clients',
                'field_type' => 'select',
                'query_args' => array(),
            ),
            array(
                'id' => $prefix . 'price',
                'name' => esc_html__('Price:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'before' => '<hr style="margin-bottom:20px;"/>',
                'id' => $prefix . 'inks',
                'type' => 'post',
                'name' => esc_html__('Inks:', 'metabox-online-generator'),
                'post_type' => 'tsm-inks',
                'field_type' => 'checkbox_tree',
                'query_args' => array(),
            ),
            array(
                'id' => $prefix . 'needles',
                'type' => 'post',
                'name' => esc_html__('Needles:', 'metabox-online-generator'),
                'post_type' => 'tsm-needles',
                'field_type' => 'checkbox_tree',
                'query_args' => array(),
            ),
            array(
                'before' => '<hr style="margin-bottom:20px;"/>',
                'id' => $prefix . 'files',
                'type' => 'file_advanced',
                'name' => esc_html__('Files:', 'tattoo-shop-manager'),
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

add_filter('rwmb_meta_boxes', 'tattoo_shop_manager_appointments_metaboxes');

///////////////////////////////////////
// Custom Employees Taxonomy Columns //
///////////////////////////////////////

function manage_tattoo_shop_manager_appointments_taxonomy_columns($columns)
{
    unset($columns['description']);
    unset($columns['slug']);
    return $columns;
}

add_filter('manage_edit-tsm-appointments-taxonomy_columns', 'manage_tattoo_shop_manager_appointments_taxonomy_columns');

/////////////////////////////////
// Custom Appointments Columns //
/////////////////////////////////

// show columns

function manage_tattoo_shop_manager_appointments_columns($columns)
{
    unset($columns['description']);
    unset($columns['date']);
    $columns['picture'] = __('Picture', 'tattoo-shop-manager');
    $columns['cdate'] = __('Date', 'tattoo-shop-manager');
    $columns['time'] = __('Time', 'tattoo-shop-manager');
    $columns['artist'] = __('Employee', 'tattoo-shop-manager');
    $columns['client'] = __('Client', 'tattoo-shop-manager');
    $columns['price'] = __('Price', 'tattoo-shop-manager');
    $columns['inks'] = __('Inks', 'tattoo-shop-manager');
    $columns['needles'] = __('Needles', 'tattoo-shop-manager');
    $columns['files'] = __('Files', 'tattoo-shop-manager');
    $columns['notes'] = __('Notes', 'tattoo-shop-manager');
    return $columns;
}

add_filter('manage_tsm-appointments_posts_columns', 'manage_tattoo_shop_manager_appointments_columns');

// show column data

function tattoo_shop_manager_appointment_columns_data($column, $post_id)
{
    global $post;
    $tsm_options = get_option('tattoo_shop_manager_options');
    switch ($column) {
        case 'cdate' :
            echo date("d-M-Y", strtotime(get_post_meta($post->ID, 'tsm_appointment_meta_date', true)));
            break;

        case 'time' :
            echo get_post_meta($post->ID, 'tsm_appointment_meta_time', true);
            break;

        case 'artist' :
            $artist = get_the_title(get_post_meta($post->ID, 'tsm_appointment_meta_artist', true));
            if ($artist != get_the_title($post->ID)) {
                echo $artist;
            } else {
                echo " ";
            }
            break;

        case 'client' :
            $client = get_the_title(get_post_meta($post->ID, 'tsm_appointment_meta_client', true));
            if ($client != get_the_title($post->ID)) {
                echo $client;
            } else {
                echo " ";
            }
            break;

        case 'files' :
            $files = get_post_meta($post->ID, 'tsm_appointment_meta_files', false);
            foreach ($files as $file) {
                $thumbnail_url = wp_get_attachment_image_src($file, 'full');
                $thumbnail_url = $thumbnail_url[0];
                echo '<a href="' . $thumbnail_url . '" target="_blank">' . get_the_title($file) . '</a><br/>';
            }
            break;

        case 'inks' :
            $inks = get_post_meta($post->ID, 'tsm_appointment_meta_inks', false);
            foreach ($inks as $ink) {
                $inktax = get_the_terms($ink, 'tsm-inks-taxonomy');
                echo get_the_title($ink) . ' (';
                $i = 0;
                $len = count($inktax);
                foreach ($inktax as $itax) {
                    echo $itax->name;
                    if ($i != $len - 1) {
                        echo ', ';
                    }
                    $i++;
                }
                echo ')<br/>';
            }
            break;

        case 'needles' :
            $needles = get_post_meta($post->ID, 'tsm_appointment_meta_needles', false);
            foreach ($needles as $needle) {
                $needtax = get_the_terms($needle, 'tsm-needles-taxonomy');
                echo get_the_title($needle) . ' (';
                $i = 0;
                $len = count($needtax);
                foreach ($needtax as $ntax) {
                    echo $ntax->name;
                    if ($i != $len - 1) {
                        echo ', ';
                    }
                    $i++;
                }
                echo ')<br/>';
            }
            break;

        case 'price' :
            echo $tsm_options['tattoo_shop_manager_currency_string'] . ' ' . get_post_meta($post->ID, 'tsm_appointment_meta_price', true);
            break;

        case 'picture' :
            echo get_the_post_thumbnail($post->ID, array(80, 80));
            break;

        case 'notes' :
            echo get_post_meta($post->ID, 'tsm_appointment_meta_notes', true);
            break;

    }
}

add_action('manage_tsm-appointments_posts_custom_column', 'tattoo_shop_manager_appointment_columns_data', 10, 2);

// make columns sortable

function tattoo_shop_manager_appointments_columns_sort($columns)
{
    $columns['taxonomy-tsm-appointments-taxonomy'] = 'taxonomy-tsm-appointments-taxonomy';
    $columns['picture'] = 'picture';
    $columns['cdate'] = 'cdate';
    $columns['time'] = 'time';
    $columns['artist'] = 'artist';
    $columns['client'] = 'client';
    $columns['price'] = 'price';
    $columns['inks'] = 'inks';
    $columns['needles'] = 'needles';
    $columns['files'] = 'files';
    $columns['notes'] = 'notes';
    return $columns;
}

add_filter('manage_edit-tsm-appointments_sortable_columns', 'tattoo_shop_manager_appointments_columns_sort');
