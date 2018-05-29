<?php get_header(); ?>

					
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php if( get_theme_mod( 'blog_version', 'basic' ) == 'basic' ){ ?>

			<?php get_template_part( 'content/content', 'post-basic' ); ?>

		<?php }elseif( get_theme_mod( 'blog_version', 'basic' ) == 'version1' ){ ?>

			<?php get_template_part( 'content/content', 'post' ); ?>

		<?php } ?>
		
<?php endwhile; ?>
    <div class="pagination-wrapper">
        <?php won_pagination_theme(); ?>
	</div>
<?php else : ?>
        <?php get_template_part( 'content/content', 'none' ); ?>
<?php endif; ?>
			

<?php get_footer(); ?>