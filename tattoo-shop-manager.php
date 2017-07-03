<?php
/*
 * @package Tattoo Shop Manager
 * @version 1.0.0
 *
 * Plugin Name:       Tattoo Shop Manager
 * Plugin URI:        https://xkon.gr/tattoo-shop-manager/
 * Description:       A simple yet powerful Tattoo Shop Manager.
 * Version:           1.0.0
 * Author:            Xenos Konstantinos (xkon)
 * Author URI:        https://xkon.gr/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tattoo-shop-manager
 * Domain Path:       /languages
 *
*/

////////////////////////////////////////////
// If this file is called directly, abort //
////////////////////////////////////////////
if (!defined('WPINC')) {
    die;
}

////////////////////////////////////////////////
// Check if Meta Box is installed & activated //
////////////////////////////////////////////////

class tattoo_shop_manager_check_metabox
{
    static function install()
    {
        if (!is_plugin_active('meta-box/meta-box.php')) {
            deactivate_plugins(__FILE__);
            $error_message = __('This plugin requires the latest <a href="plugin-install.php?s=metabox.io&tab=search&type=term" target="_parent">Meta Box (metabox.io)</a> plugin to be active! Please install and activate it.', 'meta-box');
            die($error_message);
        }
    }
}

register_activation_hook(__FILE__, array('tattoo_shop_manager_check_metabox', 'install'));

///////////////////////
// Register Settings //
///////////////////////

function tattoo_shop_manager_options()
{
    register_setting('tattoo_shop_manager_options', 'tattoo_shop_manager_options', 'tattoo_shop_manager_options_validate');
    add_settings_section('tattoo_shop_manager_main', __('Settings', 'tattoo-shop-manager'), 'tattoo_shop_manager_section_text', 'tattoo-shop-manager');
    add_settings_field('tattoo_shop_manager_currency_string', __('Currency Symbol', 'tattoo-shop-manager'), 'tattoo_shop_manager_currency_string', 'tattoo-shop-manager', 'tattoo_shop_manager_main');
    add_settings_field('tattoo_shop_manager_upcappointmets_string', __('Upcoming Appointments Days', 'tattoo-shop-manager'), 'tattoo_shop_manager_upcappointmets_string', 'tattoo-shop-manager', 'tattoo_shop_manager_main');
    add_settings_field('tattoo_shop_manager_expirationdate_string', __('Expiration Days', 'tattoo-shop-manager'), 'tattoo_shop_manager_expirationdate_string', 'tattoo-shop-manager', 'tattoo_shop_manager_main');
}

add_action('admin_init', 'tattoo_shop_manager_options');

function tattoo_shop_manager_section_text()
{
    echo __('Adjust to your preference', 'tattoo-shop-manager');
}

function tattoo_shop_manager_currency_string()
{
    $tsm_options = get_option('tattoo_shop_manager_options');
    echo "<input id='tattoo_shop_manager_currency_string' name='tattoo_shop_manager_options[tattoo_shop_manager_currency_string]' size='40' type='text' value='{$tsm_options['tattoo_shop_manager_currency_string']}' />";
}

function tattoo_shop_manager_upcappointmets_string()
{
    $tsm_options = get_option('tattoo_shop_manager_options');
    echo "<input id='tattoo_shop_manager_upcappointmets_string' name='tattoo_shop_manager_options[tattoo_shop_manager_upcappointmets_string]' size='40' type='text' value='{$tsm_options['tattoo_shop_manager_upcappointmets_string']}' />";
}

function tattoo_shop_manager_expirationdate_string()
{
    $tsm_options = get_option('tattoo_shop_manager_options');
    echo "<input id='tattoo_shop_manager_expirationdate_string' name='tattoo_shop_manager_options[tattoo_shop_manager_expirationdate_string]' size='40' type='text' value='{$tsm_options['tattoo_shop_manager_expirationdate_string']}' />";
}

///////////////////////
// Load Translations //
///////////////////////

function tsm_load_textdomain()
{
    load_plugin_textdomain('tattoo-shop-manager', false, plugin_dir_url(__FILE__) . 'languages/');
}

add_action('plugins_loaded', 'tsm_load_textdomain');

///////////////////////////
// Load Scripts & Styles //
///////////////////////////

function tattoo_shop_manager_styles()
{
    wp_enqueue_style('flatpickr-css', plugin_dir_url(__FILE__) . 'flatpickr/flatpickr.min.css', array(), '3.0.6');
    wp_enqueue_style('tattoo-shop-manager-css', plugin_dir_url(__FILE__) . 'css/style.css', array(), '1.0.0');
    wp_enqueue_script('flatpickr-js', plugin_dir_url(__FILE__) . 'flatpickr/flatpickr.min.js', array('jquery'), '3.0.6', true);
    wp_enqueue_script('tattoo-shop-manager-js', plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery'), '1.0.0', true);
}

add_action('admin_enqueue_scripts', 'tattoo_shop_manager_styles');

/////////////////////////////////
// Change Add New Title Labels //
/////////////////////////////////

function tattoo_shop_manager_change_title_text($title)
{
    $screen = get_current_screen();
    if ('tsm-needles' == $screen->post_type) {
        $title = 'Enter Needle\'s size & type';
    } elseif ('tsm-inks' == $screen->post_type) {
        $title = 'Enter Ink\'s name';
    } elseif ('tsm-clients' == $screen->post_type) {
        $title = 'Enter Client\'s name';
    } elseif ('tsm-employees' == $screen->post_type) {
        $title = 'Enter Employee\'s name';
    } elseif ('tsm-appointments' == $screen->post_type) {
        $title = 'Enter Appointment\'s title';
    } elseif ('tsm-suppliers' == $screen->post_type) {
        $title = 'Enter Suppliers\'s name';
    }
    return $title;
}

add_filter('enter_title_here', 'tattoo_shop_manager_change_title_text');

/////////////////////
// Create TSM Menu //
/////////////////////

function tattoo_shop_manager_admin_menu()
{
    add_menu_page(
        'Tattoo Shop Manager',
        'Tattoo Shop Manager',
        'manage_options',
        'tattoo-shop-manager',
        'tattoo_shop_manager_admin_page',
        'dashicons-dashboard',
        '80'
    );
}

add_action('admin_menu', 'tattoo_shop_manager_admin_menu');

////////////////////
// Add Shortcodes //
////////////////////

function tattoo_shop_manager_clients_shortcode(){
  
  $total_clients = new WP_Query(array(
      'post_type' => 'tsm-clients'
  ));
  echo '<span class="tsm_total_clients">' . $total_clients->found_posts . '</span>';

}

add_shortcode('tsm_total_clients', 'tattoo_shop_manager_clients_shortcode');

function tattoo_shop_manager_appointments_shortcode(){
  
  
  $total_appointments = new WP_Query(array(
      'post_type' => 'tsm-appointments'
  ));
  echo '<span class="tsm_total_appointments">' . $total_appointments->found_posts . '</span>';

}

add_shortcode('tsm_total_appointments', 'tattoo_shop_manager_appointments_shortcode');

/////////////////////
// Load core files //
/////////////////////

require_once(plugin_dir_path(__FILE__) . 'inc/xkontsmpage.php');
require_once(plugin_dir_path(__FILE__) . 'inc/appointments.php');
require_once(plugin_dir_path(__FILE__) . 'inc/clients.php');
require_once(plugin_dir_path(__FILE__) . 'inc/employees.php');
require_once(plugin_dir_path(__FILE__) . 'inc/inks.php');
require_once(plugin_dir_path(__FILE__) . 'inc/needles.php');
require_once(plugin_dir_path(__FILE__) . 'inc/suppliers.php');
require_once(plugin_dir_path(__FILE__) . 'inc/revenues.php');
require_once(plugin_dir_path(__FILE__) . 'inc/luckydraw.php');
