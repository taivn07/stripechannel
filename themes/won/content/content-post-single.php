<?php $sticky_class = is_sticky()?'sticky':''; ?>

<?php if( has_post_format('link') ){ ?>

	<div  id="post-<?php the_ID(); ?>" <?php post_class('posts-group posts-group_pdg-right_lg '. $sticky_class); ?> >
        <article class="b-post b-post-full clearfix">

		
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
		</article>
	</div>

<?php }elseif ( has_post_format('aside') ){ ?>

	<div  id="post-<?php the_ID(); ?>" <?php post_class('posts-group posts-group_pdg-right_lg '. $sticky_class); ?> >
        <article class="b-post b-post-full clearfix">

			<div class="post-body">
		           <?php the_content(''); /* Display content  */ ?>
		    </div>

		</article>
	</div>

<?php }else{ ?>

	<div  id="post-<?php the_ID(); ?>" <?php post_class('posts-group posts-group_pdg-right_lg '. $sticky_class); ?> >
        <article class="b-post b-post-full clearfix">

			
          
          <div class="entry-date"><span class="entry-date__number"><?php the_time( get_option('date_format') );?></span></div>

          <div class="entry-main">
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

              <h2 class="entry-title"><?php the_title(); ?></h2>
            </div>

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

			<?php } ?> <br>

            <div class="entry-content">
              <?php the_content(); wp_link_pages(); ?>
            </div>
            <div class="entry-footer">

            <?php $tags = get_the_tags(); $i = 1;
                	if( $tags ){ ?> 		
		              <div class="entry-footer__group">
		                <div class="entry-footer__title"><?php esc_html_e( "tags:", "won" ); ?></div>
		                	
						    <?php foreach ($tags as $tag){
						        $tag_link = get_tag_link($tag->term_id); ?>
						        <a class="entry-footer__link" href="<?php echo esc_url($tag_link); ?>"><?php echo esc_html($tag->name); ?><?php if( $i < count($tags) ) echo ", "; $i++; ?></a>
						    <?php } ?>
		              </div>
              <?php } ?>

             <?php apply_filters( 'won_share_social', 10 ); ?>

            </div>
          </div>
        </article>
        <!-- end .post-->
        
        
      </div>

	
	


<?php } ?>


