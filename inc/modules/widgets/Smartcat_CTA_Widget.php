<?php

class Smartcat_CTA_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'vivita-cta',
            __( 'Vivita Call to Action', 'vivita' ),
            array(
                    'classname'   => 'vivita-cta',
            )
        );

    }

    public function widget( $args, $instance ) { ?>

        <div class="vivita-callout">

            <h3 class="widget-title"><?php echo isset( $instance['vivita_cta_title'] ) && $instance['vivita_cta_title'] ? $instance['vivita_cta_title'] : ''; ?></h3>
            <div class="diviver"><span></span></div>
            <div class="textwidget"><?php echo isset( $instance['vivita_cta_detail'] ) && $instance['vivita_cta_detail'] ? $instance['vivita_cta_detail'] : ''; ?></div>
            <div>
                <?php if( isset( $instance['vivita_cta_button1_url'] ) && $instance['vivita_cta_button1_url'] ) : ?>
                    <a class="vivita-button" href="<?php echo esc_url( $instance['vivita_cta_button1_url'] ); ?>"><?php echo isset( $instance['vivita_cta_button1_text'] ) ? $instance['vivita_cta_button1_text'] : ''; ?></a>
                <?php endif; ?>
                <?php if( isset( $instance['vivita_cta_button2_url'] ) && $instance['vivita_cta_button2_url'] ) : ?>
                    <a class="vivita-button" href="<?php echo esc_url( $instance['vivita_cta_button2_url'] ); ?>"><?php echo isset( $instance['vivita_cta_button2_text'] ) ? $instance['vivita_cta_button2_text'] : ''; ?></a>
                <?php endif; ?>
            </div>

        </div>


    <?php }

    public function form( $instance ) {

        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
                'vivita_cta_title' => '',
                'vivita_cta_detail' => '',
                'vivita_cta_button1_text' => '',
                'vivita_cta_button1_url' => '',
                'vivita_cta_button2_text' => '',
                'vivita_cta_button2_url' => '',
        ) );

        // Retrieve an existing value from the database
        $vivita_cta_title = !empty( $instance['vivita_cta_title'] ) ? $instance['vivita_cta_title'] : '';
        $vivita_cta_detail = !empty( $instance['vivita_cta_detail'] ) ? $instance['vivita_cta_detail'] : '';
        $vivita_cta_button1_text = !empty( $instance['vivita_cta_button1_text'] ) ? $instance['vivita_cta_button1_text'] : '';
        $vivita_cta_button1_url = !empty( $instance['vivita_cta_button1_url'] ) ? $instance['vivita_cta_button1_url'] : '';
        $vivita_cta_button2_text = !empty( $instance['vivita_cta_button2_text'] ) ? $instance['vivita_cta_button2_text'] : '';
        $vivita_cta_button2_url = !empty( $instance['vivita_cta_button2_url'] ) ? $instance['vivita_cta_button2_url'] : '';

        // Form fields
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_title' ) . '" class="vivita_cta_title_label">' . __( 'Title', 'vivita' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'vivita_cta_title' ) . '" name="' . $this->get_field_name( 'vivita_cta_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '" value="' . esc_attr( $vivita_cta_title ) . '">';
        echo '</p>';

        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_detail' ) . '" class="vivita_cta_detail_label">' . __( 'Details', 'vivita' ) . '</label>';
        echo '	<textarea id="' . $this->get_field_id( 'vivita_cta_detail' ) . '" name="' . $this->get_field_name( 'vivita_cta_detail' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '">' . $vivita_cta_detail . '</textarea>';
        echo '</p>';

        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_button1_text' ) . '" class="vivita_cta_button1_text_label">' . __( 'Button 1 Text', 'vivita' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'vivita_cta_button1_text' ) . '" name="' . $this->get_field_name( 'vivita_cta_button1_text' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '" value="' . esc_attr( $vivita_cta_button1_text ) . '">';
        echo '</p>';

        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_button1_url' ) . '" class="vivita_cta_button1_url_label">' . __( 'Button 1 URL', 'vivita' ) . '</label>';
        echo '	<input type="url" id="' . $this->get_field_id( 'vivita_cta_button1_url' ) . '" name="' . $this->get_field_name( 'vivita_cta_button1_url' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '" value="' . esc_attr( $vivita_cta_button1_url ) . '">';
        echo '</p>';

        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_button2_text' ) . '" class="vivita_cta_button2_text_label">' . __( 'Button 2 Text', 'vivita' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'vivita_cta_button2_text' ) . '" name="' . $this->get_field_name( 'vivita_cta_button2_text' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '" value="' . esc_attr( $vivita_cta_button2_text ) . '">';
        echo '</p>';

        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'vivita_cta_button2_url' ) . '" class="vivita_cta_button2_url_label">' . __( 'Button 2 URL', 'vivita' ) . '</label>';
        echo '	<input type="url" id="' . $this->get_field_id( 'vivita_cta_button2_url' ) . '" name="' . $this->get_field_name( 'vivita_cta_button2_url' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'vivita' ) . '" value="' . esc_attr( $vivita_cta_button2_url ) . '">';
        echo '</p>';

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['vivita_cta_title'] = !empty( $new_instance['vivita_cta_title'] ) ? strip_tags( $new_instance['vivita_cta_title'] ) : '';
        $instance['vivita_cta_detail'] = !empty( $new_instance['vivita_cta_detail'] ) ? strip_tags( $new_instance['vivita_cta_detail'] ) : '';
        $instance['vivita_cta_button1_text'] = !empty( $new_instance['vivita_cta_button1_text'] ) ? strip_tags( $new_instance['vivita_cta_button1_text'] ) : '';
        $instance['vivita_cta_button1_url'] = !empty( $new_instance['vivita_cta_button1_url'] ) ? strip_tags( $new_instance['vivita_cta_button1_url'] ) : '';
        $instance['vivita_cta_button2_text'] = !empty( $new_instance['vivita_cta_button2_text'] ) ? strip_tags( $new_instance['vivita_cta_button2_text'] ) : '';
        $instance['vivita_cta_button2_url'] = !empty( $new_instance['vivita_cta_button2_url'] ) ? strip_tags( $new_instance['vivita_cta_button2_url'] ) : '';

        return $instance;

    }

}