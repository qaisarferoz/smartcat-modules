<?php

class Smartcat_Pricing_Table_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-pricing-table',
            __( 'Smartcat Pricing Table', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-pricing-table',
                'description' => __( 'Output a Pricing Table module', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) { 

        // IF WIDGET OUTPUT EXISTS IN THEME
            // Load Widget Output from Theme
        // ELSE 
            // Output Module Default from inc/modules/views
        // ENDIF

    }

    public function form( $instance ) {

        $widths = array(
            '3'     => '1/4',
            '4'     => '1/3',
            '6'     => '1/2',
            '12'    => 'full'
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_pricing_table_title'         => _( 'Pricing Table', 'smartcat-modules'),
            'scmod_pricing_table_width'         => 'full',
            'scmod_pricing_table_detail'        => _( 'Detail Text', 'smartcat-modules'),
            'scmod_pricing_table_is_special'    => '',
            'scmod_pricing_table_price'         => '',
            'scmod_pricing_table_description'   => '',
        ) );

        // Retrieve an existing value from the database
        $scmod_pricing_table_title       = !empty( $instance['scmod_pricing_table_title'] ) ? $instance['scmod_pricing_table_title'] : _( 'Pricing Table', 'smartcat-modules');
        $scmod_pricing_table_width       = !empty( $instance['scmod_pricing_table_width'] ) ? $instance['scmod_pricing_table_width'] : 'full';
        $scmod_pricing_table_detail      = !empty( $instance['scmod_pricing_table_detail'] ) ? $instance['scmod_pricing_table_detail'] : _( 'Detail Text', 'smartcat-modules');
        $scmod_pricing_table_is_special  = !empty( $instance['scmod_pricing_table_is_special'] ) ? $instance['scmod_pricing_table_is_special'] : '';
        $scmod_pricing_table_price       = !empty( $instance['scmod_pricing_table_price'] ) ? $instance['scmod_pricing_table_price'] : '';
        $scmod_pricing_table_description = !empty( $instance['scmod_pricing_table_description'] ) ? $instance['scmod_pricing_table_description'] : '';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_pricing_table_title' ) . '" class="scmod_pricing_table_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_pricing_table_title' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_title' ) . '" class="widefat" placeholder="' . esc_attr__( 'Title', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_pricing_table_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_pricing_table_width' ) . '" class="scmod_pricing_table_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_pricing_table_width' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_pricing_table_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Detail Text - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_pricing_table_detail' ) . '" class="scmod_pricing_table_detail_label">' . __( 'Detail Text', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_pricing_table_detail' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_detail' ) . '" class="widefat" placeholder="' . esc_attr__( 'Detail Text', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_pricing_table_detail ) . '">';
        echo '</p>';
        
        // Is Special? - Checkbox
        echo '<p>';
        echo '	<label>';
        echo '      <input type="checkbox" id="' . $this->get_field_id( 'scmod_pricing_table_is_special' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_is_special' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'athena' ) . '" value="1" ' . checked( $scmod_pricing_table_is_special, true, false ) . '>' . __( 'Special', 'athena' );
        echo '	</label><br>';
        echo '</p>';
          
        // Price - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_pricing_table_price' ) . '" class="scmod_pricing_table_price_label">' . __( 'Price', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_pricing_table_price' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_price' ) . '" class="widefat" placeholder="' . esc_attr__( 'Price', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_pricing_table_price ) . '">';
        echo '</p>';
        
        // Description - Textarea
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_pricing_table_description' ) . '" class="scmod_pricing_table_description_label">' . __( 'Description', 'smartcat-modules' ) . '</label>';
        echo '	<textarea id="' . $this->get_field_id( 'scmod_pricing_table_description' ) . '" name="' . $this->get_field_name( 'scmod_pricing_table_description' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '">' . $scmod_pricing_table_description . '</textarea>';
        echo '</p>';

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_pricing_table_title']   = !empty( $new_instance['scmod_pricing_table_title'] ) ? strip_tags( $new_instance['scmod_pricing_table_title'] ) : _( 'Pricing Table', 'smartcat-modules');
        $instance['scmod_pricing_table_width']   = !empty( $new_instance['scmod_pricing_table_width'] ) ? strip_tags( $new_instance['scmod_pricing_table_width'] ) : 'full';
        $instance['scmod_pricing_table_detail']  = !empty( $new_instance['scmod_pricing_table_detail'] ) ? strip_tags( $new_instance['scmod_pricing_table_detail'] ) : _( 'Detail Text', 'smartcat-modules');
        $instance['scmod_pricing_table_is_special']   = !empty( $new_instance['scmod_pricing_table_is_special'] ) ? strip_tags( $new_instance['scmod_pricing_table_is_special'] ) : '';
        $instance['scmod_pricing_table_price']   = !empty( $new_instance['scmod_pricing_table_price'] ) ? strip_tags( $new_instance['scmod_pricing_table_price'] ) : '';
        $instance['scmod_pricing_table_description'] = !empty( $new_instance['scmod_pricing_table_description'] ) ? strip_tags( $new_instance['scmod_pricing_table_description'] ) : '';
        
        return $instance;
        
    }

}