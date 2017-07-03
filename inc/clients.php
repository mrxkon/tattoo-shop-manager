<?
/////////////
// CLIENTS //
/////////////

////////////////////////////////
// Clients - Custom Post Type //
////////////////////////////////

function tattoo_shop_manager_clients_post_type()
{
    $labels = array(
        'name' => _x('Clients', 'Post Type General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Client', 'Post Type Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Clients', 'tattoo-shop-manager'),
        'name_admin_bar' => __('Client', 'tattoo-shop-manager'),
        'archives' => __('Archives', 'tattoo-shop-manager'),
        'attributes' => __('Attributes', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent:', 'tattoo-shop-manager'),
        'all_items' => __('All Clients', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New', 'tattoo-shop-manager'),
        'add_new' => __('Add New', 'tattoo-shop-manager'),
        'new_item' => __('New', 'tattoo-shop-manager'),
        'edit_item' => __('Edit', 'tattoo-shop-manager'),
        'update_item' => __('Update', 'tattoo-shop-manager'),
        'view_item' => __('View', 'tattoo-shop-manager'),
        'view_items' => __('View', 'tattoo-shop-manager'),
        'search_items' => __('Search', 'tattoo-shop-manager'),
        'not_found' => __('No results', 'tattoo-shop-manager'),
        'not_found_in_trash' => __('No results', 'tattoo-shop-manager'),
        'featured_image' => __('Featured Image', 'tattoo-shop-manager'),
        'set_featured_image' => __('Set featured image', 'tattoo-shop-manager'),
        'remove_featured_image' => __('Remove featured image', 'tattoo-shop-manager'),
        'use_featured_image' => __('Use as featured image', 'tattoo-shop-manager'),
        'insert_into_item' => __('Insert into Client', 'tattoo-shop-manager'),
        'uploaded_to_this_item' => __('Uploaded to this Client', 'tattoo-shop-manager'),
        'items_list' => __('Clients list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Clients list navigation', 'tattoo-shop-manager'),
        'filter_items_list' => __('Filter list', 'tattoo-shop-manager'),
    );

    $args = array(
        'label' => __('Client', 'tattoo-shop-manager'),
        'description' => __('Clients', 'tattoo-shop-manager'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array('tsm-clients-taxonomy'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'menu_position' => 80,
        'menu_icon' => 'dashicons-admin-customizer',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('tsm-clients', $args);
}

add_action('init', 'tattoo_shop_manager_clients_post_type', 0);

///////////////////////////////
// Create Clients Meta-Boxes //
///////////////////////////////

function tattoo_shop_manager_clients_metaboxes($meta_boxes)
{
    $prefix = 'tsm_client_meta_';
    $meta_boxes[] = array(
        'id' => 'clients_metabox',
        'title' => esc_html__('Client Details', 'tattoo-shop-manager'),
        'post_types' => array('tsm-clients'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'fields' => array(
            array(
                'id' => $prefix . 'birthday',
                'name' => esc_html__('Birthday:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'phone',
                'name' => esc_html__('Phone:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'mobile',
                'name' => esc_html__('Mobile:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'address',
                'name' => esc_html__('Address:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'city',
                'name' => esc_html__('City:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'areacode',
                'name' => esc_html__('Area Code:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'country',
                'name' => esc_html__('Country:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
            array(
                'id' => $prefix . 'facebook',
                'name' => esc_html__('Facebook:', 'tattoo-shop-manager'),
                'type' => 'url',
            ),
            array(
                'id' => $prefix . 'instagram',
                'name' => esc_html__('Instagram:', 'tattoo-shop-manager'),
                'type' => 'url',
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

add_filter('rwmb_meta_boxes', 'tattoo_shop_manager_clients_metaboxes');

////////////////////////////
// Custom Clients Columns //
////////////////////////////

// show columns

function tattoo_shop_manager_manage_clients_columns($columns)
{
    unset($columns['description']);
    unset($columns['date']);
    $columns['title'] = 'Name';
    $columns['picture'] = __('Picture', 'tattoo-shop-manager');
    $columns['birthday'] = __('Birthday', 'tattoo-shop-manager');
    $columns['phone'] = __('Phone', 'tattoo-shop-manager');
    $columns['mobile'] = __('Mobile', 'tattoo-shop-manager');
    $columns['address'] = __('Address', 'tattoo-shop-manager');
    $columns['social'] = __('Social', 'tattoo-shop-manager');
    $columns['totalappointments'] = __('Total Appointments', 'tattoo-shop-manager');
    $columns['totalrevenue'] = __('Total Revenue', 'tattoo-shop-manager');
    $columns['notes'] = __('Notes', 'tattoo-shop-manager');
    return $columns;
}

add_filter('manage_tsm-clients_posts_columns', 'tattoo_shop_manager_manage_clients_columns');

// show column data

function tattoo_shop_manager_client_columns_data($column, $post_id)
{
    global $post;
    $tsm_options = get_option('tattoo_shop_manager_options');
    switch ($column) {
        case 'picture' :
            echo get_the_post_thumbnail($post->ID, array(80, 80));
            break;

        case 'birthday' :
            echo date("d-M-Y", strtotime(get_post_meta($post->ID, 'tsm_client_meta_birthday', true)));
            break;

        case 'phone' :
            echo get_post_meta($post->ID, 'tsm_client_meta_phone', true);
            break;

        case 'mobile' :
            echo get_post_meta($post->ID, 'tsm_client_meta_mobile', true);
            break;

        case 'address' :
            $adr = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_client_meta_address', true));
            $cty = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_client_meta_city', true));
            $acd = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_client_meta_areacode', true));
            $cnt = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_client_meta_country', true));
            echo '<a href="https://www.google.gr/maps/search/' . $adr . '+' . $cty . '+' . $acd . '+' . $cnt . '" target="_blank">Google Maps</a>';
            break;

        case 'social' :
            $face = get_post_meta($post->ID, 'tsm_client_meta_facebook', true);
            $inst = get_post_meta($post->ID, 'tsm_client_meta_instagram', true);
            if ($face != "" || $face != null) {
                echo '<a href="' . get_post_meta($post->ID, 'tsm_client_meta_facebook', true) . '" target="_blank" style="margin-left:5px;margin-right:5px;">Facebook</br></a>';
            }
            if ($inst != "" || $inst != null) {
                echo '<a href="' . get_post_meta($post->ID, 'tsm_client_meta_instagram', true) . '" target="_blank" style="margin-left:5px;margin-right:5px;">Instagram</a>';
            }
            break;

        case 'totalappointments':
            $taps = new WP_Query(array(
                'post_type' => 'tsm-appointments',
                'meta_key' => 'tsm_appointment_meta_client',
                'meta_value' => $post->ID
            ));
            echo $taps->found_posts;
            break;

        case 'totalrevenue':
            $trev = new WP_Query(array(
                'post_type' => 'tsm-appointments',
                'meta_key' => 'tsm_appointment_meta_client',
                'meta_value' => $post->ID
            ));
            $posts_ids = wp_list_pluck($trev->posts, 'ID');
            $totalrev = 0;
            foreach ($posts_ids as $post_id) {
                $price = get_post_meta($post_id, 'tsm_appointment_meta_price', true);
                $totalrev += $price;
            }
            echo $tsm_options['tattoo_shop_manager_currency_string'] . ' ' . $totalrev;
            break;

        case 'notes' :
            echo get_post_meta($post->ID, 'tsm_client_meta_notes', true);
            break;
    }
}

add_action('manage_tsm-clients_posts_custom_column', 'tattoo_shop_manager_client_columns_data', 10, 2);

// make columns sortable

function tattoo_shop_manager_clients_columns_sort($columns)
{
    $columns['picture'] = 'picture';
    $columns['birthday'] = 'birthday';
    $columns['phone'] = 'phone';
    $columns['mobile'] = 'mobile';
    $columns['address'] = 'address';
    $columns['social'] = 'social';
    $columns['totalappointments'] = 'totalappointments';
    $columns['totalrevenue'] = 'totalrevenue';
    $columns['notes'] = 'notes';
    return $columns;
}

add_filter('manage_edit-tsm-clients_sortable_columns', 'tattoo_shop_manager_clients_columns_sort');
