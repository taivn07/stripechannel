<?php get_header();

// Get content
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<?php 
	$thumbnail = get_the_post_thumbnail_url( get_the_id(), 'full' );

	$portoflio_galleries = get_post_meta( get_the_id(), 'won_met_portoflio_galleries', true );
	
	// reset key array
	$portoflio_galleries = $portoflio_galleries ? array_values($portoflio_galleries) : array('');

	$client_name = get_post_meta( get_the_id(), 'won_met_portfolio_client_name', true);
	$service = get_post_meta( get_the_id(), 'won_met_portfolio_service', true);
	$sub_title = get_post_meta( get_the_id(), 'won_met_portfolio_sub_title', true );
	$portfolio_lauch_date = get_post_meta( get_the_id(), 'won_met_portfolio_lauch_date', true );
	 ?>

	<section class="section-default b-works-details">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php if( $sub_title ){ ?>
			            <div class="ui-subtitle-block-2"><?php echo esc_html($sub_title); ?></div>
		            <?php } ?>
		            <h2 class="ui-title-block"><?php the_title(); ?></h2>
		        </div>
	        </div>
        </div>


		<div class="b-works-details__inner">
	        <div class="b-works-details__section">
	            <div class="row">
	                <div class="col-sm-6 col-sm-push-6">
	                    <div class="b-works-details__info">
	                        <h3 class="b-works-details__title"><?php esc_html_e( 'project details', 'won' ); ?></h3>
	                      	<?php echo get_post_meta( get_the_id(), 'won_met_portfolio_detail', true); ?>
	                    </div>
	                </div>
	                <?php if( isset($portoflio_galleries[0]) && ( $portoflio_galleries[0] != '' ) ){ ?>
	                <div class="col-sm-6 col-sm-pull-6">
	                    <a class="tilter tilter--1 js-zoom-images img-hover-effect img-hover-effect " href="<?php echo esc_url($portoflio_galleries[0]); ?>">
	                        <figure class="tilter__figure">
	                            <img class="img-responsive" src="<?php echo esc_url($portoflio_galleries[0]); ?>" alt="<?php the_title(); ?>" />
	                        </figure>
	                    </a>
	                </div>
	                <?php }else if( $thumbnail ){ ?>
	                	<div class="col-sm-6 col-sm-pull-6">
		                    <a class="tilter tilter--1 js-zoom-images img-hover-effect img-hover-effect " href="<?php echo esc_url($thumbnail); ?>">
		                        <figure class="tilter__figure">
		                            <img class="img-responsive" src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" />
		                        </figure>
		                    </a>
		                </div>
	                <?php } ?>
	            </div>
	        </div>
	        <div class="b-works-details__section">
	            <div class="row">
	                <div class="col-sm-6">
	                    <h3 class="b-works-details__title"><?php esc_html_e( 'project summary', 'won' ); ?></h3>
	                    <dl class="b-works-details__description dl-horizontal">

	                    	<?php if( $client_name != ''){ ?>
		                        <dt class="b-works-details__description-name"><?php esc_html_e( 'client name', 'won' ); ?></dt>
		                        <dd class="b-works-details__description-info"><?php echo esc_html($client_name); ?></dd>
	                        <?php } ?>

	                        <?php if($portfolio_lauch_date != ''){ ?>
		                        <dt class="b-works-details__description-name"><?php esc_html_e( 'launch date', 'won' ); ?></dt>
		                        <dd class="b-works-details__description-info"><?php echo esc_html($portfolio_lauch_date); ?></dd>
	                        <?php } ?>

	                        <?php if( $service != '' ){ ?>
		                        <dt class="b-works-details__description-name"><?php esc_html_e( 'services', 'won' ); ?></dt>
		                        <dd class="b-works-details__description-info"><?php echo esc_html($service); ?></dd>
	                        <?php } ?>
	                    </dl>

	                    <?php apply_filters( 'won_share_portoflio_social', $thumbnail, 10 ); ?>
	                    
	                </div>
	                <?php if( isset($portoflio_galleries[1]) && $portoflio_galleries[1] != '' ){ ?>
		                <div class="col-sm-6">
		                    <a class="tilter tilter--1 js-zoom-images img-hover-effect img-hover-effect " href="<?php echo esc_url($portoflio_galleries[1]); ?>">
		                        <figure class="tilter__figure">
		                            <img class="img-responsive" src="<?php echo esc_url($portoflio_galleries[1]); ?>" alt="<?php the_title(); ?>" />
		                        </figure>
		                    </a>
		                </div>
	                <?php } ?>
	            </div>
	        </div>
	        <div class="b-works-details__section">
	            <div class="row">
	            	<?php if( isset($portoflio_galleries[2]) && ( $portoflio_galleries[2] != null ) ){ ?>
		                <div class="col-sm-6">
		                    <a class="tilter tilter--1 js-zoom-images img-hover-effect img-hover-effect " href="<?php echo esc_url($portoflio_galleries[2]); ?>">
		                        <figure class="tilter__figure">
		                            <img class="img-responsive" src="<?php echo esc_url($portoflio_galleries[2]); ?>" alt="<?php the_title(); ?>" />
		                        </figure>
		                    </a>
		                </div>
	                <?php } ?>
	                <?php if( isset($portoflio_galleries[3]) && ( $portoflio_galleries[3] != '' ) ){ ?>
		                <div class="col-sm-6">
		                    <a class="tilter tilter--1 js-zoom-images img-hover-effect img-hover-effect " href="<?php echo esc_url($portoflio_galleries[3]); ?>">
		                        <figure class="tilter__figure">
		                            <img class="img-responsive" src="<?php echo esc_url($portoflio_galleries[3]); ?>" alt="foto" />
		                        </figure>
		                    </a>
		                </div>
	                <?php } ?>
	            </div>
	        </div>
	        <div class="ova_extra_content b-works-details__section">
				<?php the_content(''); ?>
			</div>

			


	        <div class="section-pager">
	            <div class="row">
	                <div class="col-xs-12">
	                    <ul class="pager">
	                    	<?php 
	                    		$prev_post = get_previous_post();
	                    		$next_post = get_next_post();
	                    	?>
	                    	<?php if (!empty( $prev_post )) { ?>
	                        <li>
	                            <div class="ui-decor ui-decor_single"></div> 
	                            <a href="<?php echo esc_url($prev_post->guid); ?>"><?php esc_html_e( 'prev work', 'won' ); ?></a>
	                        </li>
	                        <?php } ?>
	                        <?php if (!empty( $next_post )) { ?>
	                        <li>
	                            <div class="ui-decor ui-decor_single"></div>
	                            <a href="<?php echo esc_url($next_post->guid); ?>"><?php esc_html_e( 'next work', 'won' ); ?></a>
	                        </li>
	                        <?php } ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
		
	</section>
    
	
<?php

endwhile; else :
    get_template_part( 'content/content', 'none' );
endif;
wp_reset_postdata(); 

get_footer(); ?>
