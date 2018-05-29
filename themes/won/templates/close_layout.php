<?php 

function won_close_layout(){
	
	// Close layout
	wp_reset_postdata();
	$main_layout = won_get_current_main_layout();
	$width_sidebar = won_width_sidebar();

	?>
		</div>


	<?php if( $main_layout == "right_sidebar" || $main_layout == "left_sidebar" ){ ?>
	    <div class="<?php echo esc_attr($width_sidebar); ?>">
	       <?php get_sidebar(); ?>
	    </div>
	<?php } ?>


	</div></div></section>

	<?php 

}

add_action( 'won_close_layout', 'won_close_layout' );










