<?php

$args = array (
    'post_type' => array ( 'position' ),
    'post_status' => array ( 'publish' ),
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => ( !empty( $instance['scmod_positions_limit'] ) ? (int)$instance['scmod_positions_limit'] : -1 ),
);

// The Query
$positions = new WP_Query( $args );

// The Loop
if ( $positions->have_posts() ) : ?>

    <div class="<?php echo isset( $instance['scmod_positions_widget_width'] ) ? 'col-sm-' . $instance['scmod_positions_widget_width'] : 'col-sm-12'; ?>">

        <h2 class="widget-title">
            <?php echo !empty( $instance['scmod_positions_title'] ) ? esc_html( $instance['scmod_positions_title'] ) : ''; ?>
        </h2>
        
        <div class="row">

            <?php while ( $positions->have_posts() ) : $positions->the_post(); ?>

                <div class="single-position col-sm-12">

                    <div class="row">

                        <div class="position-content col-sm-12">

                            <div class="row">

                                <div class="col-sm-6">
                                    
                                    <h3 class="position-title">
                                        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>">
                                            <?php echo esc_html( get_the_title() ); ?>
                                        </a>
                                    </h3>
                                    
                                    <h4 class="position-company"><?php echo esc_html( get_post_meta( get_the_ID(), 'position_meta_company', true ) ); ?></h4>
                                    
                                </div>

                                <div class="col-sm-6">
                                    
                                    <h4 class="position-date">
                                        <?php echo esc_html( date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'position_meta_start_date', true ) ) ) . ' - ' . date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'position_meta_end_date', true ) ) ) ); ?>
                                    </h4>
                                    
                                </div>

                                <div class="col-sm-12">

                                    <div class="position-description">
                                        <p><?php echo esc_html( get_the_content() ); ?></p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>      

                </div>

            <?php endwhile; ?>

        </div>

    </div>

<?php else : ?>

    <h4 class="none-to-display"><?php _e( 'There are currently no work history positions to display, please check again at a later time.', 'smartcat-modules' ); ?></h4>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<div class="clear"></div>
