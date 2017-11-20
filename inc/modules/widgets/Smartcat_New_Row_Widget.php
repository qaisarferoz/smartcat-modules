<?php

class Smartcat_New_Row_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-new-row',
            __( 'Smartcat New Row & Spacer', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-new-row',
                'description' => __( 'Add this after a group of widgets to begin a new row and prevent the next row from lining up unevenly.', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) { ?>

        <div class="clear" <?php echo isset( $instance['spacer_height'] ) ? 'style="margin-bottom: ' . $instance['spacer_height'] . 'px;"' : ''; ?>>
        </div>
            
    <?php }

    public function form( $instance ) { 
        
        $instance = wp_parse_args( (array) $instance, array( 
            'spacer_height'     =>  0,
        ) );
       
        $spacer_height          = !empty( $instance['spacer_height'] ) ? $instance['spacer_height'] : 0;
      
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'spacer_height' ) . '" class="spacer_height_label">' . __( 'Spacer Height (Pixel Value)', 'smartcat-modules' ) . '</label>';
        echo '	<input type="number" id="' . $this->get_field_id( 'spacer_height' ) . '" name="' . $this->get_field_name( 'spacer_height' ) . '" class="widefat" min="0" value="' . esc_attr( $spacer_height ) . '">';
        echo '</p>';
        
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['spacer_height']      = !empty( $new_instance['spacer_height'] ) ? strip_tags( $new_instance['spacer_height'] ) : '';

        return $instance;

    }

}