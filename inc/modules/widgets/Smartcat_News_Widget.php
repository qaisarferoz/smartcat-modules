<?php

class Smartcat_News_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-news',
            __( 'Smartcat News', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-news',
                'description' => __( 'Display your recent news articles', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) {

        if ( file_exists( get_template_directory() . '/smartcat-modules/views/News_Widget_View.php') ) : 
            include get_template_directory() . '/smartcat-modules/views/News_Widget_View.php' ;
        else :
            include SMARTCAT_MODULES_PATH . 'inc/modules/views/News_Widget_View.php';
        endif;
        
    }

    public function form( $instance ) {

        $widths = array(
            '6'     => '1/2',
            '12'    => __( 'Full', 'smartcat-modules' ),
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_news_title'          => __( 'News', 'smartcat-modules'),
            'scmod_news_widget_width'   => '12',
            'scmod_news_limit'          => '-1',
        ) );

        // Retrieve an existing value from the database
        $scmod_news_title        = !empty( $instance['scmod_news_title'] ) ? $instance['scmod_news_title'] : '';
        $scmod_news_widget_width = !empty( $instance['scmod_news_widget_width'] ) ? $instance['scmod_news_widget_width'] : '12';
        $scmod_news_limit        = !empty( $instance['scmod_news_limit'] ) ? $instance['scmod_news_limit'] : '-1';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_news_title' ) . '" class="scmod_news_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_news_title' ) . '" name="' . $this->get_field_name( 'scmod_news_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_news_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_news_widget_width' ) . '" class="scmod_news_widget_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_news_widget_width' ) . '" name="' . $this->get_field_name( 'scmod_news_widget_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_news_widget_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Limit Number to Show
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_news_limit' ) . '" class="scmod_news_limit_label">' . __( 'Limit to Show', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_news_limit' ) . '" name="' . $this->get_field_name( 'scmod_news_limit' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_news_limit ) . '">';
        echo '</p>';
        
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_news_title']           = !empty( $new_instance['scmod_news_title'] ) ? strip_tags( $new_instance['scmod_news_title'] ) : '';
        $instance['scmod_news_widget_width']    = !empty( $new_instance['scmod_news_widget_width'] ) ? strip_tags( $new_instance['scmod_news_widget_width'] ) : '12';
        $instance['scmod_news_limit']           = !empty( $new_instance['scmod_news_limit'] ) ? strip_tags( $new_instance['scmod_news_limit'] ) : '-1';

        return $instance;
        
    }

}