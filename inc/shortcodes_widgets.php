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