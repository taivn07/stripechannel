<?php get_header();
					
if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content/content', 'page' );
    if ( comments_open() ) comments_template( '', true );
endwhile; else : ?>
        <p><?php esc_html_e('Sorry, no pages matched your criteria.', 'won'); ?></p>
<?php endif;


get_footer(); ?>




