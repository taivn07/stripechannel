<?php
/* Slideshow Shortcode */
add_shortcode('ova_won_slideshow', 'ova_won_slideshow');
function ova_won_slideshow($atts, $content = null) {

    $atts = extract ( shortcode_atts(
    array(
      'class'       => '',
    ), $atts ) );

    $html = '<div class="l-design '.$class.'">
	            <div class="main-slider slider-pro" id="main-slider" data-slider-width="100%" data-slider-height="700px" data-slider-arrows="true" data-slider-buttons="true">
	                <div class="sp-slides">
	                    '.do_shortcode($content).'
	                </div>
	            </div>
	            <span class="num"></span>
        	</div>';
    return $html;

}

add_shortcode('ova_won_slideshow_item', 'ova_won_slideshow_item');
function ova_won_slideshow_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img'       => '',
      'title'       => '',
      'heading'       => '',
      'desc'       => '',
      'class'       => '',
    ), $atts) );

    
    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';

    $html .= '
            <div class="sp-slide '.$class.'">
            	<img class="sp-image" src="'.$img.'" alt="'.esc_html__('slider', 'ova-won').'" />
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="main-slider__inner">
                                <h2 class="main-slider__title sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="800" data-show-delay="400" data-hide-delay="400"><span class="main-slider__title-first">'.$title.'</span><strong class="main-slider__title-strong">'.$heading.'</strong></h2>
                                <div class="main-slider__info sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="1200" data-show-delay="2000" data-hide-delay="400">'.$desc.'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    return $html;

}



add_shortcode('ova_won_slideshow_two', 'ova_won_slideshow_two');
function ova_won_slideshow_two($atts, $content = null) {

    $atts = extract ( shortcode_atts(
    array(
      'class'       => '',
    ), $atts ) );

    $html = '<div class="main-slider main-slider_mod-a slider-pro '.$class.'" id="main-slider" data-slider-width="100%" data-slider-height="700px" data-slider-arrows="true" data-slider-buttons="true">
        <div class="sp-slides">
           '.do_shortcode($content).'
        </div>
      </div>';
    return $html;

}

add_shortcode('ova_won_slideshow_two_item', 'ova_won_slideshow_two_item');
function ova_won_slideshow_two_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img'       => '',
      'img_mobile' => '',
      'title'       => '',
      'heading'       => '',
      'desc'       => '',
      'class'       => '',
    ), $atts) );

    
    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';
    $img_mobile = wp_get_attachment_url( $img_mobile, 'full' ) ? wp_get_attachment_url( $img_mobile, 'full' ) : '';

    $html .= '<div class="sp-slide '.$class.'"><img class="sp-image visible-xs visible-sm" src="'.$img_mobile.'" alt="'.esc_html__('slider', 'ova-won').'"/>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="main-slider__inner">

                    <h2 class="main-slider__title sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="800" data-show-delay="400" data-hide-delay="400"><span class="main-slider__title-first">'.$title.'</span><strong class="main-slider__title-strong">'.$heading.'</strong>
                    </h2>

                    <div class="main-slider__info sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="1200" data-show-delay="2000" data-hide-delay="400">'.$desc.'</div>
                  </div>
                </div>
                <div class="col-md-6"><img class="hidden-sm hidden-xs ova-slideshow" src="'.$img.'" alt="'.esc_html__('slider', 'ova-won').'"/></div>
              </div>
            </div>
          </div>';
    return $html;

}


add_shortcode('ova_won_about', 'ova_won_about');
function ova_won_about($atts, $content = null) {

    $atts = extract ( shortcode_atts(
    array(
    	'heading_title' => '',
    	'heading_sub_title' => '',
    	'img' => '',
    	'img_popup' => '',
    	'title' => '',
    	'desc' => '',
    	'btn_text' => '',
    	'btn_link' => '',
    	'text_top' => '',
      'style' => 'style1',
      'class'       => '',
    ), $atts ) );

    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';
    $img_popup = wp_get_attachment_url( $img_popup, 'full' ) ? wp_get_attachment_url( $img_popup, 'full' ) : '';

    $title = $title ? str_replace( '}}', '</strong>', str_replace('{{', '<strong>', $title) ) : '';

    if( $style == 'style2' ){

      $html .= '<section class="section-default_pdg-btm section-border '.$class.'">';
                  

                  $html .= $text_top ? '<div class="row">
                    <div class="col-sm-6">
                      <div class="section__inner">
                        <div class="ui-vert-label ui-vert-label_right-minus ui-vert-label_letter-spac"><span class="ui-vert-label__inner">'.$text_top.'</span></div>
                      </div>
                    </div>
                  </div>' : '';

                  $html .= '<div class="row">
                    <div class="col-sm-5">';

                      $html .= $title ? '<h2 class="ui-title-block ui-title-block_semibold">'.$title.'</h2>' : '';

                      $html .= '<div>'.$desc.'</div>';

                      $html .= $btn_text ? '<a class="btn btn-theme btn-theme_mrg-top" href="'.$btn_link.'">'.$btn_text.'</a>' : '';

                    $html .= '</div>

                    <div class="col-sm-5 col-sm-offset-2">
                      <div class="section-type-5 scrollreveal">';

                        $html .= $heading_title ? '<div class="ui-subtitle-block-2">'.$heading_title.'</div>' : '';

                        $html .= $heading_sub_title ? '<h2 class="ui-title-block"><strong>'.$heading_sub_title.'</strong></h2>' : '';

                          $html .= '<a class="img-w-decor img-w-decor_l-minus-25 tilter tilter--1 js-zoom-images" href="'.$img_popup.'">
                                    <figure class="tilter__figure">
                                      <img class="img-responsive" src="'.$img.'" alt="'.esc_html($title).'">
                                    </figure>
                                  </a>';

                      $html .= '</div>
                    </div>

                  </div>
                </section>';
    }else{

    
      $html = '
  			<section class="section-default_pdg-btm section-border scrollreveal '.$class.'">
  			    <div class="section__inner">
  			        <div class="row">
  			            <div class="col-xs-12">';
  			                $html .= $heading_title ? '<div class="ui-subtitle-block-2">'.$heading_title.'</div>' : '';
  			                $html .= $heading_sub_title ? '<h2 class="ui-title-block"><strong>'.$heading_sub_title.'</strong></h2>' : '';
  			            $html .= '</div>
  			        </div>
  			        <div class="row">';
  			            $html .= $img ? '<div class="col-sm-4">
  			                <div class="col_minus-interval_right">
  			                    <a class="img-w-decor img-w-decor_l-minus-110 tilter tilter--1 js-zoom-images" href="'.$img_popup.'">
  			                        <figure class="tilter__figure"><img class="img-responsive" src="'.$img.'" alt="'.esc_html($title).'"></figure>
  			                    </a>
  			                </div>
  			            </div>' : '';
  			            $html .= '<div class="col-sm-6 col-sm-offset-1">
  			                <div class="col_minus-interval_left">';
  			                    $html .= $title ? '<h3 class="ui-title-block ui-title-block_sm ui-title-block_semibold">
  			                    '.$title.'</h3>' : '';
  			                   $html .= '<div>'.$desc.'</div>';

  			                    $html .= $btn_text ? '<a class="btn btn-theme btn-theme_mrg-top" href="'.$btn_link.'">'.$btn_text.'</a>' : '';
  			                $html .= '</div>
  			            </div>
  			        </div>';

  			        $html .= $text_top ? '<div class="ui-vert-label ui-vert-label_top-minus"><span class="ui-vert-label__inner">'.$text_top.'</span></div>' : '';

  			    $html .= '</div>
  			</section>';
    
    }

    return $html;

}


add_shortcode('ova_won_heading', 'ova_won_heading');
function ova_won_heading($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title'       => '',
      'desc'       => '',
      'style'	=> 'style1',
      'class'       => '',
    ), $atts) );

    $style = ( $style == 'style2' ) ? 'ui-title-block_w-arrows' : '';

    
   $desc = str_replace('}}', '</strong>', str_replace('{{', '<strong>', $desc ) );

    $html = '<div class="'.$class.'">';
    $html .= $title ? '<div class="ui-subtitle-block">'.$title.'</div>' : '';
	$html .= $desc ? '<h2 class="ui-title-block '.$style.'">'.$desc.'</h2>' : '';
	$html .= '</div>';
    return $html;

}

add_shortcode('ova_won_offer', 'ova_won_offer');
function ova_won_offer($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'auto_play'       => '4000',
      'navigation' => 'true',
      'class'       => '',
    ), $atts) );
   

    $html = '<div class="advantages-carousel owl-carousel owl-theme owl-theme_arrows-top enable-owl-carousel '.$class.' " data-min480="1" data-min768="2" data-min992="3" data-min1200="3" data-pagination="false" data-navigation="'.$navigation.'" data-auto-play="'.$auto_play.'" data-stop-on-hover="true">';
    $html .= do_shortcode( $content );
    $html .= '</div>';
    return $html;

}
add_shortcode('ova_won_offer_item', 'ova_won_offer_item');
function ova_won_offer_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon'       => '',
      'title' => '',
      'desc'       => '',
      'btn_text' => '',
      'btn_link' => '',
      'class'       => '',
    ), $atts) );
   

    $html = '<section class="b-advantages b-advantages-1 '.$class.'">';
    			$html .= $icon ? '<i class="b-advantages__icon '.$icon.'"></i>' : '';
		       	$html .= $title ? '<h3 class="b-advantages__title ui-title-inner">'.$title.'</h3>' : '';
		        $html .= $desc ? '<div class="b-advantages__info">'.$desc.'</div>' : '';
		        $html .= $btn_text ? '<a class="btn btn-theme btn-theme_mrg-top" href="'.$btn_link.'">'.$btn_text.'</a>' : '';
		    $html .= '</section>';
    
    return $html;

}

add_shortcode('ova_won_offer_two', 'ova_won_offer_two');
function ova_won_offer_two($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon'       => '',
      'title' => '',
      'desc'       => '',
      'style'   => 'style1',
      'link'  => '',
      'class'       => '',
    ), $atts) );

    if( $style == 'style2' ){
      $html = '<section class="b-advantages b-advantages-1 b-advantages-1_white wow  fadeIn '.$class.'" data-wow-duration="1s" data-wow-delay="0.2s">';
                 $html .= $icon ? '<i class="b-advantages__icon '.$icon.'"></i>' : '';

                 if( $link ){
                    $html .= $title ? '<h3 class="b-advantages__title ui-title-inner"><a href="'.$link.'">'.$title.'</a></h3>' : '';
                 }else{
                    $html .= $title ? '<h3 class="b-advantages__title ui-title-inner">'.$title.'</h3>' : '';
                 }
                 

                $html .= $desc ? '<div class="b-advantages__info">'.$desc.'</div>' : '';
              $html .= '</section>';
    }else{
      $html = '<section class="b-advantages b-advantages-2 wow  fadeIn '.$class.'" data-wow-duration="1s" data-wow-delay="0.2s">';
          $html .= $icon ? '<i class="b-advantages__icon '.$icon.'"></i>' : '';
            if( $link ){
                $html .= $title ? '<h3 class="b-advantages__title ui-title-inner"><a href="'.$link.'">'.$title.'</a></h3>' : '';
             }else{
                $html .= $title ? '<h3 class="b-advantages__title ui-title-inner">'.$title.'</h3>' : '';
             }
            $html .= $desc ? '<div class="b-advantages__info">'.$desc.'</div>' : '';
        $html .= '</section>';
    }
   
    

    return $html;

}


add_shortcode('ova_won_mobile', 'ova_won_mobile');
function ova_won_mobile($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'mobile'       => '',
      'icon'       => '',
      'class'       => '',
    ), $atts) );
    $html = '<section class="b-info-1 bg-primary b-info_w-decor scrollreveal '.$class.'">';
			    $html .= $title ? '<h3 class="b-info-1__title ui-title-block">'.$title.'</h3>' : '';
			    $html .= $mobile ? '<div class="b-info-1__text"><i class="icon '.$icon.'"></i>'.$mobile.'</div>' : '';
			$html .= '</section>';
    
    return $html;

}

add_shortcode('ova_won_info', 'ova_won_info');
function ova_won_info($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'desc'       => '',
      'btn_text'       => '',
      'btn_link' => '',
      'class'       => '',
    ), $atts) );

    
    $title = $title ? str_replace('}}', '</strong>', str_replace('{{', '<strong>', $title ) ) : '';

    $html = '<section class="b-info-2 bg-grey scrollreveal '.$class.'">';

			    $html .= $title ? '<h3 class="b-info-2__title ui-title-block">'.$title.'</h3>' : '';
			    $html .= $desc ? '<div class="b-info-2__text">'.$desc.'</div>' : '';

			    $html .= $btn_text ? '<a class="btn btn-theme btn-theme_mrg-top" href="'.$btn_link.'">'.$btn_text.'</a>' : '';

			$html .= '</section>';
    
    return $html;

}



add_shortcode('won_portfolio', 'won_portfolio');
function won_portfolio($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
        'array_slug'   => 'website, branding, ui-ux, motion-gfx',
        'count' => '9',
        'order' => 'ASC',
        'all_filter_text'  => 'All',
        'column'  => 'b-isotope-3 b-isotope_3-col',
        'style' => 'style1',
        'display_all_text'  => 'view all works',
        'display_all_link'  => '#',
        'show_info' => 'true',
        
        'class' => ''
    ), $atts) );

    $args = array(
      'type' => 'portfolio',
      'taxonomy' => 'categories'
    );
    $categories = get_categories( $args );
    $array_slug_new = explode( ',', str_replace( ' ', '',trim( $array_slug ) ) );

    

    $rand = time();
  
$html = '<div id="ova_portfolio_'.$rand.'_id" class="b-isotope '.$column.' '.$class.'">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-xs-12">';
                    if( $style == 'style1' ){
                  	 $html .= '<div class="b-isotope b-isotope b-isotope-1 b-isotope_3-col b-isotope_mrg-top_minus">';
                    }

                      if( $nav_boxed == 'yes' ){
                        $html .= '<div class="container">';
                      }

                      $html .= '<ul class="b-isotope-filter list-inline">';

                      $html .= $all_filter_text ? '<li class="current"><a href=""  data-filter=".all">'.$all_filter_text.'</a></li>' : '';

                          for($i=0; $i<count($array_slug_new); $i++){
                              foreach ($categories as $key => $cat) {
                                if($array_slug_new[$i] == $cat->slug){
                                  
                                  $html .= '<li><a href="" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                                }
                              }
                          };
                      $html .= '</ul>';

                      if( $nav_boxed == 'yes' ){
                        $html .= '</div>';
                      }

                      $html .= '<ul class="b-isotope-grid grid list-unstyled">
                          <li class="grid-sizer"></li>';

                          

                          for($k=0; $k<count($array_slug_new); $k++){

                            $args_portfolio = array(
                              'post_type' => 'portfolio',
                              'posts_per_page' => $count,
                              'orderby'=> 'meta_value_num',
                              'meta_key'  => 'won_met_portfolio_order',
                              'post_status' => array('publish'),
                              'order'=> $order,
                              'paged' => 1,
                              'tax_query' => array(
                                array(
                                  'taxonomy' => 'categories',
                                  'field'    => 'slug',
                                  'terms'    => $array_slug_new[$k],
                                ),        
                              ),
                            );

                            $portfolios = new WP_Query( $args_portfolio );

                          if ( $portfolios->have_posts() ) : while ( $portfolios->have_posts() ) : $portfolios->the_post();

                          $terms  = get_the_terms(get_the_id(),'categories');
                          if ( $terms && ! is_wp_error( $terms ) ) : 
                              $cat_slug = '';
                            $d = 1;
                              foreach ( $terms as $term ) {
                                $cat_slug .= $term->slug;
                                if( count($terms) > 1 && $d < count($terms) ){
                                  $cat_slug .= ' ';
                                }
                                $d++;
                              }
                          endif;

                          $full_thumbnail = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ), 'full') ? wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ), 'full') : '';
                          
                          $sub_title = get_post_meta( get_the_id(), 'won_met_portfolio_sub_title', 'true' ) ? get_post_meta( get_the_id(), 'won_met_portfolio_sub_title', 'true' ) : '';

                          

                            $html .= '<li class="b-isotope-grid__item grid-item all '.$show_info.' '.$cat_slug.'">

                                      <a class="b-isotope-grid__inner" href="'.get_the_permalink().'">

                                        <img src="'.$full_thumbnail.'" alt="'.get_the_title().'"/>

                                        <span class="b-isotope-grid__wrap-info">
                                          <i class="icon ti-arrow-top-right"></i>
                                        </span>

                                      </a>';

                                      if( $show_info == 'true' ){

                                        $html .= '<a href="'.get_the_permalink().'"><span class="b-isotope-grid__title">'.get_the_title().'</span></a>';
                                        $html .= '<span class="b-isotope-grid__categorie">'.$sub_title.'</span>';
                                      }
                                     
                                  $html .= '</li>';
                          
                          
                          endwhile; endif; 
                          wp_reset_postdata();
                      }
                          
                      $html .= '</ul>';


                      $html .= $display_all_text ? '<div class="text-center"><a class="btn btn-theme" href="'.$display_all_link.'">'.$display_all_text.'</a></div>': '';

                  if( $style == 'style1' ){
                    $html .= '</div>';
                  }

                  $html .= '</div>
              </div>
          </div>
      </div>';

          
    
    return $html;

}




add_shortcode('ova_won_review', 'ova_won_review');
function ova_won_review($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'auto_play' => '4000',
      'slide' => '2',
      'navigation' => 'true',
      'title' => '',
      'class'       => '',
    ), $atts) );

    $html = '<section class="section-reviews"><div class="'.$class.'">';
    		
    		$html .= $title ? '<i class="section-reviews__icon ti-star"></i><h2 class="section-reviews__title">'.$title.'</h2>' : '';

			$html .= '<div class="reviews-carousel owl-carousel owl-theme owl-theme_arrows-middle enable-owl-carousel" data-min480="1" data-min768="1" data-min992="'.$slide.'" data-min1200="'.$slide.'" data-pagination="false" data-navigation="'.$navigation.'" data-auto-play="'.$auto_play.'" data-stop-on-hover="true">';

			$html .= do_shortcode( $content );

	$html .= '</div></div></section>';
    
    return $html;

}


add_shortcode('ova_won_review_item', 'ova_won_review_item');
function ova_won_review_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'name' => '',
      'job'       => '',
      'desc'       => '',
      'class'       => '',
    ), $atts) );

    $html = '<div class="b-blockquote b-blockquote-1 '.$class.'">
		        <blockquote>';
		            $html .= $desc ? '<p>'.$desc.'</p>' : '';
		            $html .= '<cite class="b-blockquote__cite" title="'.$name.'">';
		            	$html .= $name ? '<span class="b-blockquote__author">'.$name.'</span>' : '';
		            	$html .= $job ? '<span class="b-blockquote__category">'.$job.'</span>' : '';
		            $html .= '</cite>
		        </blockquote>
		    </div>';
    
    return $html;

}


add_shortcode('ova_won_team', 'ova_won_team');
function ova_won_team($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'auto_play' => '4000',
      'slide' => '4',
      'navigation' => 'true',
      'class'       => '',
    ), $atts) );

    $html = ' <div class="owl-carousel owl-theme owl-theme_items_mrg-30 enable-owl-carousel '.$class.'" data-min480="1" data-min768="3" data-min992="'.$slide.'" data-min1200="'.$slide.'" data-pagination="false" data-navigation="'.$navigation.'" data-auto-play="'.$auto_play.'" data-stop-on-hover="true">'.do_shortcode($content).'</div>';
    
    return $html;

}

add_shortcode('ova_won_team_item', 'ova_won_team_item');
function ova_won_team_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'job' => '',
      'img'	=> '',
      'link' => '',
    ), $atts) );

    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';

    $html = '<section class="b-team">';

                $html .= $img ? '<div class="b-team__media">
            		                	<img class="img-responsive" src="'.$img.'" alt="'.$title.'" />
            		                </div>' : '';

                $html .= '<div class="b-team__inner">';
                
                    if( $link != '' ){
                    	$html .= $title ? '<h3 class="b-team__name"><a href="'.$link.'">'.$title.'</a></h3>' : '';
                    }else{
                    	$html .= $title ? '<h3 class="b-team__name">'.$title.'</h3>' : '';
                    }
                    
                    
                    $html .= $job ? '<div class="b-team__category">'.$job.'</div>' : '';
                    
                    $html .= $content ? '<ul class="social-net list-inline">'.do_shortcode( $content ).'</ul>' : '';

                $html .= '</div>
            </section>';
    
    return $html;

}



add_shortcode('ova_won_team_item_social', 'ova_won_team_item_social');
function ova_won_team_item_social($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon' => '',
      'link' => ''
    ), $atts) );

    $html = '<li class="social-net__item">
        			<a class="social-net__link text-primary_h" target="_blank" href="'.$link.'">
        				<i class="icon fa '.$icon.'"></i>
        			</a>
        		</li>';
    
    return $html;

}

add_shortcode('ova_won_footer_social_item', 'ova_won_footer_social_item');
function ova_won_footer_social_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon' => '',
      'link' => ''
    ), $atts) );

    $html = '<li class="social-net__item">
              <a class="social-net__link text-primary_h" target="_blank" href="'.$link.'">
                <i class="icon fa '.$icon.'"></i>
              </a>
            </li>';
    
    return $html;

} 

add_shortcode('ova_won_footer_phone', 'ova_won_footer_phone');
function ova_won_footer_phone($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon' => '',
      'phone' => ''
    ), $atts) );

    $html = $phone.'<i class="icon '.$icon.'"></i>';
    
    return $html;

}

add_shortcode('ova_won_footer_contact', 'ova_won_footer_contact');
function ova_won_footer_contact($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => ''
    ), $atts) );

    $title = $title ? str_replace('}}', '</span>', str_replace('{{', '<span class="footer-contacts__title">', $title ) ) : '';

    $html = '<div class="footer-contacts__item ">
              '.$title.'
            </div>';
    
    return $html;

}    





add_shortcode('ova_won_progress', 'ova_won_progress');
function ova_won_progress($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'class'       => '',
    ), $atts) );

    $html = '<div class="section-progress section-border '.$class.'">
            <ul class="b-progress-list list-unstyled">'.do_shortcode($content).'</ul></div>';
    
    return $html;

}

add_shortcode('ova_won_progress_item', 'ova_won_progress_item');
function ova_won_progress_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'percent' => ''
    ), $atts) );

    $html = '<li class="b-progress-list__item clearfix wow  fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
	    		<span class="b-progress-list__percent js-chart" data-percent="'.$percent.'">
	    		<span class="js-percent"></span></span>
	    		<span class="b-progress-list__name">'.$title.'</span>
			</li>';
    
    return $html;

}



add_shortcode('ova_won_blog', 'ova_won_blog');
function ova_won_blog($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
        'category'=>'',
        'total_count'=>'20',
        'read_more_text'  => 'Read more',
        'show_read_more'  => 'true',
        'show_intro'  => 'true',
        'show_time'  => 'true',
        'show_cat'  => 'true',
        'class' => ''
    ), $atts) );
   

    $args =array();
    if ($category=='all') {
      $args=array('post_type' => 'post', 'posts_per_page' => $total_count);
    }else{
      $args=array('post_type' => 'post', 'category_name'=>$category,'posts_per_page' => $total_count);
    }
   
    $blog = new WP_Query($args);
    
    ob_start(); ?>
      <?php while($blog->have_posts()) : $blog->the_post(); ?>

      		<div class="col-md-6">
                <section class="b-post b-post-1 clearfix <?php echo esc_attr($class); ?>">
                    <div class="entry-inner">

                    	<?php if( $show_time == 'true' ){ ?>
	                        <div class="entry-date">
	                        	<span class="entry-date__number"><?php the_time('d') ?></span>
	                        	<span class="entry-date__month"><?php the_time('M') ?></span>
	                        </div>
                        <?php } ?>

                        <div class="entry-main">
                            <div class="entry-header">

                            	<?php if( $show_cat == 'true' ){ ?>
	                            	<div class="entry-meta">
		                            	<?php $categories = get_the_category();
											$separator = ' ';
											$output = '';
											if ( ! empty( $categories ) ) {
											    foreach( $categories as $category ) { ?>
											       
											        <span class="entry-meta__item">
									            		<a class="entry-meta__link text-primary" href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>">
									            			<strong><?php echo esc_html( $category->name ); ?></strong>
									            		</a>
									            	</span>

											    <?php }
										    
										} ?>
	                                </div>
                                <?php } ?>

                                <h2 class="entry-title ui-title-inner">
                                	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                            </div>
                            <?php if( $show_intro == 'true' ){ ?>
	                            <div class="entry-content">
	                               <?php the_excerpt(); ?>
	                            </div>
                            <?php } ?>

                            <?php if( $show_read_more == 'true' ){ ?>
	                            <div class="entry-footer">
	                            	<a class="btn btn-theme btn-theme_mrg-top" href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more_text ); ?></a>
	                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </section>
                <!-- end .post-->
            </div>	

      
          
    
    <?php
      endwhile;
       wp_reset_postdata();
        return ob_get_clean();
    }


add_shortcode('ova_won_brands', 'ova_won_brands');
function ova_won_brands($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'auto_play' => '4000',
      'slide' => '5',
      'bg' => 'bg-primary',
      'class'       => '',
    ), $atts) );

    $html = '<div class="section-brands '.$bg.' '.$class.'">
    			<div class="b-brands owl-carousel owl-theme enable-owl-carousel" data-min480="1" data-min768="3" data-min992="'.$slide.'" data-min1200="'.$slide.'" data-pagination="false" data-navigation="false" data-auto-play="'.$auto_play.'" data-stop-on-hover="true">'.do_shortcode($content).'</div></div>';
    
    return $html;

}

add_shortcode('ova_won_brands_item', 'ova_won_brands_item');
function ova_won_brands_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img' => '',
      'alt' => '',
      'link' => ''
    ), $atts) );

    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';

    if( $link != '' ){
    	$html = '<div class="b-brands__item"><a href="'.$link.'" target="_blank">
    			<img class="img-responsive center-block" src="'.$img.'" alt="'.$alt.'" />
    			</a>
    		</div>';
    }else{
    	$html = '<div class="b-brands__item">
    			<img class="img-responsive center-block" src="'.$img.'" alt="'.$alt.'" />
    		</div>';
    }
    
    
    return $html;

}


add_shortcode('ova_won_pricing', 'ova_won_pricing');
function ova_won_pricing($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'price' => '',
      'time' => '',
      'desc' => '',
      'btn_text' => '',
      'btn_link' => '',
      'feature' => '',
      'btn_target' => '_self',
      'class' => '',
    ), $atts) );

    $desc = $desc ? str_replace('}}', '</li>', str_replace('{{', '<li>', $desc ) ) : '';

    $html = '<section class="b-pricing wow  fadeIn '.$feature.' '.$class.'" data-wow-duration="1s" data-wow-delay="0.4s">';

              $html .= $title ? '<h3 class="b-pricing__title">'.$title.'</h3>' : '';

              $html .= '<div class="b-pricing-price">';
                $html .= $price ? '<span class="b-pricing-price__number">'.$price.'</span>' : '';
                $html .= $time ? '<span class="b-pricing-price__title">'.$time.'</span>' : '';
              $html .= '</div>';

              $html .= $desc ? '<ul class="b-pricing__description list-unstyled">'.$desc.'</ul>' : '';

              $html .= $btn_text ? '<a class="b-pricing__btn btn btn-theme" target="'.$btn_target.'" href="'.$btn_link.'">'.$btn_text.'</a>' : '';

            $html .= '</section>';
    
    
    return $html;

}



add_shortcode('ova_won_skill', 'ova_won_skill');
function ova_won_skill($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img' => '',
      'title' => '',
      'desc' => '',
      'class' => '',
    ), $atts) );

    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';
    $title = $title ? str_replace('}}', '</strong>', str_replace('{{', '<strong>', $title ) ) : '';

   $html = '<div class="section-area l-design ova-skill '.$class.'">
            <div class="block-table block-table_md">';

              $html .= $img ? '<div class="col-md-6 block-table__cell block-table__decor hidden-sm">
                <div class="block-table__inner"><img src="'.$img.'" alt="foto"></div>
              </div>' : '';

              $html .= '<div class="col-md-6 block-table__cell">
                <div class="block-table__inner">
                  <section class="b-info-3 bg-grey">';
                    
                    $html .= $title ? '<h3 class="b-info-3__title ui-title-block">'.$title.'</h3>' : '';

                    $html .= $desc ? '<div class="b-info-3__text">'.$desc.'</div>' : '';

                    $html .= $content ? '<div class="b-chart">'.do_shortcode($content).'</div>' : '';

                  $html .= '</section>
                  
                </div>
              </div>
            </div>
          </div>';
    
    return $html;

}


add_shortcode('ova_won_skill_item', 'ova_won_skill_item');
function ova_won_skill_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img' => '',
      'title' => '',
    ), $atts) );

    $html = '<div class="b-chart__item">
              <div class="b-chart__inner">
                <img class="b-chart__img" src="'.$img.'" alt="'.$title.'"/>
                <div class="b-chart__name">'.$title.'</div>
              </div>
            </div>';
    
    
    return $html;

}


add_shortcode('ova_won_parllax_info', 'ova_won_parllax_info');
function ova_won_parllax_info($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'img' => '',
      'title' => '',
      'desc' => '',
      'btn_text' => '',
      'btn_link' => '',
      'btn_target' => '_self',
      'class' => '',
    ), $atts) );


    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';

    $html = '<section class="b-info-4 area-bg area-bg_dark area-bg_op_90 parallax '.$class.'" style="background-image: url('.$img .')">
            <div class="area-bg__inner">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 scrollreveal">';

                    $html .= $title ? '<h3 class="b-info-4__title ui-title-block">'.$title.'</h3>' : '';

                    $html .= $desc ? '<div class="b-info-4__text">'.$desc.'</div>' : '';

                    $html .= $btn_text ? '<a class="btn btn-theme btn-theme_both-decor" target="'.$btn_target.'" href="'.$btn_link.'">'.$btn_text.'</a>' : '';

                  $html .= '</div>
                </div>
              </div>
            </div>
          </section>';
    
    
    return $html;

}


add_shortcode('ova_won_contact_info', 'ova_won_contact_info');
function ova_won_contact_info($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'icon' => '',
      'name' => '',
      'phone' => '',
      'fax' => '',
      'class' => '',
    ), $atts) );


    

    $html = '<div class="b-contacts__item bg-grey '.$class.'">';
              $html .= $icon ? '<i class="b-contacts__icon '.$icon.' bg-primary_a"></i>' : '';
              $html .= $name ? '<div class="b-contacts__name">'.$name.'</div>' : '';
              $html .= $phone ? '<div class="b-contacts__info">'.$phone.'</div>' : '';
              $html .= $fax ? '<div class="b-contacts__info">'.$fax.'</div>' : '';
            $html .= '</div>';
    
    
    return $html;

}

add_shortcode('ova_won_header_social', 'ova_won_header_social');
function ova_won_header_social($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'class' => '',
    ), $atts) );

    $html = '<ul class="social-nav nav navbar-nav hidden-xs clearfix vcenter '.$class.'">'.do_shortcode($content).'</ul>';

    return $html;

}

add_shortcode('ova_won_header_social_item', 'ova_won_header_social_item');
function ova_won_header_social_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'link' => '',
      'icon' => ''
    ), $atts) );

    $html = '<li><a href="'.$link.'" target="_blank"><i class="fa '.$icon.'"></i></a></li>';
    
    return $html;

}






       

?>