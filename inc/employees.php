<?
///////////////
// EMPLOYEES //
///////////////

///////////////////////////////
// Employees - Custom Taxonomy //
///////////////////////////////

function tattoo_shop_manager_employees_taxonomy()
{
    $labels = array(
        'name' => _x('Job Positions', 'Taxonomy General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Job Position', 'Taxonomy Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Job Positions', 'tattoo-shop-manager'),
        'all_items' => __('All Job Positions', 'tattoo-shop-manager'),
        'parent_item' => __('Parent Job Position', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Job Position:', 'tattoo-shop-manager'),
        'new_item_name' => __('New Job Position', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Job Position', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Job Position', 'tattoo-shop-manager'),
        'update_item' => __('Update Job Position', 'tattoo-shop-manager'),
        'view_item' => __('View Job Position', 'tattoo-shop-manager'),
        'separate_items_with_commas' => __('Separate with commas', 'tattoo-shop-manager'),
        'add_or_remove_items' => __('Add or remove Job Position', 'tattoo-shop-manager'),
        'choose_from_most_used' => __('Choose from the most used', 'tattoo-shop-manager'),
        'popular_items' => __('Popular Job Positions', 'tattoo-shop-manager'),
        'search_items' => __('Search Job Positions', 'tattoo-shop-manager'),
        'not_found' => __('Job Position not found', 'tattoo-shop-manager'),
        'no_terms' => __('No items', 'tattoo-shop-manager'),
        'items_list' => __('Job Positions list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Job Positions list navigation', 'tattoo-shop-manager'),
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

    register_taxonomy('tsm-employees-taxonomy', array('tsm-employees'), $args);

}

add_action('init', 'tattoo_shop_manager_employees_taxonomy', 0);

//////////////////////////////////
// Employees - Custom Post Type //
//////////////////////////////////

function tattoo_shop_manager_employees_post_type()
{
    $labels = array(
        'name' => _x('Employees', 'Post Type General Name', 'tattoo-shop-manager'),
        'singular_name' => _x('Employee', 'Post Type Singular Name', 'tattoo-shop-manager'),
        'menu_name' => __('Employees', 'tattoo-shop-manager'),
        'name_admin_bar' => __('Employee', 'tattoo-shop-manager'),
        'archives' => __('Archives', 'tattoo-shop-manager'),
        'attributes' => __('Attributes', 'tattoo-shop-manager'),
        'parent_item_colon' => __('Parent Employee:', 'tattoo-shop-manager'),
        'all_items' => __('All Employees', 'tattoo-shop-manager'),
        'add_new_item' => __('Add New Employee', 'tattoo-shop-manager'),
        'add_new' => __('Add New Employee', 'tattoo-shop-manager'),
        'new_item' => __('New Employee', 'tattoo-shop-manager'),
        'edit_item' => __('Edit Employee', 'tattoo-shop-manager'),
        'update_item' => __('Update Employee', 'tattoo-shop-manager'),
        'view_item' => __('View Employee', 'tattoo-shop-manager'),
        'view_items' => __('View Employees', 'tattoo-shop-manager'),
        'search_items' => __('Search Employees', 'tattoo-shop-manager'),
        'not_found' => __('No results', 'tattoo-shop-manager'),
        'not_found_in_trash' => __('No results', 'tattoo-shop-manager'),
        'featured_image' => __('Featured Image', 'tattoo-shop-manager'),
        'set_featured_image' => __('Set featured image', 'tattoo-shop-manager'),
        'remove_featured_image' => __('Remove featured image', 'tattoo-shop-manager'),
        'use_featured_image' => __('Use as featured image', 'tattoo-shop-manager'),
        'insert_into_item' => __('Insert into Employee', 'tattoo-shop-manager'),
        'uploaded_to_this_item' => __('Uploaded to this Employee', 'tattoo-shop-manager'),
        'items_list' => __('Employees list', 'tattoo-shop-manager'),
        'items_list_navigation' => __('Employees list navigation', 'tattoo-shop-manager'),
        'filter_items_list' => __('Filter Employees list', 'tattoo-shop-manager'),
    );

    $args = array(
        'label' => __('Employee', 'tattoo-shop-manager'),
        'description' => __('Employees', 'tattoo-shop-manager'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array('tsm-employees-taxonomy'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 80,
        'menu_icon' => 'dashicons-id-alt',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('tsm-employees', $args);
}

add_action('init', 'tattoo_shop_manager_employees_post_type', 0);

/////////////////////////////////
// Create Employees Meta-Boxes //
/////////////////////////////////

function tattoo_shop_manager_employees_metaboxes($meta_boxes)
{
    $prefix = 'tsm_employee_meta_';
    $meta_boxes[] = array(
        'id' => 'employees_metabox',
        'title' => esc_html__('Employee Details', 'tattoo-shop-manager'),
        'post_types' => array('tsm-employees'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => false,
        'fields' => array(
            array(
                'id' => $prefix . 'nickname',
                'name' => esc_html__('Nickname:', 'tattoo-shop-manager'),
                'type' => 'text',
            ),
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
                'id' => $prefix . 'healthcert',
                'type' => 'file_input',
                'name' => esc_html__('Health Certificate', 'tattoo-shop-manager'),
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

add_filter('rwmb_meta_boxes', 'tattoo_shop_manager_employees_metaboxes');

///////////////////////////////////////
// Custom Employees Taxonomy Columns //
///////////////////////////////////////

function tattoo_shop_manager_manage_employees_taxonomy_columns($columns)
{
    unset($columns['description']);
    unset($columns['slug']);
    return $columns;
}

add_filter('manage_edit-tsm-employees-taxonomy_columns', 'tattoo_shop_manager_manage_employees_taxonomy_columns');

//////////////////////////////
// Custom Employees Columns //
//////////////////////////////

// show columns

function tattoo_shop_manager_manage_employees_columns($columns)
{
    unset($columns['description']);
    unset($columns['date']);
    $columns['title'] = 'Name';
    $columns['picture'] = __('Picture', 'tattoo-shop-manager');
    $columns['nickname'] = __('Nickname', 'tattoo-shop-manager');
    $columns['birthday'] = __('Birthday', 'tattoo-shop-manager');
    $columns['phone'] = __('Phone', 'tattoo-shop-manager');
    $columns['mobile'] = __('Mobile', 'tattoo-shop-manager');
    $columns['address'] = __('Address', 'tattoo-shop-manager');
    $columns['healthcert'] = __('Health Certificate', 'tattoo-shop-manager');
    $columns['social'] = __('Social', 'tattoo-shop-manager');
    $columns['totalappointments'] = __('Total Appointments', 'tattoo-shop-manager');
    $columns['totalrevenue'] = __('Total Revenue', 'tattoo-shop-manager');
    $columns['notes'] = __('Notes', 'tattoo-shop-manager');
    return $columns;
}

add_filter('manage_tsm-employees_posts_columns', 'tattoo_shop_manager_manage_employees_columns');

// show column data

function tattoo_shop_manager_employee_columns_data($column, $post_id)
{
    global $post;
    $tsm_options = get_option('tattoo_shop_manager_options');
    switch ($column) {
        case 'picture' :
            echo get_the_post_thumbnail($post->ID, array(80, 80));
            break;

        case 'nickname' :
            echo get_post_meta($post->ID, 'tsm_employee_meta_nickname', true);
            break;

        case 'birthday' :
            echo date("d-M-Y", strtotime(get_post_meta($post->ID, 'tsm_employee_meta_birthday', true)));
            break;

        case 'phone' :
            echo get_post_meta($post->ID, 'tsm_employee_meta_phone', true);
            break;

        case 'mobile' :
            echo get_post_meta($post->ID, 'tsm_employee_meta_mobile', true);
            break;

        case 'address' :
            $adr = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_employee_meta_address', true));
            $cty = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_employee_meta_city', true));
            $acd = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_employee_meta_areacode', true));
            $cnt = str_replace(' ', '+', get_post_meta($post->ID, 'tsm_employee_meta_country', true));
            echo '<a href="https://www.google.gr/maps/search/' . $adr . '+' . $cty . '+' . $acd . '+' . $cnt . '" target="_blank">Google Maps</a>';
            break;

        case 'healthcert' :
            echo '<a href="' . get_post_meta($post->ID, 'tsm_employee_meta_healthcert', true) . '" target="_blank">View</a>';
            break;

        case 'social' :
            $face = get_post_meta($post->ID, 'tsm_employee_meta_facebook', true);
            $inst = get_post_meta($post->ID, 'tsm_employee_meta_instagram', true);
            if ($face != "" || $face != null) {
                echo '<a href="' . get_post_meta($post->ID, 'tsm_employee_meta_facebook', true) . '" target="_blank" style="margin-left:5px;margin-right:5px;">Facebook</a><br/>';
            }
            if ($inst != "" || $inst != null) {
                echo '<a href="' . get_post_meta($post->ID, 'tsm_employee_meta_instagram', true) . '" target="_blank" style="margin-left:5px;margin-right:5px;">Instagram</a>';
            }
            break;

        case 'totalappointments':
            $taps = new WP_Query(array(
                'post_type' => 'tsm-appointments',
                'meta_key' => 'tsm_appointment_meta_artist',
                'meta_value' => $post->ID
            ));
            echo $taps->found_posts;
            break;

        case 'totalrevenue':
            $trev = new WP_Query(array(
                'post_type' => 'tsm-appointments',
                'meta_key' => 'tsm_appointment_meta_artist',
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
            echo get_post_meta($post->ID, 'tsm_employee_meta_notes', true);
            break;
    }
}

add_action('manage_tsm-employees_posts_custom_column', 'tattoo_shop_manager_employee_columns_data', 10, 2);

// make columns sortable

function tattoo_shop_manager_employees_columns_sort($columns)
{
    $columns['taxonomy-tsm-employees-taxonomy'] = 'taxonomy-tsm-employees-taxonomy';
    $columns['picture'] = 'picture';
    $columns['nickname'] = 'nickname';
    $columns['birthday'] = 'birthday';
    $columns['phone'] = 'phone';
    $columns['mobile'] = 'mobile';
    $columns['address'] = 'address';
    $columns['healthcert'] = 'healthcert';
    $columns['social'] = 'social';
    $columns['totalappointments'] = 'totalappointments';
    $columns['totalrevenue'] = 'totalrevenue';
    $columns['notes'] = 'notes';
    return $columns;
}

add_filter('manage_edit-tsm-employees_sortable_columns', 'tattoo_shop_manager_employees_columns_sort');
