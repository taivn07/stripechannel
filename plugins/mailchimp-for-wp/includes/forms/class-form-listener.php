<?php

/**
 * Class MC4WP_Form_Listener
 *
 * @since 3.0
 * @access private
 */
class MC4WP_Form_Listener {

	/**
	 * @var MC4WP_Form The submitted form instance
	 */
	public $submitted_form;

	public function add_hooks() {
		add_action( 'init', array( $this, 'listen' ) );
	}

	/**
	 * Listen for submitted forms
	 * @return bool
	 */
	public function listen() {
		if( empty( $_POST['_mc4wp_form_id'] ) ) {
			return false;
		}

		// get form instance
		try {
			$form_id = (int) $_POST['_mc4wp_form_id'];
			$form = mc4wp_get_form( $form_id );
		} catch( Exception $e ) {
			return false;
		}

		// sanitize request data
		$request_data = $_POST;
		$request_data = mc4wp_sanitize_deep( $request_data );
		$request_data = stripslashes_deep( $request_data );

		// bind request to form & validate
		$form->handle_request( $request_data );
		$form->validate();

		// store submitted form
		$this->submitted_form = $form;

		// did form have errors?
		if( ! $form->has_errors() ) {
			switch( $form->get_action() ) {
				case "subscribe":
					$result = $this->process_subscribe_form( $form );
				break;

				case "unsubscribe":
					$result = $this->process_unsubscribe_form( $form );
				break;
			}
		} else {
			foreach( $form->errors as $error_code ) {
				$form->add_notice( $form->get_message( $error_code ), 'error' );
			}

			$this->get_log()->info( sprintf( "Form %d > Submitted with errors: %s", $form->ID, join( ', ', $form->errors ) ) );
		}

		$this->respond( $form );
		return true;
	}

	/**
	 * Process a subscribe form.
	 *
	 * @param MC4WP_Form $form
	 */
	public function process_subscribe_form( MC4WP_Form $form ) {
		$result = false;
		$mailchimp = new MC4WP_MailChimp();
		$email_type = $form->get_email_type();
		$data = $form->get_data();
		$ip_address = mc4wp_get_request_ip_address();

		/** @var MC4WP_MailChimp_Subscriber $subscriber */
		$subscriber = null;

		/**
		 * @ignore
		 * @deprecated 4.0
		 */
		$data = apply_filters( 'mc4wp_merge_vars', $data );

		/**
		 * @ignore
		 * @deprecated 4.0
		 */
		$data = (array) apply_filters( 'mc4wp_form_merge_vars', $data, $form );

		// create a map of all lists with list-specific data
		$mapper = new MC4WP_List_Data_Mapper( $data, $form->get_lists() );

		/** @var MC4WP_MailChimp_Subscriber[] $map */
		$map = $mapper->map();

		// loop through lists
		foreach( $map as $list_id => $subscriber ) {
			$subscriber->status = $form->settings['double_optin'] ? 'pending' : 'subscribed';
			$subscriber->email_type = $email_type;
			$subscriber->ip_signup = $ip_address;

			/**
			 * Filters subscriber data before it is sent to MailChimp. Fires for both form & integration requests.
			 *
			 * @param MC4WP_MailChimp_Subscriber $subscriber
			 */
			$subscriber = apply_filters( 'mc4wp_subscriber_data', $subscriber );

			/**
			 * Filters subscriber data before it is sent to MailChimp. Only fires for form requests.
			 *
			 * @param MC4WP_MailChimp_Subscriber $subscriber
			 */
			$subscriber = apply_filters( 'mc4wp_form_subscriber_data', $subscriber );

			// send a subscribe request to MailChimp for each list
			$result = $mailchimp->list_subscribe( $list_id, $subscriber->email_address, $subscriber->to_array(), $form->settings['update_existing'], $form->settings['replace_interests'] );
		}

		$log = $this->get_log();

		// do stuff on failure
		if( ! is_object( $result ) || empty( $result->id ) ) {

			$error_code = $mailchimp->get_error_code();
			$error_message = $mailchimp->get_error_message();

			if( $mailchimp->get_error_code() == 214 ) {
				$form->add_error( 'already_subscribed' );
				$form->add_notice( $form->messages['already_subscribed'], 'notice' );
				$log->warning( sprintf( "Form %d > %s is already subscribed to the selected list(s)", $form->ID, $data['EMAIL'] ) );
			} else {
				$form->add_error( $error_code );
				$form->add_notice( $form->messages['error'], 'error' );
				$log->error( sprintf( 'Form %d > MailChimp API error: %s %s', $form->ID, $error_code, $error_message ) );

				/**
				 * Fire action hook so API errors can be hooked into.
				 *
				 * @param MC4WP_Form $form
				 * @param string $error_message
				 */
				do_action( 'mc4wp_form_api_error', $form, $error_message );
			}

			// bail
			return;
		}

		// Success! Did we update or newly subscribe?
		if( $result->status === 'subscribed' && $result->was_already_on_list ) {
			$form->last_event = 'updated_subscriber';
			$form->add_notice( $form->messages['updated'], 'success' );
			$log->info( sprintf( "Form %d > Successfully updated %s", $form->ID, $data['EMAIL'] ) );

			/**
			 * Fires right after a form was used to update an existing subscriber.
			 *
			 * @since 3.0
			 *
			 * @param MC4WP_Form $form Instance of the submitted form
			 * @param string $email
			 * @param array $data
			 */
			do_action( 'mc4wp_form_updated_subscriber', $form, $subscriber->email_address, $data );
		} else {
			$form->last_event = 'subscribed';
			$form->add_notice( $form->messages['subscribed'], 'success' );
			$log->info( sprintf( "Form %d > Successfully subscribed %s", $form->ID, $data['EMAIL'] ) );
		}

		/**
		 * Fires right after a form was used to add a new subscriber (or update an existing one).
		 *
		 * @since 3.0
		 *
		 * @param MC4WP_Form $form Instance of the submitted form
		 * @param string $email
		 * @param array $data
		 * @param MC4WP_MailChimp_Subscriber[] $subscriber
		 */
		do_action( 'mc4wp_form_subscribed', $form, $subscriber->email_address, $data, $map );
	}

	/**
	 * @param MC4WP_Form $form
	 */
	public function process_unsubscribe_form( MC4WP_Form $form ) {

		$mailchimp = new MC4WP_MailChimp();
		$log = $this->get_log();
		$result = null;
		$data = $form->get_data();

		// unsubscribe from each list
		foreach( $form->get_lists() as $list_id ) {
			$result = $mailchimp->list_unsubscribe( $list_id, $data['EMAIL'] );
		}

		if( ! $result ) {
			$form->add_notice( $form->messages['error'], 'error' );
			$log->error( sprintf( 'Form %d > MailChimp API error: %s', $form->ID, $mailchimp->get_error_message() ) );

			// bail
			return;
		}

		// Success! Unsubscribed.
		$form->last_event = 'unsubscribed';
		$form->add_notice( $form->messages['unsubscribed'], 'notice' );
		$log->info( sprintf( "Form %d > Successfully unsubscribed %s", $form->ID, $data['EMAIL'] ) );


		/**
		 * Fires right after a form was used to unsubscribe.
		 *
		 * @since 3.0
		 *
		 * @param MC4WP_Form $form Instance of the submitted form.
		 * @param string $email
		 */
		do_action( 'mc4wp_form_unsubscribed', $form, $data['EMAIL'] );
	}

	/**
	 * @param MC4WP_Form $form
	 */
	public function respond( MC4WP_Form $form ) {

		$success = ! $form->has_errors();

		if( $success ) {

			/**
			 * Fires right after a form is submitted without any errors (success).
			 *
			 * @since 3.0
			 *
			 * @param MC4WP_Form $form Instance of the submitted form
			 */
			do_action( 'mc4wp_form_success', $form );

		} else {

			/**
			 * Fires right after a form is submitted with errors.
			 *
			 * @since 3.0
			 *
			 * @param MC4WP_Form $form The submitted form instance.
			 */
			do_action( 'mc4wp_form_error', $form );

			// fire a dedicated event for each error
			foreach( $form->errors as $error ) {

				/**
				 * Fires right after a form was submitted with errors.
				 *
				 * The dynamic portion of the hook, `$error`, refers to the error that occurred.
				 *
				 * Default errors give us the following possible hooks:
				 *
				 * - mc4wp_form_error_error                     General errors
				 * - mc4wp_form_error_spam
				 * - mc4wp_form_error_invalid_email             Invalid email address
				 * - mc4wp_form_error_already_subscribed        Email is already on selected list(s)
				 * - mc4wp_form_error_required_field_missing    One or more required fields are missing
				 * - mc4wp_form_error_no_lists_selected         No MailChimp lists were selected
				 *
				 * @since 3.0
				 *
				 * @param   MC4WP_Form     $form        The form instance of the submitted form.
				 */
				do_action( 'mc4wp_form_error_' . $error, $form );
			}

		}

		/**
		 * Fires right before responding to the form request.
		 *
		 * @since 3.0
		 *
		 * @param MC4WP_Form $form Instance of the submitted form.
		 */
		do_action( 'mc4wp_form_respond', $form );

		// do stuff on success (non-AJAX only)
		if( $success && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

			// do we want to redirect?
			$redirect_url = $form->get_redirect_url();
			if ( ! empty( $redirect_url ) ) {
				wp_redirect( $redirect_url );
				exit;
			}
		}
	}

	/**
	 * @return MC4WP_API_v3
	 */
	protected function get_api() {
		return mc4wp('api');
	}

	/**
	 * @return MC4WP_Debug_Log
	 */
	protected function get_log() {
		return mc4wp('log');
	}

}
