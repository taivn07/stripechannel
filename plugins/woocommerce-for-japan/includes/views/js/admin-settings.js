jQuery( document ).ready( function ( $ ) {

    // enable watermark for
    $( document ).on( 'change', '#df_option_everywhere, #df_option_cpt', function () {
	if ( $( '#cpt-specific input[type=radio]:checked' ).val() === 'everywhere' ) {
	    $( '#cpt-select' ).fadeOut( 300 );
	} else if ( $( '#cpt-specific input[type=radio]:checked' ).val() === 'specific' ) {
	    $( '#cpt-select' ).fadeIn( 300 );
	}
    } );

    $( document ).on( 'click', '#reset_image_watermark_options', function () {
	return confirm( iwArgs.resetToDefaults );
    } );

    // size slider
    $( '#iw_size_span' ).slider( {
	value: $( '#iw_size_input' ).val(),
	min: 0,
	max: 100,
	step: 1,
	orientation: 'horizontal',
	slide: function ( e, ui ) {
	    $( '#iw_size_input' ).attr( 'value', ui.value );
	    $( '#iw_size_span' ).attr( 'title', ui.value );
	}
    } );

    // opacity slider
    $( '#iw_opacity_span' ).slider( {
	value: $( '#iw_opacity_input' ).val(),
	min: 0,
	max: 100,
	step: 1,
	orientation: 'horizontal',
	slide: function ( e, ui ) {
	    $( '#iw_opacity_input' ).attr( 'value', ui.value );
	    $( '#iw_opacity_span' ).attr( 'title', ui.value );
	}
    } );

    // quality slider
    $( '#iw_quality_span' ).slider( {
	value: $( '#iw_quality_input' ).val(),
	min: 0,
	max: 100,
	step: 1,
	orientation: 'horizontal',
	slide: function ( e, ui ) {
	    $( '#iw_quality_input' ).attr( 'value', ui.value );
	    $( '#iw_quality_span' ).attr( 'title', ui.value );
	}
    } );

    // quality slider
    $( '#iw_backup_quality_span' ).slider( {
	value: $( '#iw_backup_quality_input' ).val(),
	min: 0,
	max: 100,
	step: 1,
	orientation: 'horizontal',
	slide: function ( e, ui ) {
	    $( '#iw_backup_quality_input' ).attr( 'value', ui.value );
	    $( '#iw_backup_quality_span' ).attr( 'title', ui.value );
	}
    } );

	// Field validation error tips
	$( document.body )

		.on( 'wc_add_error_tip', function( e, element, error_type ) {
			var offset = element.position();

			if ( element.parent().find( '.wc_error_tip' ).length === 0 ) {
				element.after( '<div class="wc_error_tip ' + error_type + '">' + woocommerce_admin[error_type] + '</div>' );
				element.parent().find( '.wc_error_tip' )
					.css( 'left', offset.left + element.width() - ( element.width() / 2 ) - ( $( '.wc_error_tip' ).width() / 2 ) )
					.css( 'top', offset.top + element.height() )
					.fadeIn( '100' );
			}
		})

		.on( 'wc_remove_error_tip', function( e, element, error_type ) {
			element.parent().find( '.wc_error_tip.' + error_type ).fadeOut( '100', function() { $( this ).remove(); } );
		})

		.on( 'click', function() {
			$( '.wc_error_tip' ).fadeOut( '100', function() { $( this ).remove(); } );
		})

		.on( 'blur', '.wc_input_decimal[type=text], .wc_input_price[type=text], .wc_input_country_iso[type=text]', function() {
			$( '.wc_error_tip' ).fadeOut( '100', function() { $( this ).remove(); } );
		})

		.on( 'change', '.wc_input_price[type=text], .wc_input_decimal[type=text], .wc-order-totals #refund_amount[type=text]', function() {
			var regex;

			if ( $( this ).is( '.wc_input_price' ) || $( this ).is( '#refund_amount' ) ) {
				regex = new RegExp( '[^\-0-9\%\\' + woocommerce_admin.mon_decimal_point + ']+', 'gi' );
			} else {
				regex = new RegExp( '[^\-0-9\%\\' + woocommerce_admin.decimal_point + ']+', 'gi' );
			}

			var value    = $( this ).val();
			var newvalue = value.replace( regex, '' );

			if ( value !== newvalue ) {
				$( this ).val( newvalue );
			}
		})

		.on( 'keyup', '.wc_input_price[type=text], .wc_input_decimal[type=text], .wc_input_country_iso[type=text], .wc-order-totals #refund_amount[type=text]', function() {
			var regex, error;

			if ( $( this ).is( '.wc_input_price' ) || $( this ).is( '#refund_amount' ) ) {
				regex = new RegExp( '[^\-0-9\%\\' + woocommerce_admin.mon_decimal_point + ']+', 'gi' );
				error = 'i18n_mon_decimal_error';
			} else if ( $( this ).is( '.wc_input_country_iso' ) ) {
				regex = new RegExp( '([^A-Z])+|(.){3,}', 'im' );
				error = 'i18n_country_iso_error';
			} else {
				regex = new RegExp( '[^\-0-9\%\\' + woocommerce_admin.decimal_point + ']+', 'gi' );
				error = 'i18n_decimal_error';
			}

			var value    = $( this ).val();
			var newvalue = value.replace( regex, '' );

			if ( value !== newvalue ) {
				$( document.body ).triggerHandler( 'wc_add_error_tip', [ $( this ), error ] );
			} else {
				$( document.body ).triggerHandler( 'wc_remove_error_tip', [ $( this ), error ] );
			}
		})

		.on( 'change', '#_sale_price.wc_input_price[type=text], .wc_input_price[name^=variable_sale_price]', function() {
			var sale_price_field = $( this ), regular_price_field;

			if( sale_price_field.attr( 'name' ).indexOf( 'variable' ) !== -1 ) {
				regular_price_field = sale_price_field.parents( '.variable_pricing' ).find( '.wc_input_price[name^=variable_regular_price]' );
			} else {
				regular_price_field = $( '#_regular_price' );
			}

			var sale_price    = parseFloat( window.accounting.unformat( sale_price_field.val(), woocommerce_admin.mon_decimal_point ) );
			var regular_price = parseFloat( window.accounting.unformat( regular_price_field.val(), woocommerce_admin.mon_decimal_point ) );

			if ( sale_price >= regular_price ) {
				$( this ).val( '' );
			}
		})

		.on( 'keyup', '#_sale_price.wc_input_price[type=text], .wc_input_price[name^=variable_sale_price]', function() {
			var sale_price_field = $( this ), regular_price_field;

			if( sale_price_field.attr( 'name' ).indexOf( 'variable' ) !== -1 ) {
				regular_price_field = sale_price_field.parents( '.variable_pricing' ).find( '.wc_input_price[name^=variable_regular_price]' );
			} else {
				regular_price_field = $( '#_regular_price' );
			}

			var sale_price    = parseFloat( window.accounting.unformat( sale_price_field.val(), woocommerce_admin.mon_decimal_point ) );
			var regular_price = parseFloat( window.accounting.unformat( regular_price_field.val(), woocommerce_admin.mon_decimal_point ) );

			if ( sale_price >= regular_price ) {
				$( document.body ).triggerHandler( 'wc_add_error_tip', [ $(this), 'i18_sale_less_than_regular_error' ] );
			} else {
				$( document.body ).triggerHandler( 'wc_remove_error_tip', [ $(this), 'i18_sale_less_than_regular_error' ] );
			}
		})

		.on( 'init_tooltips', function() {
			var tiptip_args = {
				'attribute': 'data-tip',
				'fadeIn': 50,
				'fadeOut': 50,
				'delay': 200
			};

			$( '.tips, .help_tip, .woocommerce-help-tip' ).tipTip( tiptip_args );

			// Add tiptip to parent element for widefat tables
			$( '.parent-tips' ).each( function() {
				$( this ).closest( 'a, th' ).attr( 'data-tip', $( this ).data( 'tip' ) ).tipTip( tiptip_args ).css( 'cursor', 'help' );
			});
		});

	// Tooltips
	$( document.body ).trigger( 'init_tooltips' );

	// wc_input_table tables
	$( '.wc_input_table.sortable tbody' ).sortable({
		items: 'tr',
		cursor: 'move',
		axis: 'y',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start: function( event, ui ) {
			ui.item.css( 'background-color', '#f6f6f6' );
		},
		stop: function( event, ui ) {
			ui.item.removeAttr( 'style' );
		}
	});

	$( '.wc_input_table .remove_rows' ).click( function() {
		var $tbody = $( this ).closest( '.wc_input_table' ).find( 'tbody' );
		if ( $tbody.find( 'tr.current' ).length > 0 ) {
			var $current = $tbody.find( 'tr.current' );
			$current.each( function() {
				$( this ).remove();
			});
		}
		return false;
	});

	var controlled = false;
	var shifted    = false;
	var hasFocus   = false;

	$( document.body ).bind( 'keyup keydown', function( e ) {
		shifted    = e.shiftKey;
		controlled = e.ctrlKey || e.metaKey;
	});

	$( '.wc_input_table' ).on( 'focus click', 'input', function( e ) {
		var $this_table = $( this ).closest( 'table, tbody' );
		var $this_row   = $( this ).closest( 'tr' );

		if ( ( e.type === 'focus' && hasFocus !== $this_row.index() ) || ( e.type === 'click' && $( this ).is( ':focus' ) ) ) {
			hasFocus = $this_row.index();

			if ( ! shifted && ! controlled ) {
				$( 'tr', $this_table ).removeClass( 'current' ).removeClass( 'last_selected' );
				$this_row.addClass( 'current' ).addClass( 'last_selected' );
			} else if ( shifted ) {
				$( 'tr', $this_table ).removeClass( 'current' );
				$this_row.addClass( 'selected_now' ).addClass( 'current' );

				if ( $( 'tr.last_selected', $this_table ).length > 0 ) {
					if ( $this_row.index() > $( 'tr.last_selected', $this_table ).index() ) {
						$( 'tr', $this_table ).slice( $( 'tr.last_selected', $this_table ).index(), $this_row.index() ).addClass( 'current' );
					} else {
						$( 'tr', $this_table ).slice( $this_row.index(), $( 'tr.last_selected', $this_table ).index() + 1 ).addClass( 'current' );
					}
				}

				$( 'tr', $this_table ).removeClass( 'last_selected' );
				$this_row.addClass( 'last_selected' );
			} else {
				$( 'tr', $this_table ).removeClass( 'last_selected' );
				if ( controlled && $( this ).closest( 'tr' ).is( '.current' ) ) {
					$this_row.removeClass( 'current' );
				} else {
					$this_row.addClass( 'current' ).addClass( 'last_selected' );
				}
			}

			$( 'tr', $this_table ).removeClass( 'selected_now' );
		}
	}).on( 'blur', 'input', function() {
		hasFocus = false;
	});

	// Additional cost and Attribute term tables
	$( '.woocommerce_page_wc-settings .shippingrows tbody tr:even, table.attributes-table tbody tr:nth-child(odd)' ).addClass( 'alternate' );

	// Show order items on orders page
	$( document.body ).on( 'click', '.show_order_items', function() {
		$( this ).closest( 'td' ).find( 'table' ).toggle();
		return false;
	});

	// Select availability
	$( 'select.availability' ).change( function() {
		if ( $( this ).val() === 'all' ) {
			$( this ).closest( 'tr' ).next( 'tr' ).hide();
		} else {
			$( this ).closest( 'tr' ).next( 'tr' ).show();
		}
	}).change();

	// Hidden options
	$( '.hide_options_if_checked' ).each( function() {
		$( this ).find( 'input:eq(0)' ).change( function() {
			if ( $( this ).is( ':checked' ) ) {
				$( this ).closest( 'fieldset, tr' ).nextUntil( '.hide_options_if_checked, .show_options_if_checked', '.hidden_option' ).hide();
			} else {
				$( this ).closest( 'fieldset, tr' ).nextUntil( '.hide_options_if_checked, .show_options_if_checked', '.hidden_option' ).show();
			}
		}).change();
	});

	$( '.show_options_if_checked' ).each( function() {
		$( this ).find( 'input:eq(0)' ).change( function() {
			if ( $( this ).is( ':checked' ) ) {
				$( this ).closest( 'fieldset, tr' ).nextUntil( '.hide_options_if_checked, .show_options_if_checked', '.hidden_option' ).show();
			} else {
				$( this ).closest( 'fieldset, tr' ).nextUntil( '.hide_options_if_checked, .show_options_if_checked', '.hidden_option' ).hide();
			}
		}).change();
	});

	// Attribute term table
	$( 'table.attributes-table tbody tr:nth-child(odd)' ).addClass( 'alternate' );

	// Load videos when help button is clicked.
	$( '#contextual-help-link' ).on( 'click', function() {
		var frame = $( '#tab-panel-woocommerce_guided_tour_tab iframe' );

		frame.attr( 'src', frame.data( 'src' ) );
	});


} );
