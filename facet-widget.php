<?php

class Facet_Widget extends WP_Widget {

    function Facet_Widget() {
        parent::WP_Widget(false, 'Facet Widget');
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $filters = isset($instance['facet']) ? $instance['facet'] : '';
        $show_reset = isset($instance['reset']) ? $instance['reset'] : '';
        $reset_title = isset($instance['reset_title']) ? $instance['reset_title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'facet'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facet') ?>"><?php _e('Show facet:', 'facet') ?></label>
            <?php
            global $wpdb;
            //var_dump($wpdb->base_prefix);
            //$table = ;
            $facets = $wpdb->get_col('SELECT DISTINCT(facet_name) AS Name FROM ' . $wpdb->base_prefix . 'facetwp_index ORDER BY Name ASC');
            //var_dump($res);
            ?>
            <select name="<?php echo $this->get_field_name('facet') ?>">
                <option value=""><?php _e('Choose facet', 'facet') ?></option>
                <?php foreach ($facets as $facet) : ?>
                    <option value="<?php echo $facet ?>" <?php selected($facet, $filters) ?>><?php echo $facet ?></option>
                <?php endforeach ?>
            </select>  
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('reset') ?>"><?php _e('Show reset button:', 'facet') ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('reset')) ?>" type="checkbox" name="<?php echo esc_attr($this->get_field_name('reset')); ?>" <?php checked($show_reset) ?>>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('reset_title'); ?>"><?php _e('Reset button text:', 'facet'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('reset_title')); ?>" name="<?php echo esc_attr($this->get_field_name('reset_title')); ?>" type="text" value="<?php echo esc_attr($reset_title); ?>" size="15" />
        </p>


        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['facet'] = $new_instance['facet'];
        $instance['reset'] = isset($new_instance['reset']) ? true : false;
        $instance['reset_title'] = $new_instance['reset_title'];
        return $instance;
    }

    public function widget($args, $instance) {
        extract($args);

        echo $before_widget;
        // Title, with default 
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        if ($title)
            echo $before_title . $title . $after_title;

        if ($instance['facet']) {
            echo do_shortcode('[facetwp facet="' . $instance['facet'] . '"]');
        }
        if ($instance['reset_title']) {
            $reset_button = $instance['reset_title'];
        } else {
            $reset_button = __('Reset', 'facet');
        }
        //var_dump($instance['reset_title']);
        if (isset( $instance['reset'] ) && $instance['reset']) {
            echo '<a onclick="FWP.reset()" class="button green">' . $reset_button . '</a>';
        }
        echo $after_widget;
    }

}