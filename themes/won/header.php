<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

    <!-- Loader-->
    <?php if( get_theme_mod( 'loader', 'yes' ) == 'yes' ){ ?>
        <div class="screen-loader">
            <div class="loading"><span class="loader_span"><span class="loader_right"></span><span class="loader_left"></span></span>
            </div><span class="loader-text shuffle"><?php esc_html_e( 'Download...', 'won' ); ?></span>
            <div class="sl-top"></div>
            <div class="sl-bottom"></div>
        </div>
    <?php } ?>
    <!-- Loader end-->

    <div class="ovatheme_container_<?php echo esc_attr(won_get_current_width_site()); ?>">
        <div class="wrapper">
            <div class="l-theme animated-css" data-header="sticky" data-header-top="200" data-canvas="container">
    	
        <?php  $header = won_get_current_header(); 
			get_template_part( 'header/header', $header ); ?>

        <?php
        if( is_page_template( 'templates/fullwidth.php' ) == false  && !is_post_type_archive( 'portfolio' ) && !is_tax( 'categories' ) ){
            do_action('won_open_layout');
        }
          ?>