<?php
/**
 * Lost Password Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !function_exists( 'woo_login_popup_sc_password' ) ):
	add_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_password' );
	function woo_login_popup_sc_password( $visible ){ ?>

		<div id="woo-login-popup-sc-password" class="woo-login-popup-sc <?php echo ( $visible == 'password' ) ? 'woo-login-popup-sc-show' : '';?>">
			<div class="form-login">
				<h2><?php _e( 'パスワードを忘れた場合', 'woo-login-popup-shortcodes' ); ?></h2>

				<form method="post" class="woocommerce-ResetPassword lost_reset_password">

					<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'パスワードをお忘れですか ? ユーザー名またはメールアドレスを入力してください。新しいパスワードを発行するリンクを送信します。', 'woo-login-popup-shortcodes' ) ); ?></p>

					<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
						<label for="user_login"><?php _e( 'ユーザー名またはメールアドレス', 'woo-login-popup-shortcodes' ); ?></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" />
					</p>

					<div class="clear"></div>

					<?php do_action( 'woocommerce_lostpassword_form' ); ?>

					<p class="woocommerce-FormRow form-row">
						<input type="hidden" name="wc_reset_password" value="true" />
						<input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'パスワードをリセット', 'woo-login-popup-shortcodes' ); ?>" />
					</p>
					<p class="woocommerce-plogin">
						<a href="#woo-login-popup-sc-login" class="woo-login-popup-sc-toggle"><?php _e( 'ログイン', 'woo-login-popup-shortcodes' ); ?></a>
						<?php if( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :?>
						 | <a href="#woo-login-popup-sc-register" class="woo-login-popup-sc-toggle"><?php _e( '新規会員登録', 'woo-login-popup-shortcodes' ); ?></a>
					 	<?php endif; ?>
					</p>

					<?php wp_nonce_field( 'lost_password' ); ?>

				</form>
			</div>
		</div>

	<?php }
endif;

?>
