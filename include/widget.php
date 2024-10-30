<?php

/**
 * Register and load the widget
 */
function bitwordsRegisterWidget() {
    register_widget('bitwords_widget');
}
add_action('widgets_init', 'bitwordsRegisterWidget');


/**
 * Creating the widget class
 */
class Bitwords_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'bitwords_widget',
            'Bitwords Widget',
            array(
                'description' => 'Widget for to show ads from Bitwords.io'
            )
        );
    }


    /**
     * Creating widget front-end
     */
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if (!empty($title)) echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output!
        echo 'Publishers text here!';
        echo $args['after_widget'];
    }


    /**
     * Update widget
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['bitwords_checkbox'] = isset($new_instance['bitwords_checkbox']) ?
            (bool) $new_instance['bitwords_checkbox'] : false;
        return $instance;
    }


    /**
     * Display widget form
     */
    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $bitwords_checkbox = isset($instance['bitwords_checkbox']) ? (bool) $instance['bitwords_checkbox'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <input
                name="bitwordsAfterArticleMaxStories"
                type="number" min="0" max="10" placeholder="6"
                value="<?php echo $this->get_field_id('bitwordsAfterArticleMaxStories'); ?>" />
            <label for="<?php echo $this->get_field_id('bitwords_checkbox'); ?>"><?php _e('Display publishers?'); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked($bitwords_checkbox); ?> id="<?php echo $this->get_field_id('bitwords_checkbox'); ?>" name="<?php echo $this->get_field_name('bitwords_checkbox'); ?>" />
            <label for="<?php echo $this->get_field_id('bitwords_checkbox'); ?>"><?php _e('Display publishers?'); ?></label>
        </p>
        <?php
    }
}
