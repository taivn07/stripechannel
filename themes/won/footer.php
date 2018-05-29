				
				<?php 
				
				if( is_page_template( 'templates/fullwidth.php' ) == false  && !is_post_type_archive( 'portfolio' ) && !is_tax( 'categories' ) ){
					do_action('won_close_layout'); 
				} 
					?>

				<?php  $footer = won_get_current_footer();
						get_template_part( 'footer/footer',$footer); 
				?>
			</div> <!-- /wrapper -->
		</div><!-- /container_boxed -->
		</div>
		<?php wp_footer(); ?>
	</body><!-- /body -->
</html>