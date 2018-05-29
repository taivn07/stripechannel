<?php

// Get all file name in header
if( !function_exists( 'won_load_header' )):
function won_load_header(){
	$files = array(
        'default' => esc_html__("default","won"), 
        'version1' => esc_html__("version1","won") 
    );
	return $files;
}
endif;

// Set header in metabox default
if( !function_exists( 'won_load_header_metabox' )):
function won_load_header_metabox(){
    $files = array(
        'global' => esc_html__("Global in Customizer","won") ,
        'default' => esc_html__("default","won" ),
        'version1' => esc_html__("version1","won") 
    );
    return $files;
}
endif;




// Get all file name in footer
if( !function_exists( 'won_load_footer' )):
function won_load_footer(){
	$files = array(
        'default' => esc_html__("default","won"),
        'version1' => esc_html__("version1", "won") 
    );
	return $files;
}
endif;

// Set footer in metabox default
if( !function_exists( 'won_load_footer_metabox' )):
function won_load_footer_metabox(){
    $files = array(
        'global' => esc_html__("Global in Customizer","won"),
        'default' => esc_html__("default","won"),
        'version1' => esc_html__("version1","won") 
    );
    return $files;
}
endif;



/********************************************************************/
/********************************************************************/
// Get current header
if( !function_exists( 'won_get_current_header' )):
function won_get_current_header(){
	// Get header default from customizer
	$customizer_header = get_theme_mod('header_version','default');
	// Get header from Post / Page setting
	$current_id = won_get_current_id();
  	$header = ( $current_id != '' && get_post_meta($current_id,'won_met_header_version', 'true') != 'global' && get_post_meta($current_id,'won_met_header_version', 'true') != '' ) ? get_post_meta($current_id,'won_met_header_version', 'true') : $customizer_header;
	return $header;
}
endif;

// Get current footer
if( !function_exists( 'won_get_current_footer' )):
function won_get_current_footer(){
	// Get header default from customizer
	$customizer_footer = get_theme_mod('footer_version','default');
	// Get footer from Post / Page setting
	$current_id = won_get_current_id();
  	$footer = ( $current_id != '' && get_post_meta($current_id,'won_met_footer_version', 'true') != 'global'  && get_post_meta($current_id,'won_met_footer_version', 'true') != '' ) ? get_post_meta($current_id,'won_met_footer_version', 'true') : $customizer_footer;
	
    return $footer;
}
endif;


// Get current main layout
if( !function_exists( 'won_get_current_main_layout' )):
function won_get_current_main_layout(){
    // Get header default from customizer
    $customizer_main_layout = get_theme_mod('main_layout','right_sidebar');
    // Get mainlayout from Post / Page setting
    $current_id = won_get_current_id();
    $mainlayout = ( $current_id != '' && get_post_meta($current_id,'won_met_main_layout', 'true') != 'global' && get_post_meta($current_id,'won_met_main_layout', 'true') != '' ) ? get_post_meta($current_id,'won_met_main_layout', 'true') : $customizer_main_layout;

    return $mainlayout;
}
endif;

// Get current width site
if( !function_exists( 'won_get_current_width_site' )):
function won_get_current_width_site(){
    // Get header default from customizer
    $customizer_width_site = get_theme_mod('width_site','wide');
    // Get mainlayout from Post / Page setting
    $current_id = won_get_current_id();
    $width_site = ( $current_id != '' && get_post_meta($current_id,'won_met_width_site', 'true') != 'global' && get_post_meta($current_id,'won_met_width_site', 'true') != '' ) ? get_post_meta($current_id,'won_met_width_site', 'true') : $customizer_width_site;
    return $width_site;
}
endif;

// Get current ID of post/page, etc
if( !function_exists( 'won_get_current_id' )):
function won_get_current_id(){
	global $post, $wp_query;
    $current_page_id = '';
    // Get The Page ID You Need
    if(class_exists("woocommerce")) {
        if( is_shop() ){ 
            $current_page_id  =  get_option ( 'woocommerce_shop_page_id' );
        }elseif(is_cart()) {
            $current_page_id  =  get_option ( 'woocommerce_cart_page_id' );
        }elseif(is_checkout()){
            $current_page_id  =  get_option ( 'woocommerce_checkout_page_id' );
        }elseif(is_account_page()){
            $current_page_id  =  get_option ( 'woocommerce_myaccount_page_id' );
        }elseif(is_view_order_page()){
            $current_page_id  = get_option ( 'woocommerce_view_order_page_id' );
        }
    }
    if($current_page_id=='') {
        if ( is_home () && is_front_page () ) {
            $current_page_id = '';
        } elseif ( is_home () ) {
            $current_page_id = get_option ( 'page_for_posts' );
        } elseif ( is_search () || is_category () || is_tag () || is_tax () || is_archive() ) {
            $current_page_id = '';
        } elseif ( !is_404 () ) {
           $current_page_id = $post->ID;
        } 
    }

    return $current_page_id;
}
endif;




// Get width sidebar
if( !function_exists( 'won_width_sidebar' )):
function won_width_sidebar(){
    $main_layout = won_get_current_main_layout();
    $sidebar_column = get_theme_mod('sidebar_column','4');
    
    $col_width_sidebar = '';

    if($main_layout == 'left_sidebar'){
        switch ($sidebar_column) {

            case 1:
                $col_width_sidebar = 'col-md-1 col-md-pull-11';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2 col-md-pull-10';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3 col-md-pull-9';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5 col-md-pull-7';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6 col-md-pull-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
        }


    }else if($main_layout == 'right_sidebar'){

        switch ($sidebar_column) {
            case 1:
                $col_width_sidebar = 'col-md-1';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4';
                break;
        }

    }else if($main_layout == 'no_sidebar' || $main_layout == 'full_width'){

        $col_width_sidebar = '';

    }
    
    return $col_width_sidebar;
}
endif;

// Get main sidebar
if( !function_exists( 'won_width_main_content' )):
function won_width_main_content(){
    $main_layout = won_get_current_main_layout();
    $main_column = get_theme_mod('main_column','8');

    $col_width_main = '';

    if($main_layout == 'left_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6 col-md-push-6';
                break;
            case 7:
                $col_width_main = 'col-md-7 col-md-push-5';
                break;
            case 8:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
            case 9:
                $col_width_main = 'col-md-9 col-md-push-3';
                break;
            case 10:
                $col_width_main = 'col-md-10 col-md-push-2';
                break;
            case 11:
                $col_width_main = 'col-md-11 col-md-push-1';    
                break;
            default:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
        }

    }else if($main_layout == 'right_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6';
                break;
            case 7:
                $col_width_main = 'col-md-7';
                break;
            case 8:
                $col_width_main = 'col-md-8';
                break;
            case 9:
                $col_width_main = 'col-md-9';
                break;
            case 10:
                $col_width_main = 'col-md-10';
                break;
            case 11:
                $col_width_main = 'col-md-11';    
                break;
            default:
                $col_width_main = 'col-md-8';
                break;
        }

    }else if($main_layout == 'no_sidebar'){

        $col_width_main = 'col-md-12';

    }else if($main_layout == 'full_width'){

        $col_width_main = '';

    }

    return $col_width_main;

}
endif;



// Get Woo width sidebar
if( !function_exists( 'won_woo_width_sidebar' )):
function won_woo_width_sidebar(){
    $main_layout = get_theme_mod('woo_layout','no_sidebar');
    $sidebar_column = get_theme_mod('woo_sidebar_column','4');
    
    $col_width_sidebar = '';

    if($main_layout == 'left_sidebar'){
        switch ($sidebar_column) {

            case 1:
                $col_width_sidebar = 'col-md-1 col-md-pull-11';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2 col-md-pull-10';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3 col-md-pull-9';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5 col-md-pull-7';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6 col-md-pull-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4 col-md-pull-8';
                break;
        }


    }else if($main_layout == 'right_sidebar'){

        switch ($sidebar_column) {
            case 1:
                $col_width_sidebar = 'col-md-1';
                break;
            case 2:
                $col_width_sidebar = 'col-md-2';
                break;
            case 3:
                $col_width_sidebar = 'col-md-3';
                break;
            case 4:
                $col_width_sidebar = 'col-md-4';
                break;
            case 5:
                $col_width_sidebar = 'col-md-5';
                break;
            case 6:
                $col_width_sidebar = 'col-md-6';
                break;
            default:
                $col_width_sidebar = 'col-md-4';
                break;
        }

    }else if($main_layout == 'no_sidebar' || $main_layout == 'full_width'){

        $col_width_sidebar = '';

    }
    
    return $col_width_sidebar;
}
endif;

// Get woo main sidebar
if( !function_exists( 'won_woo_width_main_content' )):
function won_woo_width_main_content(){
    $main_layout = get_theme_mod('woo_layout','no_sidebar');
    $main_column = get_theme_mod('woo_main_column','8');

    $col_width_main = '';

    if($main_layout == 'left_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6 col-md-push-6';
                break;
            case 7:
                $col_width_main = 'col-md-7 col-md-push-5';
                break;
            case 8:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
            case 9:
                $col_width_main = 'col-md-9 col-md-push-3';
                break;
            case 10:
                $col_width_main = 'col-md-10 col-md-push-2';
                break;
            case 11:
                $col_width_main = 'col-md-11 col-md-push-1';    
                break;
            default:
                $col_width_main = 'col-md-8 col-md-push-4';
                break;
        }

    }else if($main_layout == 'right_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-md-6';
                break;
            case 7:
                $col_width_main = 'col-md-7';
                break;
            case 8:
                $col_width_main = 'col-md-8';
                break;
            case 9:
                $col_width_main = 'col-md-9';
                break;
            case 10:
                $col_width_main = 'col-md-10';
                break;
            case 11:
                $col_width_main = 'col-md-11';    
                break;
            default:
                $col_width_main = 'col-md-8';
                break;
        }

    }else if($main_layout == 'no_sidebar'){

        $col_width_main = 'col-md-12';

    }else if($main_layout == 'full_width'){

        $col_width_main = '';

    }

    return $col_width_main;

}
endif;

if( !function_exists( 'won_pagination_theme' )):
function won_pagination_theme() {
           
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo wp_kses( __( '<div class="blog_pagination"><ul class="pagination">','won' ), true ) . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-chevron-left"></i>') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'won' ) , true);
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'won' ) , true) . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link('<i class="fa fa-chevron-right"></i>') );
 
    echo wp_kses( __( '</ul></div>', 'won' ), true ) . "\n";
 
}
endif;



/* Setup Theme */
/* Add theme support */
add_action('after_setup_theme', 'won_theme_support', 10);
add_filter('oembed_result', 'won_framework_fix_oembeb', 10 );
add_filter('paginate_links', 'won_fix_pagination_error',10);
add_action( 'admin_enqueue_scripts', 'won_wpadminjs' ); 

function won_theme_support(){

    if ( ! isset( $content_width ) ) $content_width = 900;

    add_theme_support('title-tag');

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments    
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    /* See http://codex.wordpress.org/Post_Formats */
    add_theme_support( 'post-formats', array( 'image', 'gallery', 'audio', 'video') );

    add_theme_support( 'post-thumbnails' );
    
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background');

    
    
}



function won_framework_fix_oembeb( $url ){
    $array = array (
        'webkitallowfullscreen'     => '',
        'mozallowfullscreen'        => '',
        'frameborder="0"'           => '',
        '</iframe>)'        => '</iframe>'
    );
    $url = strtr( $url, $array );

    if ( strpos( $url, "<embed src=" ) !== false ){
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
    }
    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
        return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque', $url );
    }
    else{
        return $url;
    }
}


// Fix pagination
function won_fix_pagination_error($link) {
    return str_replace('#038;', '&', $link);
}

function won_wpadminjs() {
    wp_enqueue_script( 'won_wpadminjs', OVATHEME_URI.'/extend/wpadmin.js', array('jquery'),false,true );
    wp_enqueue_style('won_fixcssadmin', OVATHEME_URI.'/extend/cssadmin.css',  false, '1.0');
}


add_action( 'init', 'won_vc_add_param' );
function won_vc_add_param(){
    /* Visual Composer */
    if(function_exists('vc_add_param')){

      /* Customize Row element */   
      $vc_row_attributes = array(
        
        array("type" => "dropdown",
            "heading" => esc_html__('Make container if the current page use fullwidth template', 'won'),
            "param_name" => "ova_container",
            "value" => array(
                    esc_html__('Yes', 'won') => 'yes',      
                    esc_html__('No', 'won') => 'no'
            ),
            'default' => 'yes'
        )
      );
      vc_add_params( 'vc_row', $vc_row_attributes );
      /* /Customize Row element */
    }
}


function won_wpdocs_theme_add_editor_styles() {
    add_editor_style( OVATHEME_URI.'/assets/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'won_wpdocs_theme_add_editor_styles' );

