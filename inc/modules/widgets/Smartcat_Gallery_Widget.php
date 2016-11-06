<?php

class Smartcat_Gallery_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-gallery',
            __( 'Smartcat Gallery', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-gallery',
                'description' => __( 'Display the Gallery Items you have created', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) {

        if ( file_exists( get_template_directory() . '/smartcat-modules/views/Gallery_Widget_View.php') ) : 
            include get_template_directory() . '/smartcat-modules/views/Gallery_Widget_View.php' ;
        else :
            include SMARTCAT_MODULES_PATH . 'inc/modules/views/Gallery_Widget_View.php';
        endif;
        
    }

    public function form( $instance ) {

        $widths = array( 
            '6'     => '1/2',
            '12'    => __( 'Full', 'smartcat-modules' ),
        );
        
        $order = array(
            'normal'    => __( 'Default', 'smartcat-modules' ),
            'shuffle'   => __( 'Randomize Order', 'smartcat-modules' ),
        );
        
        $styles = array(
            'columns'   => __( 'Columns', 'smartcat-modules' ),
            'justified' => __( 'Justified', 'smartcat-modules' ),
            'nested'    => __( 'Nested', 'smartcat-modules' ),
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_gallery_title'           => __( 'Gallery', 'smartcat-modules'),
            'scmod_gallery_widget_width'    => '12',
            'scmod_gallery_tile_style'      => 'columns',
            'scmod_gallery_limit'           => '-1',
            'scmod_gallery_shuffle'         => 'normal',
        ) );

        // Retrieve an existing value from the database
        $scmod_gallery_title        = !empty( $instance['scmod_gallery_title'] ) ? $instance['scmod_gallery_title'] : '';
        $scmod_gallery_widget_width = !empty( $instance['scmod_gallery_widget_width'] ) ? $instance['scmod_gallery_widget_width'] : '12';
        $scmod_gallery_tile_style   = !empty( $instance['scmod_gallery_tile_style'] ) ? $instance['scmod_gallery_tile_style'] : 'columns';
        $scmod_gallery_limit        = !empty( $instance['scmod_gallery_limit'] ) ? $instance['scmod_gallery_limit'] : '-1';
        $scmod_gallery_shuffle      = !empty( $instance['scmod_gallery_shuffle'] ) ? $instance['scmod_gallery_shuffle'] : '-1';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_gallery_title' ) . '" class="scmod_gallery_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_gallery_title' ) . '" name="' . $this->get_field_name( 'scmod_gallery_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_gallery_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_gallery_widget_width' ) . '" class="scmod_gallery_widget_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_gallery_widget_width' ) . '" name="' . $this->get_field_name( 'scmod_gallery_widget_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_gallery_widget_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Tile Style - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_gallery_tile_style' ) . '" class="scmod_gallery_tile_style_label">' . __( 'Tile Style', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_gallery_tile_style' ) . '" name="' . $this->get_field_name( 'scmod_gallery_tile_style' ) . '" class="widefat">';
            foreach( $styles as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_gallery_tile_style, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';
        
        // Limit Number to Show
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_gallery_limit' ) . '" class="scmod_gallery_limit_label">' . __( 'Limit to Show', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_gallery_limit' ) . '" name="' . $this->get_field_name( 'scmod_gallery_limit' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_gallery_limit ) . '">';
        echo '</p>';
        
        // Tile Ordering Style - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_gallery_shuffle' ) . '" class="scmod_gallery_shuffle_label">' . __( 'Randomize Slide Order?', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_gallery_shuffle' ) . '" name="' . $this->get_field_name( 'scmod_gallery_shuffle' ) . '" class="widefat">';
            foreach( $order as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_gallery_shuffle, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_gallery_title']            = !empty( $new_instance['scmod_gallery_title'] ) ? strip_tags( $new_instance['scmod_gallery_title'] ) : '';
        $instance['scmod_gallery_widget_width']     = !empty( $new_instance['scmod_gallery_widget_width'] ) ? strip_tags( $new_instance['scmod_gallery_widget_width'] ) : '12';
        $instance['scmod_gallery_tile_style']       = !empty( $new_instance['scmod_gallery_tile_style'] ) ? strip_tags( $new_instance['scmod_gallery_tile_style'] ) : 'columns';
        $instance['scmod_gallery_limit']            = !empty( $new_instance['scmod_gallery_limit'] ) ? strip_tags( $new_instance['scmod_gallery_limit'] ) : '-1';
        $instance['scmod_gallery_shuffle']          = !empty( $new_instance['scmod_gallery_shuffle'] ) ? strip_tags( $new_instance['scmod_gallery_shuffle'] ) : 'normal';

        return $instance;
        
    }

}