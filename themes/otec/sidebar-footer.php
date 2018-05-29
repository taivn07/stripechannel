<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Twenty Kleo 1.0
 */

$kleo_footer_hidden = apply_filters('kleo_footer_hidden', false);
if ($kleo_footer_hidden == true ) {
	return;
}

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) && ! is_active_sidebar( 'footer-4' ) ) {
	return;
}

?>

<div id="footer" class="footer-color border-top">
	<!-- <div class="container">
		<div class="template-page tpl-no">
			<div class="wrap-content">
				<div class="row">
					<div class="col-sm-3">
						<div id="footer-sidebar-1" class="footer-sidebar widget-area" role="complementary">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1')): 
							endif;
							?>
						</div>
					</div>
					<div class="col-sm-3">
						<div id="footer-sidebar-2" class="footer-sidebar widget-area" role="complementary">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2')): 
							endif;
							?>
						</div>
					</div>
					<div class="col-sm-3">
						<div id="footer-sidebar-3" class="footer-sidebar widget-area" role="complementary">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3')): 
							endif;
							?>	
						</div>
					</div>
					<div class="col-sm-3">
						<div id="footer-sidebar-4" class="footer-sidebar widget-area" role="complementary">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4')): 
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="footer-content">
		<div class="footer-left">
			<a class="icon icon-cart" href="<?php echo home_url(); ?>/cart">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/cart.png"><br>
			</a>
			<a class="icon icon-cart" href="<?php echo home_url(); ?>/my-account">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/user.png"><br>
			</a>
		</div>
		<div class="footer-right">
			<a class="icon icon-intargram" href="#">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/intargram.png"><br>
			</a>
			<a class="icon icon-switer" href="#">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/switer.png"><br>
			</a>
		</div>
	</div>
</div><!-- #footer -->
