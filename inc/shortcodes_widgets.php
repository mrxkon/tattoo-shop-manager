<?php
////////////////////
// Add Shortcodes //
////////////////////

function tattoo_shop_manager_clients_shortcode(){

    $total_clients = new WP_Query(array(
        'post_type' => 'tsm-clients'
    ));
    return '<span class="tsm_total_clients">' . $total_clients->found_posts . '</span>';

}

add_shortcode('tsm_total_clients', 'tattoo_shop_manager_clients_shortcode');

function tattoo_shop_manager_appointments_shortcode(){


    $total_appointments = new WP_Query(array(
        'post_type' => 'tsm-appointments'
    ));
    return '<span class="tsm_total_appointments">' . $total_appointments->found_posts . '</span>';

}

add_shortcode('tsm_total_appointments', 'tattoo_shop_manager_appointments_shortcode');
