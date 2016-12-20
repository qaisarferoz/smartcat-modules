<?php

class Smartcat_New_Row_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-new-row',
            __( 'Smartcat New Row', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-new-row',
                'description' => __( 'Add this widget after a group of widgets to begin a new row. Prevents the next row of widgets from lining up unevenly.', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) { ?>

        <div class="clear"></div>
            
    <?php }

    public function form( $instance ) {  }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        return $instance;

    }

}