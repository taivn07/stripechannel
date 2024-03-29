<?php
/**
 * WooCommerce Account Settings
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Settings_Accounts', false ) ) :

/**
 * WC_Settings_Accounts.
 */
class WC_Settings_Accounts extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'account';
		$this->label = __( 'Accounts', 'woocommerce' );

		parent::__construct();
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {
		$settings = apply_filters( 'woocommerce_' . $this->id . '_settings', array(

			array( 'title' => __( 'Account pages', 'woocommerce' ), 'type' => 'title', 'desc' => __( 'Tがアカウント関連機能を提供するには、以下のページ設定が必要です。', 'woocommerce' ), 'id' => 'account_page_options' ),

			array(
				'title'    => __( 'My account page', 'woocommerce' ),
				'desc'     => sprintf( __( 'Page contents: [%s]', 'woocommerce' ), apply_filters( 'woocommerce_my_account_shortcode_tag', 'woocommerce_my_account' ) ),
				'id'       => 'woocommerce_myaccount_page_id',
				'type'     => 'single_select_page',
				'default'  => '',
				'class'    => 'wc-enhanced-select-nostd',
				'css'      => 'min-width:300px;',
				'desc_tip' => true,
			),

			array( 'type' => 'sectionend', 'id' => 'account_page_options' ),

			array( 'title' => '', 'type' => 'title', 'id' => 'account_registration_options' ),

			array(
				'title'         => __( 'Customer registration', 'woocommerce' ),
				'desc'          => __( 'Enable customer registration on the "Checkout" page.', 'woocommerce' ),
				'id'            => 'woocommerce_enable_signup_and_login_from_checkout',
				'default'       => 'yes',
				'type'          => 'checkbox',
				'checkboxgroup' => 'start',
				'autoload'      => false,
			),

			array(
				'desc'          => __( 'Enable customer registration on the "My account" page.', 'woocommerce' ),
				'id'            => 'woocommerce_enable_myaccount_registration',
				'default'       => 'no',
				'type'          => 'checkbox',
				'checkboxgroup' => 'end',
				'autoload'      => false,
			),

			array(
				'title'         => __( 'Login', 'woocommerce' ),
				'desc'          => __( 'Display returning customer login reminder on the "Checkout" page.', 'woocommerce' ),
				'id'            => 'woocommerce_enable_checkout_login_reminder',
				'default'       => 'yes',
				'type'          => 'checkbox',
				'checkboxgroup' => 'start',
				'autoload'      => false,
			),

			array(
				'title'         => __( 'Account creation', 'woocommerce' ),
				'desc'          => __( 'Automatically generate username from customer email.', 'woocommerce' ),
				'id'            => 'woocommerce_registration_generate_username',
				'default'       => 'yes',
				'type'          => 'checkbox',
				'checkboxgroup' => 'start',
				'autoload'      => false,
			),

			array(
				'desc'          => __( 'Automatically generate customer password', 'woocommerce' ),
				'id'            => 'woocommerce_registration_generate_password',
				'default'       => 'no',
				'type'          => 'checkbox',
				'checkboxgroup' => 'end',
				'autoload'      => false,
			),

			array( 'type' => 'sectionend', 'id' => 'account_registration_options' ),

			array( 'title' => __( 'My account endpoints', 'woocommerce' ), 'type' => 'title', 'desc' => __( 'Endpoints are appended to your page URLs to handle specific actions on the accounts pages. They should be unique and can be left blank to disable the endpoint.', 'woocommerce' ), 'id' => 'account_endpoint_options' ),

			array(
				'title'    => __( 'Orders', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Orders" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_orders_endpoint',
				'type'     => 'text',
				'default'  => 'orders',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'View order', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; View order" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_view_order_endpoint',
				'type'     => 'text',
				'default'  => 'view-order',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Downloads', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Downloads" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_downloads_endpoint',
				'type'     => 'text',
				'default'  => 'downloads',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Edit account', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Edit account" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_edit_account_endpoint',
				'type'     => 'text',
				'default'  => 'edit-account',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Addresses', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Addresses" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_edit_address_endpoint',
				'type'     => 'text',
				'default'  => 'edit-address',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Payment methods', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Payment methods" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_payment_methods_endpoint',
				'type'     => 'text',
				'default'  => 'payment-methods',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Lost password', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the "My account &rarr; Lost password" page.', 'woocommerce' ),
				'id'       => 'woocommerce_myaccount_lost_password_endpoint',
				'type'     => 'text',
				'default'  => 'lost-password',
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Logout', 'woocommerce' ),
				'desc'     => __( 'Endpoint for the triggering logout. You can add this to your menus via a custom link: yoursite.com/?customer-logout=true', 'woocommerce' ),
				'id'       => 'woocommerce_logout_endpoint',
				'type'     => 'text',
				'default'  => 'customer-logout',
				'desc_tip' => true,
			),

			array( 'type' => 'sectionend', 'id' => 'account_endpoint_options' ),

		) );

		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings );
	}
}

endif;

return new WC_Settings_Accounts();
