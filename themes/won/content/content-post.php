<?php $sticky_class = is_sticky()?'sticky':''; ?>

<?php if( has_post_format('link') ){ ?>

	<section id="post-<?php the_ID(); ?>" <?php post_class('b-post b-post-3 clearfix  '. $sticky_class); ?> >
		
			<?php
			        $link = get_post_meta( $post->ID, 'format_link_url', true );
			        $link_description = get_post_meta( $post->ID, 'format_link_description', true );
			        
			        if ( is_single() ) {
			                printf( '<h1 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h1>',
			                        $link,
			                        get_the_title()
			                );
			        } else {
			                printf( '<h2 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h2>',
			                        $link,
			                        get_the_title()
			                );
			        }
			?>
			<?php
			        printf( '<a href="%1$s" target="blank">%2$s</a>',
			                $link,
			                $link_description
			        );
			?>
	</section>

<?php }elseif ( has_post_format('aside') ){ ?>

	<section id="post-<?php the_ID(); ?>" <?php post_class('b-post b-post-3 clearfix  '. $sticky_class); ?> >
			<div class="post-body">
		           <?php the_content(''); /* Display content  */ ?>
		    </div>
	</section>

<?php }else{ ?>

	<section id="post-<?php the_ID(); ?>" <?php post_class('b-post b-post-3 clearfix  '. $sticky_class); ?> >
      	
      	<?php if( has_post_format('audio') ){ ?>

			<div class="entry-media">
				<?php won_postformat_audio(); /* Display video of post */ ?>
			</div>

		<?php }elseif(has_post_format('gallery')){ ?>
			<div class="entry-media">
				<?php won_content_gallery(); /* Display gallery of post */ ?>
			</div>

		<?php }elseif(has_post_format('video')){ ?>

			 <div class="entry-media">
	        	<?php won_postformat_video(); /* Display video of post */ ?>
	        </div>

		<?php }elseif(has_post_thumbnail()){ ?>

	        <div class="entry-media">
	        	<?php won_content_thumbnail('full'); /* Display thumbnail of post */ ?>
	        </div>

	    <?php } ?>

      <div class="entry-inner">
        <div class="entry-date newversion"><span class="entry-date__number"><?php the_time( 'd' );?></span><span class="entry-date__month"><?php the_time( 'M' );?></span></div>
        <div class="entry-main newversion">
          <div class="entry-header">
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
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </div>
          <div class="entry-content">
            <?php the_excerpt(); ?>
          </div>
          <div class="entry-footer"><a class="btn btn-theme" href="<?php the_permalink(); ?>"><?php esc_html_e( "read more", "won" ); ?></a></div>
        </div>
      </div>
    </section>

	


<?php } ?>
