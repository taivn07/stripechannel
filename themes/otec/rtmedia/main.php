<?php
/* * **************************************
 * Main.php
 *
 * The main template file, that loads the header, footer and sidebar
 * apart from loading the appropriate rtMedia template
 * *************************************** */
// by default it is not an ajax request
global $rt_ajax_request;
$rt_ajax_request = false;

//todo sanitize and fix $_SERVER variable usage
// check if it is an ajax request

$_rt_ajax_request = rtm_get_server_var( 'HTTP_X_REQUESTED_WITH', 'FILTER_SANITIZE_STRING' );
if ( 'xmlhttprequest' === strtolower( $_rt_ajax_request ) ) {
	$rt_ajax_request = true;
}
?>

<?php if ( sq_option( 'bp_full_profile', 0 ) == 0 || sq_option( 'bp_full_group', 0 ) == 0 || sq_option( 'bp_nav_overlay', 0 ) == 0 ) : ?>
	<div id="buddypress">
<?php endif; ?>

<?php
//if it's not an ajax request, load headers
if ( ! $rt_ajax_request ) {
	// if this is a BuddyPress page, set template type to
	// buddypress to load appropriate headers
	if ( class_exists( 'BuddyPress' ) && ! bp_is_blog_page() && apply_filters( 'rtm_main_template_buddypress_enable', true ) ) {
		$template_type = 'buddypress';
	} else {
		$template_type = '';
	}
	//get_header( $template_type );

	if ( 'buddypress' === $template_type ) {
		//load buddypress markup
		if ( bp_displayed_user_id() ) {
			
			//if it is a buddypress member profile
			?>
			<?php do_action( 'bp_before_member_home_content' ); ?>
			<div class="row">
			
			<?php if ( sq_option( 'bp_full_profile', 0 ) == 0 ): ?>
				<div class="col-sm-12">
					<div id="item-header" role="complementary">
						
						<?php
						/**
						 * If the cover image feature is enabled, use a specific header
						 */
						if ( function_exists( 'bp_displayed_user_use_cover_image_header' ) && bp_displayed_user_use_cover_image_header() ) :
							bp_get_template_part( 'members/single/cover-image-header' );
						else :
							bp_get_template_part( 'members/single/member-header' );
						endif;
						?>
		
					</div><!-- #item-header -->
		
				</div>
			<?php endif; ?>
	
			<?php if ( ! sq_option( 'bp_nav_overlay', 0 ) == 1 ) : ?>
				<div class="col-sm-12">
					<div id="item-nav">
						<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
							<ul class="responsive-tabs">
								
								<?php bp_get_displayed_user_nav(); ?>
								
								<?php do_action( 'bp_member_options_nav' ); ?>
			
							</ul>
						</div>
					</div><!--#item-nav-->
				</div>
			<?php endif ?>
		
			<div id="item-body" class="col-sm-12">
			
			<?php do_action( 'bp_before_member_body' ); ?>
			<?php do_action( 'bp_before_member_media' ); ?>
			<div class="item-list-tabs no-ajax" id="subnav">
				<ul>
					
					<?php rtmedia_sub_nav(); ?>
					
					<?php do_action( 'rtmedia_sub_nav' ); ?>
		
				</ul>
			</div><!-- .item-list-tabs -->
			
		<?php
		}
		elseif ( bp_is_group() ) {
		//not a member profile, but a group
		?>
		
			<?php if ( bp_has_groups() ) : while ( bp_groups() ) :
			bp_the_group(); ?>
		
				<div class="row">
				
				<?php if ( sq_option( 'bp_full_group', 0 ) == 0 ): ?>
					<div class="col-sm-12">
						<div id="item-header">
							<?php bp_get_template_part( 'groups/single/group-header' ); ?>
						</div><!--#item-header-->
					</div>
				<?php endif; ?>
	
				<?php if ( ! sq_option( 'bp_nav_overlay', 0 ) == 1 ) : ?>
					<div class="col-sm-12">
						<div id="item-nav">
							<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
								<ul class="responsive-tabs">
									
									<?php bp_get_options_nav(); ?>
									
									<?php do_action( 'bp_group_options_nav' ); ?>
				
								</ul>
							</div>
						</div><!-- #item-nav -->
					</div>
				<?php endif; ?>
			
			
				<div id="item-body" class="col-sm-12">
				
				<?php do_action( 'bp_before_group_body' ); ?>
				<?php do_action( 'bp_before_group_media' ); ?>
				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						
						<?php rtmedia_sub_nav(); ?>
						
						<?php do_action( 'rtmedia_sub_nav' ); ?>
			
					</ul>
				</div><!-- .item-list-tabs -->
			<?php
			endwhile;
			endif; // group/profile if/else
		}
	} else { ////if BuddyPress
		?>
		<div id="item-body" class="col-sm-12">
		<?php
	}
} // if ajax
// include the right rtMedia template
rtmedia_load_template();

if ( ! $rt_ajax_request ) {
	if ( function_exists( 'bp_displayed_user_id' ) && 'buddypress' === $template_type && ( bp_displayed_user_id() || bp_is_group() ) ) {
		if ( bp_is_group() ) {
			do_action( 'bp_after_group_media' );
			do_action( 'bp_after_group_body' );
		}
		if ( bp_displayed_user_id() ) {
			do_action( 'bp_after_member_media' );
			do_action( 'bp_after_member_body' );
		}
	}
	?>
	</div><!--#item-body-->
	<?php
	if ( function_exists( 'bp_displayed_user_id' ) && 'buddypress' === $template_type && ( bp_displayed_user_id() || bp_is_group() ) ) {
		?>
		</div> <!-- end row -->
		<?php

		if ( bp_is_group() ) {
			do_action( 'bp_after_group_home_content' );
		}
		if ( bp_displayed_user_id() ) {
			do_action( 'bp_after_member_home_content' );
		}
	}
}
//close all markup
?>
	<?php if ( sq_option( 'bp_full_profile', 0 ) == 0 || sq_option( 'bp_full_group', 0 ) == 0 || sq_option( 'bp_nav_overlay', 0 ) == 0 ) : ?>
		</div><!--#buddypress-->
	<?php endif; ?>

<?php
//get_sidebar($template_type);
//get_footer($template_type);
// if ajax
