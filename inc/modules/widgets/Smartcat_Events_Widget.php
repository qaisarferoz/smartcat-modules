<?php

class Smartcat_Events_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-events',
            __( 'Smartcat Events', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-events',
                'description' => __( 'Display the Events you have created', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) {

        if ( file_exists( get_template_directory() . '/smartcat-modules/views/Events_Widget_View.php') ) : 
            include get_template_directory() . '/smartcat-modules/views/Events_Widget_View.php' ;
        else :
            include SMARTCAT_MODULES_PATH . 'inc/modules/views/Events_Widget_View.php';
        endif;
        
    }

    public function form( $instance ) {

        $widths = array(
            '3'     => '1/4',
            '4'     => '1/3',
            '6'     => '1/2',
            '12'    => __( 'Full', 'smartcat-modules' ),
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_events_title'            => __( 'Events', 'smartcat-modules'),
            'scmod_events_widget_width'     => '12',
            'scmod_events_limit'            => '-1',
        ) );

        // Retrieve an existing value from the database
        $scmod_events_title         = !empty( $instance['scmod_events_title'] ) ? $instance['scmod_events_title'] : '';
        $scmod_events_widget_width  = !empty( $instance['scmod_events_widget_width'] ) ? $instance['scmod_events_widget_width'] : '12';
        $scmod_events_limit         = !empty( $instance['scmod_events_limit'] ) ? $instance['scmod_events_limit'] : '-1';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_events_title' ) . '" class="scmod_events_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_events_title' ) . '" name="' . $this->get_field_name( 'scmod_events_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_events_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_events_widget_width' ) . '" class="scmod_events_widget_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_events_widget_width' ) . '" name="' . $this->get_field_name( 'scmod_events_widget_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_events_widget_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Limit Number to Show
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_events_limit' ) . '" class="scmod_events_limit_label">' . __( 'Limit to Show', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_events_limit' ) . '" name="' . $this->get_field_name( 'scmod_events_limit' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_events_limit ) . '">';
        echo '</p>';
        
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_events_title']         = !empty( $new_instance['scmod_events_title'] ) ? strip_tags( $new_instance['scmod_events_title'] ) : '';
        $instance['scmod_events_widget_width']  = !empty( $new_instance['scmod_events_widget_width'] ) ? strip_tags( $new_instance['scmod_events_widget_width'] ) : '12';
        $instance['scmod_events_limit']         = !empty( $new_instance['scmod_events_limit'] ) ? strip_tags( $new_instance['scmod_events_limit'] ) : '-1';

        return $instance;
        
    }

}