<?php
/* Register Menu */
add_action( 'init', 'won_register_menus' );
function won_register_menus() {
  register_nav_menus( array(
    'primary'   => esc_html__( 'Primary Menu', 'won' )

  ) );
}





/* Register Widget */
add_action( 'widgets_init', 'won_second_widgets_init' );
function won_second_widgets_init() {
  
  $args_blog = array(
    'name' => esc_html__( 'Main Sidebar', 'won'),
    'id' => "main-sidebar",
    'description' => esc_html__( 'Main Sidebar', 'won' ),
    'class' => '',
    'before_widget' => '<section id="%1$s" class="widget section-sidebar %2$s">',
    'after_widget' => "</section>",
    'before_title' => '<h3 class="widget-title ui-title-type-1">',
    'after_title' => "</h3>",
  );
  register_sidebar( $args_blog );

  

  

}

