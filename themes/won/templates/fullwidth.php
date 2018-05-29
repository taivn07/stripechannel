<?php /** Template Name: Full Width */
get_header(); 

 if ( have_posts() ) : while ( have_posts() ) : the_post(); 

    the_content();
    wp_link_pages();

endwhile;endif;
    
get_footer();