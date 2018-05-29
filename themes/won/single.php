<?php get_header();

// Get content
if ( have_posts() ) : while ( have_posts() ) : the_post();

	get_template_part( 'content/content', 'post-single' );

    if ( comments_open() || get_comments_number() ) {
    	comments_template();
    }
	
endwhile; else :
    get_template_part( 'content/content', 'none' );
endif;

get_footer(); ?>
