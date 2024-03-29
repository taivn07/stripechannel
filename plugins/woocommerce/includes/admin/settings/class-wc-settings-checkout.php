<?php
/**
 * WooCommerce Shipping Settings
 *
 * @author   WooThemes
 * @category Admin
 * @package  WooCommerce/Admin
 * @version  2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Settings_Payment_Gateways', false ) ) :

/**
 * WC_Settings_Payment_Gateways.
 */
class WC_Settings_Payment_Gateways extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'checkout';
		$this->label = _x( 'Checkout', 'Settings tab label', 'woocommerce' );

		add_action( 'woocommerce_admin_field_payment_gateways', array( $this, 'payment_gateways_setting' ) );
		parent::__construct();
	}

	/**
	 * Get sections.
	 *
	 * @return array
	 */
	public function get_sections() {
		$sections = array(
			'' => __( 'Checkout options', 'woocommerce' ),
		);

		if ( ! defined( 'WC_INSTALLING' ) ) {
			$payment_gateways = WC()->payment_gateways->payment_gateways();

			foreach ( $payment_gateways as $gateway ) {
				$title = empty( $gateway->method_title ) ? ucfirst( $gateway->id ) : $gateway->method_title;
				$sections[ strtolower( $gateway->id ) ] = esc_html( $title );
			}
		}

		return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
	}

	/**
	 * Get settings array.
	 *
	 * @param string $current_section
	 *
	 * @return array
	 */
	public function get_settings( $current_section = '' ) {
		$settings = array();

		if ( '' === $current_section ) {
			$settings = apply_filters( 'woocommerce_payment_gateways_settings', array(

				array(
					'title' => __( 'Checkout process', 'woocommerce' ),
					'type'  => 'title',
					'id'    => 'checkout_process_options',
				),

				array(
					'title'         => __( 'Coupons', 'woocommerce' ),
					'desc'          => __( 'Enable the use of coupons', 'woocommerce' ),
					'id'            => 'woocommerce_enable_coupons',
					'default'       => 'yes',
					'type'          => 'checkbox',
					'checkboxgroup' => 'start',
					'desc_tip'      => __( 'Coupons can be applied from the cart and checkout pages.', 'woocommerce' ),
				),

				array(
					'desc'          => __( 'Calculate coupon discounts sequentially', 'woocommerce' ),
					'id'            => 'woocommerce_calc_discounts_sequentially',
					'default'       => 'no',
					'type'          => 'checkbox',
					'desc_tip'      => __( 'When applying multiple coupons, apply the first coupon to the full price and the second coupon to the discounted price and so on.', 'woocommerce' ),
					'checkboxgroup' => 'end',
					'autoload'      => false,
				),

				array(
					'title'         => __( 'Checkout process', 'woocommerce' ),
					'desc'          => __( 'Enable guest checkout', 'woocommerce' ),
					'desc_tip'      => __( 'Allows customers to checkout without creating an account.', 'woocommerce' ),
					'id'            => 'woocommerce_enable_guest_checkout',
					'default'       => 'yes',
					'type'          => 'checkbox',
					'checkboxgroup' => 'start',
					'autoload'      => false,
				),

				array(
					'desc'            => __( 'Force secure checkout', 'woocommerce' ),
					'id'              => 'woocommerce_force_ssl_checkout',
					'default'         => 'no',
					'type'            => 'checkbox',
					'checkboxgroup'   => '',
					'show_if_checked' => 'option',
					'desc_tip'        => sprintf( __( 'Force SSL (HTTPS) on the checkout pages (<a href="%s" target="_blank">an SSL Certificate is required</a>).', 'woocommerce' ), 'https://docs.woocommerce.com/document/ssl-and-https/#section-3' ),
				),

				'unforce_ssl_checkout' => array(
					'desc'            => __( 'Force HTTP when leaving the checkout', 'woocommerce' ),
					'id'              => 'woocommerce_unforce_ssl_checkout',
					'default'         => 'no',
					'type'            => 'checkbox',
					'checkboxgroup'   => 'end',
					'show_if_checked' => 'yes',
				),

				array(
					'type' => 'sectionend',
					'id' => 'checkout_process_options',
				),

				array(
					'title' => __( 'Checkout pages', 'woocommerce' ),
					'desc'  => __( 'ユーザーが にて購入手続きを進めるために、以下の固定ページの設定が必要です。', 'woocommerce' ),
					'type'  => 'title',
					'id'    => 'checkout_page_options',
				),

				array(
					'title'    => __( 'Cart page', 'woocommerce' ),
					'desc'     => sprintf( __( 'Page contents: [%s]', 'woocommerce' ), apply_filters( 'woocommerce_cart_shortcode_tag', 'woocommerce_cart' ) ),
					'id'       => 'woocommerce_cart_page_id',
					'type'     => 'single_select_page',
					'default'  => '',
					'class'    => 'wc-enhanced-select-nostd',
					'css'      => 'min-width:300px;',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Checkout page', 'woocommerce' ),
					'desc'     => sprintf( __( 'Page contents: [%s]', 'woocommerce' ), apply_filters( 'woocommerce_checkout_shortcode_tag', 'woocommerce_checkout' ) ),
					'id'       => 'woocommerce_checkout_page_id',
					'type'     => 'single_select_page',
					'default'  => '',
					'class'    => 'wc-enhanced-select-nostd',
					'css'      => 'min-width:300px;',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Terms and conditions', 'woocommerce' ),
					'desc'     => __( 'If you define a "Terms" page the customer will be asked if they accept them when checking out.', 'woocommerce' ),
					'id'       => 'woocommerce_terms_page_id',
					'default'  => '',
					'class'    => 'wc-enhanced-select-nostd',
					'css'      => 'min-width:300px;',
					'type'     => 'single_select_page',
					'args'     => array( 'exclude' => wc_get_page_id( 'checkout' ) ),
					'desc_tip' => true,
					'autoload' => false,
				),

				array(
					'type' => 'sectionend',
					'id' => 'checkout_page_options',
				),

				array( 'title' => __( 'Checkout endpoints', 'woocommerce' ), 'type' => 'title', 'desc' => __( 'Endpoints are appended to your page URLs to handle specific actions during the checkout process. They should be unique.', 'woocommerce' ), 'id' => 'account_endpoint_options' ),

				array(
					'title'    => __( 'Pay', 'woocommerce' ),
					'desc'     => __( 'Endpoint for the "Checkout &rarr; Pay" page.', 'woocommerce' ),
					'id'       => 'woocommerce_checkout_pay_endpoint',
					'type'     => 'text',
					'default'  => 'order-pay',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Order received', 'woocommerce' ),
					'desc'     => __( 'Endpoint for the "Checkout &rarr; Order received" page.', 'woocommerce' ),
					'id'       => 'woocommerce_checkout_order_received_endpoint',
					'type'     => 'text',
					'default'  => 'order-received',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Add payment method', 'woocommerce' ),
					'desc'     => __( 'Endpoint for the "Checkout &rarr; Add payment method" page.', 'woocommerce' ),
					'id'       => 'woocommerce_myaccount_add_payment_method_endpoint',
					'type'     => 'text',
					'default'  => 'add-payment-method',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Delete payment method', 'woocommerce' ),
					'desc'     => __( 'Endpoint for the delete payment method page.', 'woocommerce' ),
					'id'       => 'woocommerce_myaccount_delete_payment_method_endpoint',
					'type'     => 'text',
					'default'  => 'delete-payment-method',
					'desc_tip' => true,
				),

				array(
					'title'    => __( 'Set default payment method', 'woocommerce' ),
					'desc'     => __( 'Endpoint for the setting a default payment method page.', 'woocommerce' ),
					'id'       => 'woocommerce_myaccount_set_default_payment_method_endpoint',
					'type'     => 'text',
					'default'  => 'set-default-payment-method',
					'desc_tip' => true,
				),

				array(
					'type' => 'sectionend',
					'id' => 'checkout_endpoint_options',
				),

				array(
					'title' => __( 'Payment gateways', 'woocommerce' ),
					'desc'  => __( 'Installed gateways are listed below. Drag and drop gateways to control their display order on the frontend.', 'woocommerce' ),
					'type'  => 'title',
					'id'    => 'payment_gateways_options',
				),

				array(
					'type' => 'payment_gateways',
				),

				array(
					'type' => 'sectionend',
					'id' => 'payment_gateways_options',
				),

			) );

			if ( wc_site_is_https() ) {
				unset( $settings['unforce_ssl_checkout'] );
			}
		}

		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		global $current_section;

		// Load shipping methods so we can show any global options they may have.
		$payment_gateways = WC()->payment_gateways->payment_gateways();

		if ( $current_section ) {
			foreach ( $payment_gateways as $gateway ) {
				if ( in_array( $current_section, array( $gateway->id, sanitize_title( get_class( $gateway ) ) ) ) ) {
					$gateway->admin_options();
					break;
				}
			}
		} else {
			$settings = $this->get_settings();

			WC_Admin_Settings::output_fields( $settings );
		}
	}

	/**
	 * Output payment gateway settings.
	 */
	public function payment_gateways_setting() {
		?>
		<tr valign="top">
			<th scope="row" class="titledesc"><?php _e( 'Gateway display order', 'woocommerce' ) ?></th>
			<td class="forminp">
				<table class="wc_gateways widefat" cellspacing="0">
					<thead>
						<tr>
							<?php
								$columns = apply_filters( 'woocommerce_payment_gateways_setting_columns', array(
									'sort'     => '',
									'name'     => __( 'Gateway', 'woocommerce' ),
									'id'       => __( 'Gateway ID', 'woocommerce' ),
									'status'   => __( 'Enabled', 'woocommerce' ),
								) );

								foreach ( $columns as $key => $column ) {
									echo '<th class="' . esc_attr( $key ) . '">' . esc_html( $column ) . '</th>';
								}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ( WC()->payment_gateways->payment_gateways() as $gateway ) {

							echo '<tr>';

							foreach ( $columns as $key => $column ) {

								switch ( $key ) {

									case 'sort' :
										echo '<td width="1%" class="sort">
											<input type="hidden" name="gateway_order[]" value="' . esc_attr( $gateway->id ) . '" />
										</td>';
										break;

									case 'name' :
										$method_title = $gateway->get_title() ? $gateway->get_title() : __( '(no title)', 'woocommerce' );
										echo '<td class="name">
											<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=' . strtolower( $gateway->id ) ) . '">' . esc_html( $method_title ) . '</a>
										</td>';
										break;

									case 'id' :
										echo '<td class="id">' . esc_html( $gateway->id ) . '</td>';
										break;

									case 'status' :
										echo '<td class="status">';
										echo ( 'yes' === $gateway->enabled ) ? '<span class="status-enabled tips" data-tip="' . esc_attr__( 'Yes', 'woocommerce' ) . '">' . esc_html__( 'Yes', 'woocommerce' ) . '</span>' : '-';
										echo '</td>';
										break;

									default :
										do_action( 'woocommerce_payment_gateways_setting_column_' . $key, $gateway );
										break;
								}
							}

							echo '</tr>';
						}
						?>
					</tbody>
				</table>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save settings.
	 */
	public function save() {
		global $current_section;

		$wc_payment_gateways = WC_Payment_Gateways::instance();

		if ( ! $current_section ) {
			// Prevent the T&Cs and checkout page from being set to the same page.
			if ( isset( $_POST['woocommerce_terms_page_id'], $_POST['woocommerce_checkout_page_id'] ) && $_POST['woocommerce_terms_page_id'] === $_POST['woocommerce_checkout_page_id'] ) {
				$_POST['woocommerce_terms_page_id'] = '';
			}

			WC_Admin_Settings::save_fields( $this->get_settings() );
			$wc_payment_gateways->process_admin_options();
			$wc_payment_gateways->init();

		} else {
			foreach ( $wc_payment_gateways->payment_gateways() as $gateway ) {
				if ( in_array( $current_section, array( $gateway->id, sanitize_title( get_class( $gateway ) ) ) ) ) {
					do_action( 'woocommerce_update_options_payment_gateways_' . $gateway->id );
					$wc_payment_gateways->init();
				}
			}
		}
	}
}

endif;

return new WC_Settings_Payment_Gateways();
