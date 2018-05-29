<?php
add_action('wp_enqueue_scripts', 'won_theme_scripts_styles');
add_action('wp_enqueue_scripts', 'won_primary_color');




function won_theme_scripts_styles() {


    /* Google Font */
    wp_enqueue_style( 'won_fonts', won_customize_google_fonts(), array(), null );

    // enqueue the javascript that performs in-link comment reply fanciness
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
    }
    
    /* Add Javascript  */
    wp_enqueue_script('modernizr_custom', OVATHEME_URI.'/assets/libs/modernizr.custom.js', array('jquery'),null,true);
    wp_enqueue_script('bootstrap', OVATHEME_URI.'/assets/libs/bootstrap/bootstrap.min.js', array('jquery'),null,true);
    wp_enqueue_script('owl_carousel', OVATHEME_URI.'/assets/plugins/owl-carousel/owl.carousel.min.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_magnific_popup', OVATHEME_URI.'/assets/plugins/magnific-popup/jquery.magnific-popup.min.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_dlmenu', OVATHEME_URI.'/assets/plugins/headers/jquery.dlmenu.js', array('jquery'),null,true);
    wp_enqueue_script('slidebar', OVATHEME_URI.'/assets/plugins/headers/slidebar.js', array('jquery'),null,true);
    wp_enqueue_script('header', OVATHEME_URI.'/assets/plugins/headers/header.js', array('jquery'),null,true);
    wp_enqueue_script('jqBootstrapValidation', OVATHEME_URI.'/assets/plugins/jqBootstrapValidation.js', array('jquery'),null,true);
    wp_enqueue_script('isotope_pkgd_min', OVATHEME_URI.'/assets/plugins/isotope/isotope.pkgd.min.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_easypiechart_min', OVATHEME_URI.'/assets/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js', array('jquery'),null,true);
    wp_enqueue_script('waypoints_min', OVATHEME_URI.'/assets/plugins/rendro-easy-pie-chart/waypoints.min.js', array('jquery'),null,true);
    wp_enqueue_script('scrollMonitor', OVATHEME_URI.'/assets/plugins/revealer/js/scrollMonitor.js', array('jquery'),null,true);
    wp_enqueue_script('revealer_main', OVATHEME_URI.'/assets/plugins/revealer/js/main.js', array('jquery'),null,true);
    wp_enqueue_script('imagesloaded_pkgd_min', OVATHEME_URI.'/assets/plugins/TiltHoverEffects/js/imagesloaded.pkgd.min.js', array('jquery'),null,true);
    wp_enqueue_script('anime_min', OVATHEME_URI.'/assets/plugins/TiltHoverEffects/js/anime.min.js', array('jquery'),null,true);
    wp_enqueue_script('TiltHoverEffects_main', OVATHEME_URI.'/assets/plugins/TiltHoverEffects/js/main.js', array('jquery'),null,true);
    wp_enqueue_script('wow_min', OVATHEME_URI.'/assets/plugins/animate/wow.min.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_shuffleLetters', OVATHEME_URI.'/assets/plugins/animate/jquery.shuffleLetters.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_sticky_kit', OVATHEME_URI.'/assets/plugins/animate/jquery.sticky-kit.js', array('jquery'),null,true);
    wp_enqueue_script('typed', OVATHEME_URI.'/assets/plugins/animate/typed.js', array('jquery'),null,true);
    wp_enqueue_script('won_fullpage', OVATHEME_URI.'/assets/js/jquery.fullPage.js', array('jquery'),null,true);
    wp_enqueue_script('won_customs', OVATHEME_URI.'/assets/js/custom.js', array('jquery'),null,true);
    wp_enqueue_script('jquery_sliderPro_min', OVATHEME_URI.'/assets/plugins/slider-pro/jquery.sliderPro.min.js', array('jquery'),null,true);
    
   


    /* Add Css  */
    wp_enqueue_style('won_master', OVATHEME_URI.'/assets/css/master.css', array(), null);
    wp_enqueue_style('won_default', OVATHEME_URI.'/assets/css/default.css', array(), null);
    wp_enqueue_style('won_fullpage', OVATHEME_URI.'/assets/js/jquery.fullPage.css', array(), null);

    if ( is_child_theme() ) {
      wp_enqueue_style( 'parent_stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css', array(), null );
    }

    wp_enqueue_style( 'won_style', get_stylesheet_uri(), array(), null );

}



function won_primary_color(){

  $main_color = get_theme_mod('main_color', '#f0f8ff');
  $body_font = str_replace('ovatheme_','',get_theme_mod('body_font', 'Work Sans'));
  $second_color = get_theme_mod('second_color', '#000000');
  
  $custom_css = "
    body{
      font-family: {$body_font}, sans-serif;
    }
    .ovatheme_header_default nav.navbar li.active>a{
      color: {$main_color};
    }

    
    a,
    .text-primary,
    .text-primary_h:hover,
    .text-primary_b:before,
    .text-primary_a:after,
    .list > li > a:hover,
    .pager li > a:hover,
    .pager li > a:hover .icon,
    .pagination_primary > li:first-child > a:hover,
    .pagination_primary > li:first-child > a:hover .icon,
    .pagination_primary > li:last-child > a:hover,
    .pagination_primary > li:last-child > a:hover .icon,
    .search-close:hover,
    .breadcrumb > li > a:hover,
    .b-blockquote-1 .b-blockquote__cite:before {color: {$second_color};}

    .about_team .b-team,
    .about_team .b-team .b-team__inner,
    .bg-primary,
    .bg-primary_h:hover,
    .bg-primary_b:before,
    .bg-primary_a:after,
    .pagination_primary > .active > a,
    .pagination_primary > .active > span,
    .pagination_primary > .active > a,
    .pagination_primary > .active > span,
    .pagination_primary > li > a:hover,
    .pagination_primary > li > a:focus,
    .dropcap_primary:first-letter,
    .tooltip-1 .tooltip-inner,
    .btn-primary,
    .forms__label-check-1:after,
    .forms__label-radio-2:before,
    .panel-default > .panel-heading,
    .b-advantages-1 .b-advantages__icon:after,
    .b-team_bg-prim .b-team__inner,
    .b-team_bg-prim,
    .btn-default:hover,
    .pagination > li > a:hover,
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus,
    .fullmenu-close,
    .main-slider,
    .section-title-page {background-color: {$main_color};}


    .fullmenu-close {
        background-color: {$main_color} !important;
    }

    *::-moz-selection {background-color: {$main_color};}
    *::selection {background-color: {$main_color};}

    .border_prim,
    .border_prim_h:hover,
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination a:hover,
    .pagination span:hover,
    .pagination a:focus,
    .pagination span:focus,
    .progress_border_primary,
    .btn-primary,
    .forms__label-radio-2:before,
    .btn-theme_w-border,
    .btn-default:hover,
    .pagination > li > a:hover,
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {border-color: {$main_color};}

    .border-t_prim,
    .border-t_prim_h:hover,
    .tooltip-1.top .tooltip-arrow,
    .tooltip-1.top-left .tooltip-arrow,
    .tooltip-1.top-right .tooltip-arrow {border-top-color: {$main_color};}

    .border-r_prim,
    .border-r_prim_h:hover,
    .tooltip-1.right .tooltip-arrow {border-right-color: {$main_color};}

    .border-b_prim,
    .border-b_prim_h:hover,
    .tooltip-1.bottom .tooltip-arrow,
    .tooltip-1.bottom-left .tooltip-arrow,
    .tooltip-1.bottom-right .tooltip-arrow,
    .table_primary > thead > tr > th,
    .collapse.in {border-bottom-color: {$main_color};}

    .border-l_prim,
    .border-l_prim_h:hover,
    .tooltip-1.left .tooltip-arrow,
    .border-left_primary:before {border-left-color: {$main_color};}


    .text-second,
    .text-second_h:hover,
    .link-tooltip-2,
    .forms__label-check-2:after,
    .pagination_secondary > li:first-child > a:hover,
    .pagination_secondary > li:first-child > a:hover .icon,
    .pagination_secondary > li:last-child > a:hover,
    .pagination_secondary > li:last-child > a:hover .icon {color: {$second_color};}

    .bg-second,
    .bg-second_h:hover,
    .tooltip-2 .tooltip-inner,
    .dropcap_secondary:first-letter,
    .pagination_secondary > .active > a,
    .pagination_secondary > .active > span,
    .pagination_secondary > .active > a,
    .pagination_secondary > .active > span,
    .pagination_secondary > li > a:hover,
    .pagination_secondary > li > a:focus,
    .forms__label-radio-1:before {background-color: {$second_color};}

    .border_second,
    .border_second_h:hover,
    .progress_border_secondary,
    .pagination_secondary > .active > a,
    .pagination_secondary > .active > span,
    .pagination_secondary > .active > a,
    .pagination_secondary > .active > span,
    .pagination_secondary > li > a:hover,
    .pagination_secondary > li > a:focus,
    .forms__label-radio-1:before {border-color: {$second_color};}

    .border-t_second,
    .border-t_second_h:hover,
    .tooltip-2.top .tooltip-arrow,
    .tooltip-2.top-left .tooltip-arrow,
    .tooltip-2.top-right .tooltip-arrow {border-top-color: {$second_color};}

    .border-r_second,
    .border-r_second_h:hover,
    .tooltip-2.right .tooltip-arrow {border-right-color: {$second_color};}

    .border-l_second,
    .border-l_second_h:hover,
    .tooltip-2.left .tooltip-arrow {border-left-color: {$second_color};}

    .border-b_second,
    .border-b_second_h:hover,
    .tooltip-2.bottom .tooltip-arrow,
    .tooltip-2.bottom-left .tooltip-arrow,
    .tooltip-2.bottom-right .tooltip-arrow,
    .table_secondary > thead > tr > th {border-bottom-color: {$second_color};}

    .navbar .navbar-nav > li.active, 
    .navbar .navbar-nav > li:hover{ background-color: {$main_color}; }

   .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus{
        background-color: {$main_color}; 
        color: #000;
   }

  ";
  wp_add_inline_style( 'won_style', $custom_css );
    
}




/* Google Font */
function won_customize_google_fonts() {
    $fonts_url = '';

    $body_font = get_theme_mod('body_font', 'Work Sans');
    
    
    $body_font_c = _x( 'on', $body_font.': on or off', 'won');
    

 
    if ( 'off' !== $body_font_c || 'off' !== $heading_font_c ) {
        $font_families = array();
 
        if ( 'off' !== $body_font_c && strpos($body_font,'ovatheme_') === false ) {
            $font_families[] = $body_font.':100,200,300,400,500,600,700,800,900"';
        }
 
       

        if($font_families != null){
          $query_args = array(
              'family' => urlencode( implode( '|', $font_families ) ),
              'subset' => urlencode( 'latin,latin-ext' ),
          );  
          $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        
 
        
    }
 
    return esc_url_raw( $fonts_url );
}






/************************************************************************************************/
/************************************************************************************************/

function won_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}













