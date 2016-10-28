<?php

class Smartcat_Testimonials_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-testimonials',
            __( 'Smartcat Testimonials', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-testimonials',
                'description' => __( 'Display your testimonials', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) {

        if ( file_exists( get_template_directory() . '/smartcat-modules/views/Testimonials_Widget_View.php') ) : 
            include_once get_template_directory() . '/smartcat-modules/views/Testimonials_Widget_View.php' ;
        else :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/views/Testimonials_Widget_View.php';
        endif;
        
    }

    public function form( $instance ) {

        $widths = array(
            '6'     => '1/2',
            '12'    => __( 'Full', 'smartcat-modules' ),
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_testimonials_title'          => __( 'Testimonials', 'smartcat-modules'),
            'scmod_testimonials_widget_width'   => '12',
            'scmod_testimonials_limit'          => '-1',
        ) );

        // Retrieve an existing value from the database
        $scmod_testimonials_title           = !empty( $instance['scmod_testimonials_title'] ) ? $instance['scmod_testimonials_title'] : '';
        $scmod_testimonials_widget_width     = !empty( $instance['scmod_testimonials_widget_width'] ) ? $instance['scmod_testimonials_widget_width'] : '12';
        $scmod_testimonials_limit        = !empty( $instance['scmod_testimonials_limit'] ) ? $instance['scmod_testimonials_limit'] : '-1';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_testimonials_title' ) . '" class="scmod_testimonials_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_testimonials_title' ) . '" name="' . $this->get_field_name( 'scmod_testimonials_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_testimonials_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_testimonials_widget_width' ) . '" class="scmod_testimonials_widget_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_testimonials_widget_width' ) . '" name="' . $this->get_field_name( 'scmod_testimonials_widget_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_testimonials_widget_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Limit Number to Show
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_testimonials_limit' ) . '" class="scmod_testimonials_limit_label">' . __( 'Limit to Show', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_testimonials_limit' ) . '" name="' . $this->get_field_name( 'scmod_testimonials_limit' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_testimonials_limit ) . '">';
        echo '</p>';
        
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_testimonials_title']           = !empty( $new_instance['scmod_testimonials_title'] ) ? strip_tags( $new_instance['scmod_testimonials_title'] ) : '';
        $instance['scmod_testimonials_widget_width']    = !empty( $new_instance['scmod_testimonials_widget_width'] ) ? strip_tags( $new_instance['scmod_testimonials_widget_width'] ) : '12';
        $instance['scmod_testimonials_limit']           = !empty( $new_instance['scmod_testimonials_limit'] ) ? strip_tags( $new_instance['scmod_testimonials_limit'] ) : '-1';

        return $instance;
        
    }

}