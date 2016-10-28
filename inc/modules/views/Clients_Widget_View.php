<?php

$args = array (
    'post_type' => array ( 'client' ),
    'post_status' => array ( 'publish' ),
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => ( !empty( $instance['scmod_clients_limit'] ) ? (int)$instance['scmod_clients_limit'] : -1 ),
);

// The Query
$clients = new WP_Query( $args );

// The Loop
if ( $clients->have_posts() ) : ?>

    <div class="<?php echo isset( $instance['scmod_clients_widget_width'] ) ? 'col-sm-' . $instance['scmod_clients_widget_width'] : 'col-sm-12'; ?>">

        <h2 class="widget-title">
            <?php echo !empty( $instance['scmod_clients_title'] ) ? esc_html( $instance['scmod_clients_title'] ) : ''; ?>
        </h2>
        
        <div class="row">

            <?php while ( $clients->have_posts() ) : $clients->the_post(); ?>

                <div class="single-client col-sm-12">

                    <div class="row">

                        <?php if ( has_post_thumbnail() ) : ?>

                            <div class="client-logo col-sm-3">
                                <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'client_url', true ) ); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
                                </a>
                            </div>

                        <?php endif; ?>

                        <div class="client-content col-sm-<?php echo has_post_thumbnail() ? '9' : '12'; ?>">

                            <div class="row">

                                <div class="col-sm-12">
                                    
                                    <h3 class="title">
                                        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'client_url', true ) ); ?>">
                                            <?php echo esc_html( get_the_title() ); ?>
                                        </a>
                                    </h3>
                                    
                                    <h4 class="location"><?php echo esc_html( get_post_meta( get_the_ID(), 'client_location', true ) ); ?></h4>
                                    
                                </div>

                                <div class="col-sm-12">

                                    <hr>

                                    <div class="description">
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

    <h4 class="none-to-display"><?php _e( 'There are currently no clients to display, please check again at a later time.', 'smartcat-modules' ); ?></h4>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<div class="clear"></div>