<?php

class Facet_Reset_Widget extends WP_Widget {

    function Facet_Reset_Widget() {
        parent::WP_Widget(false, 'Facet reset button Widget');
    }

    public function form($instance) {
        $show_reset = isset($instance['reset']) ? $instance['reset'] : '';
        $reset_title = isset($instance['reset_title']) ? $instance['reset_title'] : '';
        ?>
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
        $instance['reset'] = isset($new_instance['reset']) ? true : false;
        $instance['reset_title'] = $new_instance['reset_title'];
        return $instance;
    }

    public function widget($args, $instance) {
        extract($args);

        echo $before_widget;

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