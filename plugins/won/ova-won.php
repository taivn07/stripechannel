<?php
/**
 
* Plugin Name: Ova won
 
* Plugin URI: ovathemes.com
 
* Description: A plugin to create custom post type,  shortcode...
 
* Version:  1.0
 
* Author: Ovatheme
 
* Author URI: ovathemes.com
 
* License:  GPL2
 
*/

include dirname( __FILE__ ) . '/custom-post-type/post-type.php';
include dirname( __FILE__ ) . '/shortcode/shortcode.php';
include dirname( __FILE__ ) . '/shortcode/vc-shortcode.php';


add_action('wp_enqueue_scripts', 'ova_won_plugin_styles', 1000);

function ova_won_plugin_styles(){
  wp_enqueue_style('ova_won_plugin', plugin_dir_url( __FILE__ ).'/ova-won.css', array(), null);  
}

function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);




add_action( 'widgets_init', 'ova_won_register_widgets_init' );
function ova_won_register_widgets_init() {
  
 

  $header_navibox = array(
    'name' => esc_html__( 'Header social', 'ova-won'),
    'id' => "header_navibox",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '',
    'after_title' => "",
  );
  register_sidebar( $header_navibox );


  

  $footer_left = array(
    'name' => esc_html__( 'Footer Left', 'ova-won'),
    'id' => "footer_left",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_left );

  $footer_right = array(
    'name' => esc_html__( 'Footer Right', 'ova-won'),
    'id' => "footer_right",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_right );


  
 

 }

// Search widget
class OVA_WON_SEARCH_WIDGET extends WP_Widget {

  
  /**
   * Register widget with WordPress.
   */
  function __construct() {
    

    parent::__construct(
      'OVA_WON_SEARCH', // Base ID
      esc_html__( 'Won Search', 'ova-won' ) // Name
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
    $val = $_GET['s'] ? $_GET['s'] : '';
    echo '<div class="widget widget-searce ova-widget-serach section-sidebar">
              <form class="form-sidebar" id="search-global-form" action="'.home_url('/').'">
                <input class="form-sidebar__input form-control" type="text" name="s" value="'.$val.'" placeholder="'.esc_html__( "search blog", "ova-won" ).'"/>
                <button class="form-sidebar__btn"><i class="icon fa fa-search"></i></button>
              </form>
            </div>';
    
    
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {

    $title = !empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Search', 'ova-won' );
    
    ?>

    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    


    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  

    return $instance;
  }

}

function register_ova_won_search() {
    register_widget( 'OVA_WON_SEARCH_WIDGET' );
}
add_action( 'widgets_init', 'register_ova_won_search' );



// Footer Left
class OVA_WON_FOOTER_LEFT_WIDGET extends WP_Widget {

  
  /**
   * Register widget with WordPress.
   */
  function __construct() {
    

    parent::__construct(
      'OVA_WON_FOOTER_LEFT', // Base ID
      esc_html__( 'Won Footer Left', 'ova-won' ) // Name
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    } ?>
    
    <?php if( $instance['img_logo'] != '' ){ ?>  
      <a class="footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img class="img-responsive" src="<?php echo esc_url( $instance['img_logo'] ) ?>" alt="<?php esc_html_e('Logo', 'ova-won'); ?>" />
      </a>
    <?php } ?>

    <?php if( $instance['copyright'] != '' ){ ?>  
      <div class="copyright"><?php echo $instance['copyright']; ?></div>
    <?php } ?>

    <?php if( $instance['newsletter'] != '' ){ ?>  
      <?php echo do_shortcode( $instance['newsletter'] ); ?>
    <?php } ?>
    
    
    
    <?php echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {

    $title = !empty( $instance['title'] ) ? $instance['title'] : '';
    $img_logo = !empty( $instance['img_logo'] ) ? $instance['img_logo'] : '';
    $copyright = !empty( $instance['copyright'] ) ? $instance['copyright'] : '';
    $newsletter = !empty( $instance['newsletter'] ) ? $instance['newsletter'] : '';
    
    ?>

    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'img_logo' ) ); ?>"><?php esc_attr_e( 'Logo Link:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_logo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_logo' ) ); ?>" type="text" value="<?php echo esc_attr( $img_logo ); ?>">
    <?php esc_html_e( "Go to Media >> Library >> Click to choose Logo image >> See URL at right sidebar" ) ?>
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'copyright' ) ); ?>"><?php esc_attr_e( 'Copyright text:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'copyright' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'copyright' ) ); ?>" type="text" value="<?php echo esc_attr( $copyright ); ?>">
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'newsletter' ) ); ?>"><?php esc_attr_e( 'newsletter shortcode:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newsletter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newsletter' ) ); ?>" type="text" value="<?php echo esc_attr( $newsletter ); ?>">
    <span><?php esc_html_e( "Find shortcode in: Mailchimp for WP >> Forms", 'ova-won' ); ?></span>
    </p>

    


    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['img_logo'] = ( ! empty( $new_instance['img_logo'] ) ) ? strip_tags( $new_instance['img_logo'] ) : '';
    $instance['copyright'] = ( ! empty( $new_instance['copyright'] ) ) ? strip_tags( $new_instance['copyright'] ) : '';
    $instance['newsletter'] = ( ! empty( $new_instance['newsletter'] ) ) ? strip_tags( $new_instance['newsletter'] ) : '';
  

    return $instance;
  }

}

function register_ova_won_footer_left() {
    register_widget( 'OVA_WON_FOOTER_LEFT_WIDGET' );
}
add_action( 'widgets_init', 'register_ova_won_footer_left' );



// Footer right
class OVA_WON_FOOTER_RIGHT_WIDGET extends WP_Widget {

  
  /**
   * Register widget with WordPress.
   */
  function __construct() {
    

    parent::__construct(
      'OVA_WON_FOOTER_RIGHT', // Base ID
      esc_html__( 'Won Footer Right', 'ova-won' ) // Name
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    } ?>

    <div class="footer-contacts">
        
        <?php if( $instance['phone'] != '' ){ ?>  
        <div class="footer-contacts__item footer-contacts__item_lg">
          <?php echo do_shortcode( $instance['phone'] ); ?>
        </div>
        <?php } ?>

        <?php if( $instance['contact'] != '' ){ ?> 
          <?php echo do_shortcode( $instance['contact'] ); ?>
        <?php } ?>

    </div>

    <?php if( $instance['social'] != '' ){ ?>  
      <div class="footer-social-net">
          <ul class="social-net list-inline">
            <?php echo do_shortcode( $instance['social'] ); ?>
          </ul>
      </div>
    <?php } ?>
    
    
    
    
    
    <?php echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {

    $title = !empty( $instance['title'] ) ? $instance['title'] : '';
    $phone = !empty( $instance['phone'] ) ? $instance['phone'] : '';
    $contact = !empty( $instance['contact'] ) ? $instance['contact'] : '';
    $social = !empty( $instance['social'] ) ? $instance['social'] : '';
    
    ?>

    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ova-won' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_attr_e( 'Phone:', 'ova-won' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
    <span><?php esc_html_e( 'Format Shortcode: [ova_won_footer_phone icon="ti-mobile" phone="+1 234 56700"]', 'ova-won' ); ?></span>
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'contact' ) ); ?>"><?php esc_attr_e( 'Contact text:', 'ova-won' ); ?></label> 
    <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact' ) ); ?>"><?php echo esc_attr( $contact ); ?></textarea>
    <span><?php esc_html_e( 'Format Shortcode: [ova_won_footer_contact title="{{E.}} info@woncreative.com"]', 'ova-won' ); ?></span>
    </p>

     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>"><?php esc_attr_e( 'Social shortcode:', 'ova-won' ); ?></label> 
    <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>"><?php echo esc_attr( $social ); ?></textarea>
     <span><?php esc_html_e( 'Format Shortcode: [ova_won_footer_social_item icon="fa-twitter" link="#" ]', 'ova-won' ); ?></span>
    </p>

    


    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
    $instance['contact'] = ( ! empty( $new_instance['contact'] ) ) ? strip_tags( $new_instance['contact'] ) : '';
    $instance['social'] = ( ! empty( $new_instance['social'] ) ) ? strip_tags( $new_instance['social'] ) : '';
    return $instance;
  }

}

function register_ova_won_footer_right() {
    register_widget( 'OVA_WON_FOOTER_RIGHT_WIDGET' );
}
add_action( 'widgets_init', 'register_ova_won_footer_right' );




/* Share */
if ( ! function_exists( 'won_share_social' ) ) {
add_filter( 'won_share_social', 'won_share_social', 0 );
function won_share_social(){ ?>
  <div class="entry-footer__group">
    <div class="entry-footer__title"><?php esc_html_e( 'Share', 'ova-won' ); ?></div>
    <ul class="social-net list-inline">

      <li class="social-net__item">
        <a class="social-net__link text-primary_h" href="https://twitter.com/share?url=<?php echo get_the_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;hashtags=simplesharebuttons"><i class="icon fa fa-twitter"></i></a></li>
      <li class="social-net__item"><a class="social-net__link text-primary_h" href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink(); ?>"><i class="icon fa fa-facebook"></i></a></li>
      <li class="social-net__item"><a class="social-net__link text-primary_h" href="http://www.tumblr.com/share/link?url=<?php echo get_the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>"><i class="icon fa fa-tumblr"></i></a></li>
      <li class="social-net__item"><a class="social-net__link text-primary_h" href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>"><i class="icon fa fa-google-plus"></i></a></li>
    </ul>
  </div>
<?php }
}

if ( ! function_exists( 'won_share_portoflio_social' ) ) {
add_filter( 'won_share_portoflio_social', 'won_share_portoflio_social', 1, 10 );
function won_share_portoflio_social($thumbnail){ ?>

  <ul class="social-net list-inline b-works-details__social">
      <li class="social-net__item"><a class="social-net__link" href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink(); ?>"><i class="icon fa fa-facebook"></i></a>
      </li>
      <li class="social-net__item"><a class="social-net__link" href="https://twitter.com/share?url=<?php echo get_the_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;hashtags=simplesharebuttons"><i class="icon fa fa-twitter"></i></a>
      </li>
      <li class="social-net__item"><a class="social-net__link" href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>"><i class="icon fa fa-google-plus"></i></a></li>
      
       <li class="social-net__item"><a class="social-net__link" href="http://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>&amp;media=<?php echo esc_url($thumbnail); ?>"><i class="icon fa fa-pinterest"></i></a></li>
  </ul>

<?php } }



return true;