<?php
////////////////////
// Add Shortcodes //
////////////////////

function tattoo_shop_manager_clients_shortcode()
{

    $total_clients = new WP_Query(array(
        'post_type' => 'tsm-clients'
    ));
    return '<span class="tsm_total_clients">' . $total_clients->found_posts . '</span>';

}

add_shortcode('tsm_total_clients', 'tattoo_shop_manager_clients_shortcode');

function tattoo_shop_manager_appointments_shortcode()
{


    $total_appointments = new WP_Query(array(
        'post_type' => 'tsm-appointments'
    ));
    return '<span class="tsm_total_appointments">' . $total_appointments->found_posts . '</span>';

}

add_shortcode('tsm_total_appointments', 'tattoo_shop_manager_appointments_shortcode');

/////////////
// Widgets //
/////////////

function tattoo_shop_manager_load_widgets()
{
    register_widget('tattoo_shop_manager_total_clients_widget');
    register_widget('tattoo_shop_manager_total_appointments_widget');
    register_widget('tattoo_shop_manager_calendar_widget');
}

add_action('widgets_init', 'tattoo_shop_manager_load_widgets');

class tattoo_shop_manager_total_clients_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'tattoo_shop_manager_total_clients_widget',
            __('Tattoo Shop Manager - Total Clients', 'tattoo-shop-manager'),
            array('description' => __('Show your Total Clients', 'tattoo-shop-manager'),)
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('widget_text', $instance['text']);
        $text_css = apply_filters('widget_text_css', $instance['text_css']);
        $counter_css = apply_filters('widget_counter_css', $instance['counter_css']);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $total_clients = new WP_Query(array(
            'post_type' => 'tsm-clients'
        ));

        echo '<div class="' . $counter_css . '"><span>' . $total_clients->found_posts . '</span></div>';
        echo '<div class="' . $text_css . '"><span>' . $text . '</span></div>';
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'tattoo-shop-manager');
        }

        if (isset($instance['text'])) {
            $text = $instance['text'];
        } else {
            $text = __('Happy Customers!', 'tattoo-shop-manager');
        }

        if (isset($instance['text_css'])) {
            $text_css = $instance['text_css'];
        } else {
            $text_css = '';
        }

        if (isset($instance['counter_css'])) {
            $counter_css = $instance['counter_css'];
        } else {
            $counter_css = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>"
                   name="<?php echo $this->get_field_name('text'); ?>" type="text"
                   value="<?php echo esc_attr($text); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text_css'); ?>"><?php _e('Text CSS classes (i.e. classOne classTwo):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text_css'); ?>"
                   name="<?php echo $this->get_field_name('text_css'); ?>" type="text"
                   value="<?php echo esc_attr($text_css); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('counter_css'); ?>"><?php _e('Counter CSS classes (i.e. classOne classTwo):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('counter_css'); ?>"
                   name="<?php echo $this->get_field_name('counter_css'); ?>" type="text"
                   value="<?php echo esc_attr($counter_css); ?>"/>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';
        $instance['text_css'] = (!empty($new_instance['text_css'])) ? strip_tags($new_instance['text_css']) : '';
        $instance['counter_css'] = (!empty($new_instance['counter_css'])) ? strip_tags($new_instance['counter_css']) : '';
        return $instance;
    }
}

class tattoo_shop_manager_total_appointments_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'tattoo_shop_manager_total_appointments_widget',
            __('Tattoo Shop Manager - Total Appointments', 'tattoo-shop-manager'),
            array('description' => __('Show your Total Appointments', 'tattoo-shop-manager'),)
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('widget_text', $instance['text']);
        $text_css = apply_filters('widget_text_css', $instance['text_css']);
        $counter_css = apply_filters('widget_counter_css', $instance['counter_css']);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $total_appointments = new WP_Query(array(
            'post_type' => 'tsm-appointments'
        ));

        echo '<div class="' . $counter_css . '"><span>' . $total_appointments->found_posts . '</span></div>';
        echo '<div class="' . $text_css . '"><span>' . $text . '</span></div>';
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'tattoo-shop-manager');
        }

        if (isset($instance['text'])) {
            $text = $instance['text'];
        } else {
            $text = __('Appointments!', 'tattoo-shop-manager');
        }

        if (isset($instance['text_css'])) {
            $text_css = $instance['text_css'];
        } else {
            $text_css = '';
        }

        if (isset($instance['counter_css'])) {
            $counter_css = $instance['counter_css'];
        } else {
            $counter_css = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>"
                   name="<?php echo $this->get_field_name('text'); ?>" type="text"
                   value="<?php echo esc_attr($text); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text_css'); ?>"><?php _e('Text CSS classes (i.e. classOne classTwo):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text_css'); ?>"
                   name="<?php echo $this->get_field_name('text_css'); ?>" type="text"
                   value="<?php echo esc_attr($text_css); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('counter_css'); ?>"><?php _e('Counter CSS classes (i.e. classOne classTwo):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('counter_css'); ?>"
                   name="<?php echo $this->get_field_name('counter_css'); ?>" type="text"
                   value="<?php echo esc_attr($counter_css); ?>"/>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';
        $instance['text_css'] = (!empty($new_instance['text_css'])) ? strip_tags($new_instance['text_css']) : '';
        $instance['counter_css'] = (!empty($new_instance['counter_css'])) ? strip_tags($new_instance['counter_css']) : '';
        return $instance;
    }
}

class tattoo_shop_manager_calendar_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'tattoo_shop_manager_calendar_widget',
            __('Tattoo Shop Manager - Calendar', 'tattoo-shop-manager'),
            array('description' => __('Show a Calendar with free and booked days', 'tattoo-shop-manager'),)
        );

        if (is_active_widget(false, false, $this->id_base)) {
            function tattoo_shop_manager_load_flatpickr_frontend()
            {
                wp_enqueue_style('flatpickr-css', plugins_url('/../flatpickr/flatpickr.min.css', __FILE__), array(), '3.0.6');
                wp_enqueue_script('flatpickr-js', plugins_url('/../flatpickr/flatpickr.min.js', __FILE__), array('jquery'), '3.0.6', true);
            }

            add_action('wp_enqueue_scripts', 'tattoo_shop_manager_load_flatpickr_frontend');
        }
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('widget_text', $instance['text']);
        $text_css = apply_filters('widget_text_css', $instance['text_css']);
        $theme = apply_filters('widget_theme', $instance['theme']);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<input style="display:none !important;" name="tattoo_shop_manager_calendar_input" id="tattoo_shop_manager_calendar_input" data-id="inline" readonly="readonly" />';
        echo '<div class="' . $text_css . '"><span>' . $text . '</span></div>';
        echo $args['after_widget'];

        $upcappointments = new WP_Query(array(
            'post_type' => 'tsm-appointments',
            'orderby' => 'meta_value',
            'meta_key' => 'tsm_appointment_meta_date',
            'order' => 'ASC',
            'posts_per_page' => '-1',
            'meta_query' => array(
                array(
                    'key' => 'tsm_appointment_meta_date',
                    'value' => date("Y-m-d"),
                    'compare' => '>=',
                    'type' => 'DATE'
                )
            ),
        ));
        $appDates = '';
        while ($upcappointments->have_posts()) : $upcappointments->the_post();
            $appDates .= '"' . date("Y-m-d", strtotime(get_post_meta(get_the_ID(), 'tsm_appointment_meta_date', true))) . '",';
        endwhile;

        echo '<script style="text/javascript">
            (function($){
                $(document).ready(function(){
                    $("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"' . plugins_url('/../flatpickr/themes/' . $theme . '.css', __FILE__) . '\">");
                    $("head").append("<link rel=\"stylesheet\" type=\"text/css\" href=\"' . plugins_url('/../css/flatpickr_overrides.css', __FILE__) . '\">");
                    $("#tattoo_shop_manager_calendar_input").flatpickr({
                        mode: "single",
                        shorthandCurrentMonth: true,
                        inline: true,
                        minDate: "today",
                        disable: [' . $appDates . ']
                    });
                });
            })(jQuery);
        </script>';

    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Calendar', 'tattoo-shop-manager');
        }

        if (isset($instance['text'])) {
            $text = $instance['text'];
        } else {
            $text = __('Check out our available dates!', 'tattoo-shop-manager');
        }

        if (isset($instance['text_css'])) {
            $text_css = $instance['text_css'];
        } else {
            $text_css = '';
        }

        if (isset($instance['theme'])) {
            $theme = $instance['theme'];
        } else {
            $theme = 'light';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>"
                   name="<?php echo $this->get_field_name('text'); ?>" type="text"
                   value="<?php echo esc_attr($text); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text_css'); ?>"><?php _e('Text CSS classes (i.e. classOne classTwo):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text_css'); ?>"
                   name="<?php echo $this->get_field_name('text_css'); ?>" type="text"
                   value="<?php echo esc_attr($text_css); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Calendar Theme:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('theme'); ?>"
                    name="<?php echo $this->get_field_name('theme'); ?>">
                <option value="light" <?php if (esc_attr($theme) == 'light') {
                    echo 'selected="selected"';
                } ?>>Light
                </option>
                <option value="dark" <?php if (esc_attr($theme) == 'dark') {
                    echo 'selected="selected"';
                } ?>>Dark
                </option>
                <option value="airbnb" <?php if (esc_attr($theme) == 'airbnb') {
                    echo 'selected="selected"';
                } ?>>Airbnb
                </option>
                <option value="confetti" <?php if (esc_attr($theme) == 'confetti') {
                    echo 'selected="selected"';
                } ?>>Confetti
                </option>
                <option value="material_blue" <?php if (esc_attr($theme) == 'material_blue') {
                    echo 'selected="selected"';
                } ?>>Material Blue
                </option>
                <option value="material_green" <?php if (esc_attr($theme) == 'material_green') {
                    echo 'selected="selected"';
                } ?>>Material Green
                </option>
                <option value="material_orange" <?php if (esc_attr($theme) == 'material_orange') {
                    echo 'selected="selected"';
                } ?>>Material Orange
                </option>
                <option value="material_red" <?php if (esc_attr($theme) == 'material_red') {
                    echo 'selected="selected"';
                } ?>>Material Red
                </option>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';
        $instance['text_css'] = (!empty($new_instance['text_css'])) ? strip_tags($new_instance['text_css']) : '';
        $instance['theme'] = (!empty($new_instance['theme'])) ? strip_tags($new_instance['theme']) : '';
        return $instance;
    }
}