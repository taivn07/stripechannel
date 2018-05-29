<div class="wrap-fixed-menu" id="fixedMenu">
	<button type="button" class="fullmenu-close"><i class="fa fa-times"></i></button>
	<nav class="fullscreen-center-menu">
	    <div id="dl-menu" class="dl-menuwrapper">
	    	<?php wp_nav_menu( array(
                'menu'              => '',
                'theme_location'    => 'primary',
                'depth'             => 3,
                'container'         => '',
                'container_class'   => '',
                'container_id'      => '',
                'menu_class'        => 'dl-menu menu-item list-unstyled',
                'fallback_cb'       => 'won_wp_bootstrap_navwalker::fallback',
                'walker'            => new won_wp_bootstrap_navwalker()
            )); ?>
	    </div>
	</nav>
</div>

<header class="header header-topbar-hidden header-boxed-width navbar-fixed-top header-background-trans header-navibox-1-left header-navibox-2-right header-navibox-3-right header-navibox-4-right">
    <div class="container container-boxed-width">
        <nav class="navbar" id="nav">
            <div class="l-design">
			
                <div class="header-navibox-1">
                	<a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand scroll navbar-brand">
	                	<?php if( get_theme_mod( 'logo', '' ) != '' ) { ?>
	                		<img class="normal-logo" src="<?php  echo esc_url( get_theme_mod('logo', '') ); ?>" alt="<?php bloginfo('name');  ?>">
	                		<img class="scroll-logo hidden-xs" src="<?php  echo esc_url( get_theme_mod('logo_scroll', '') ); ?>" alt="<?php bloginfo('name');  ?>">
	                	<?php }else { ?> <span class="blogname"><?php bloginfo('name');  ?></span><?php } ?>
	                </a>
                </div>
				
				<?php if( is_active_sidebar('header_navibox') ){ ?>
					<div class="header-navibox-2">
					   <?php  dynamic_sidebar('header_navibox'); ?>
					</div>
				<?php } ?>
				
				<div class="header-navibox-3">
					<?php wp_nav_menu( array(
		                'menu'              => '',
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => '',
		                'container_class'   => '',
		                'container_id'      => '',
		                'menu_class'        => 'yamm main-menu nav navbar-nav',
		                'fallback_cb'       => 'won_default_wp_bootstrap_navwalker::fallback',
		                'walker'            => new won_default_wp_bootstrap_navwalker()
		            )); ?>
					
				</div>

                <button class="hidden-md hidden-lg menu-mobile-button js-toggle-screen toggle-menu-button"><i class="toggle-menu-button-icon"><span></span><span></span><span></span><span></span><span></span><span></span></i></button>

            </div>
        </nav>
    </div>
</header>




<?php if( get_post_meta( won_get_current_id(), 'won_met_header_bg', true ) == 'yes' ){ ?>
<?php 
	$header_title = get_post_meta( won_get_current_id(), 'won_met_header_title', true );
	$header_sub_title = get_post_meta( won_get_current_id(), 'won_met_header_sub_title', true );
	$header_img = get_post_meta( won_get_current_id(), 'won_met_header_img', true );
	$header_breadcrumbs = get_post_meta( won_get_current_id(), 'won_met_header_breadcrumbs', true );

?>
<div class="section-title-page area-bg" style="background-image: url(<?php echo  $header_img; ?>); ">
	<div class="area-bg__inner">
	  <div class="container">
	    <div class="row">
	      <div class="col-xs-12">

	      	<?php if( $header_title ){ ?>
	        <h1 class="b-title-page"><?php echo esc_html($header_title); ?></h1>
	        <?php } ?>

	        <?php if( $header_sub_title ){ ?>
	        <div class="b-title-page__info"><?php echo esc_html($header_sub_title); ?></div>
	        <?php } ?>

	        <?php if( $header_breadcrumbs == 'yes' ){ ?>
	       		<?php won_breadcrumbs(); ?>
	        <?php } ?>

	        <!-- end breadcrumb-->
	        <div class="ui-decor-1"></div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<?php }else if( get_theme_mod( 'show_header_bg', 'no' ) == 'yes' && ( is_search () || is_category () || is_tag () || is_tax () || is_archive() ) ){ ?>

	

	<div class="section-title-page area-bg" style="background-image: url(<?php echo  get_theme_mod( 'header_bg', '' ); ?>); ">
		<div class="area-bg__inner">
		  <div class="container">
		    <div class="row">
		      <div class="col-xs-12">

		        <h1 class="b-title-page">
		        	<?php
						echo is_search() ? esc_html__('Search results for', 'won').' "' . get_search_query() : '';
						echo is_tag() ? esc_html__('Archive by tag', 'won').' "' . single_tag_title('', false) : '' ;
						echo is_category() ? single_cat_title() : '';
						echo is_archive() ? post_type_archive_title() : '';
						echo is_tax() ? single_term_title() : '';
					?>
		        
		        </h1>

		       	<?php won_breadcrumbs(); ?>

		        <!-- end breadcrumb-->
		        <div class="ui-decor-1"></div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
<?php } ?>




