<?php get_header(); ?>

<section class="section-default ova_archive_portoflios">
	<div class="container">
		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="col-md-3 grid-item">

					<a href="<?php the_permalink(); ?>">
						<?php $url = get_the_post_thumbnail_url( get_the_id(), 'full' ); ?>
						<img src="<?php echo esc_url( $url ); ?>" alt="<?php the_title(); ?>"/>
						
					</a>
					<a href="<?php the_permalink(); ?>">
					<span class="b-isotope-grid__title"><?php the_title(); ?></span>
					</a>
					<span class="b-isotope-grid__categorie"><?php esc_html_e( 'Sub title', 'won' ); ?></span>
					
				</div>
			        
			<?php endwhile; ?>
				
			    <div class="col-md-12 pagination-wrapper">
			        <?php won_pagination_theme(); ?>
				</div>
				

			<?php else : ?>
			        <?php get_template_part( 'content/content', 'none' ); ?>
			<?php endif; ?>

		</div>
	</div>
</section>
			

<?php get_footer(); ?>