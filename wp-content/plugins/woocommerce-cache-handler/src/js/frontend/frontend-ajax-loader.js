/* JavaScript for Frontend pages */
jQuery(document).ready(function($) {
	/**
	 * Returns the value of a cookie.
	 *
	 * @param string name The cookie name.
	 * @return mixed
	 */
	function get_cookie(name) {
		// If js-cookie is installed, use it
		if(typeof Cookies != 'undefined') {
			return Cookies.get(name);
		}
		if(typeof $.cookie != 'undefined') {
			return $.cookie(name);
		}
		return null;
	}

	var params = woocommerce_cache_handler_params;
	var ajax_url = params.ajax_url;
	var active_currency = '';
	var price_slider_params = {
		initialized: false
	}

	// Common arguments for Ajax calls
	var default_ajax_args = {
		'action': params.ajax_action,
		'_ajax_nonce': params.wp_nonce
	}

	/**
	 * Returns a set of Ajax arguments, which include the default ones.
	 *
	 * @param object args A set of arguments, to replace the default ones.
	 * @return object
	 */
	var get_ajax_args = function(args) {
		return $.extend({}, default_ajax_args, args);
	}

	/**
	 * Retrieves the active currency via Ajax.
	 *
	 * @return string
	 */
	var get_active_currency = function() {
		if(active_currency == '') {
			var ajax_args = get_ajax_args({
				'exec': 'get_active_currency'
			});
			$.post(ajax_url, ajax_args, function(response) {
				// Check that the response contains the active currency. Without it, we
				// can't do anything
				// @since 1.0.8.180207
				if(!response || !response['active_currency']) {
					console.log('Unable to determine the active currency');
					console.log('Response for Ajax call "' + ajax_args.exec + '":');
					console.log(response);
					return;
				}

				active_currency = response['active_currency'];
				$(document).trigger('active_currency_retrieved', active_currency);
			});
		}
	}

	/**
	 * Convenience function to invoke jQuery.ui.block().
	 *
	 * @param object elements The jQuery elements to "block".
	 */
	var block_elements = function($elements) {
		$elements.block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
	}

	/**
	 * Updates the product prices on the page, fetching the "live" ones in the
	 * currency that applies to the user.
	 */
	var update_product_prices = function() {
		// Collect the product prices display on the page
		var $product_prices = $('.aelia_product_price');

		if($product_prices.length <= 0) {
			return;
		}

		var product_ids = $.map($product_prices, function(elem) {
				return $(elem).data('product_id');
		});

		// "Block" the prices to show that they are being refreshed
		block_elements($product_prices);

		var ajax_args = get_ajax_args({
			'exec': 'get_product_prices_html',
			'product_ids': product_ids
		});
		$.post(ajax_url, ajax_args, function(response) {
			// Debug
			//console.log(response);

			if(response['product_prices_html']) {
				var product_prices_html = response['product_prices_html'];
				$product_prices.each(function() {
					var $elem = $(this);
					var product_id = $elem.data('product_id');

					// Update each of the prices using the returned data
					if(product_prices_html[product_id]) {
						$elem.html(product_prices_html[product_id]);
					}
				});
			}
			else {
				console.log('Unexpected response received for "' + ajax_args.exec + '"');
				console.log(response);
			}
			// "Unblock" the prices
			$product_prices.unblock();
		});
	}

	/**
	 * Updates the HTML produced by the [aelia_shortcode_currency_amount] shortcode,
	 * showing the values in the active currency.
	 */
	var update_currency_amount_shortcodes = function() {
		// Collect the product prices display on the page
		var $shortcodes = $('.aelia_shortcode_currency_amount');

		if($shortcodes.length <= 0) {
			return;
		}

		var shortcodes = {};
		$.each($shortcodes, function() {
			var $elem = $(this);
			shortcodes[$elem.data('shortcode_id')] = $elem.data('shortcode_args');
		});

		// "Block" the prices to show that they are being refreshed
		block_elements($shortcodes);

		var ajax_args = get_ajax_args({
			'exec': 'get_currency_amount_shortcodes_html',
			'shortcodes': shortcodes
		});
		$.post(ajax_url, ajax_args, function(response) {
			// Debug
			//console.log(response);

			if(response['shortcodes_html']) {
				var shortcodes_html = response['shortcodes_html'];
				$shortcodes.each(function() {
					var $elem = $(this);
					var shortcode_id = $elem.data('shortcode_id');

					// Update each of the prices using the returned data
					if(shortcodes_html[shortcode_id]) {
						$elem.html(shortcodes_html[shortcode_id]);
					}
				});
			}
			else {
				console.log('Unexpected response received for "' + ajax_args.exec + '"');
				console.log(response);
			}
			// "Unblock" the prices
			$shortcodes.unblock();
		});
	}

	/**
	 * Updates the currency selector rendered by the Aelia Currency Switcher, so
	 * that they show the currency passed as a parameter as "selected".
	 *
	 * @param string currency_code A currency code.
	 */
	var update_currency_selectors = function(currency_code) {
		$('.widget_wc_aelia_currencyswitcher_widget').each(function() {
			var $widget = $(this);
			$widget.find('select').val(currency_code);
			$widget.find('button:not(.' + currency_code + ')').removeClass('active');
			$widget.find('button.' + currency_code).addClass('active');
		});
	}

	/**
	 * Indicates if a country exists amongst the options in a given country
	 * selector widget.
	 *
	 * @param object $widget
	 * @param string country_code
	 * @since 1.0.9.180212
	 */
	var country_exists_in_selector = function($widget, country_code) {
		return $widget.find('select.countries option[value="' + country_code + '"]').length > 0;
	}

	/**
	 * Updates the country selector rendered by the Aelia plugins, so
	 * that they show the country passed as a parameter as "selected".
	 */
	var update_country_selectors = function() {
		var country_code = get_cookie('aelia_customer_country') || '';
		var state_code = get_cookie('aelia_customer_state') || '';
		if(country_code == '') {
			return;
		}

		// Update country and state selectors
		$('.widget_wc_aelia_country_selector_widget, .widget_wc_aelia_customer_country_selector_widget').each(function() {
			var $widget = $(this);
			var location_changed = false;

			// If the country we fetched doesn't exist in the country selector, it
			// can't be selected. Trying to select it anyway would cause an infinite
			// loop, as the country selector would have a different value at the next
			// page load, and triggered the (pointless) selection again
			// @since
			if(!country_exists_in_selector($widget, country_code)) {
				return;
			}

			// Only change the country if the selected one is different
			// @since 1.0.8.180207
			if($widget.find('select.countries').val() != country_code) {
				$widget.find('select.countries').val(country_code);
				location_changed = true;
			}

			// Only change the state/province if the selected one is different
			// @since 1.0.8.180207
			if((state_code != '') && ($widget.find('select.states').val() != 'state_code')) {
				$widget.find('select.states').val(state_code);
				location_changed = true;
			}

			if(location_changed) {
				$widget.find('select.countries').change();
			}
		});
	}

	/**
	 * Updates text elements that show currency information, such as currency
	 * symbols or codes.
	 *
	 * @param string currency_code A currency code.
	 */
	var update_static_currency_elements = function(currency_code) {
		$('.active_currency_code').text(currency_code);

		var currency_symbol = params['currencies'][currency_code]['symbol'];
		$('.active_currency_symbol').text(currency_symbol);
	}

	/**
	 * Updates the price slider filter widget, if visible, so that it shows the
	 * values in the correct currency.
	 */
	var update_price_slider = function() {
		// To update the slider, we need to have an active currency and wait for the
		// slider to be initialised
		if((active_currency == '') || !price_slider_params.initialized) {
			return;
		}

		var $slider = $('.price_slider').first();
		if($slider.length <= 0) {
			return;
		}

		var $slider_widget = $slider.parents('.widget_price_filter').first();
		// If the filter is already in the correct currency, there's no need to take
		// action
		if($slider_widget.find('#price_filter_currency').val() === active_currency) {
			return;
		}

		var current_min_value = price_slider_params.current_min_value;
		var current_max_value = price_slider_params.current_max_value;

		block_elements($slider_widget);

		// Update the currency symbol
		woocommerce_price_slider_params.currency_symbol = params['currencies'][active_currency]['symbol'];

		var current_values = $slider.slider('values');
		var ajax_args = get_ajax_args({
			'exec': 'convert_amounts',
			'amounts': {
				'min_current_value': current_min_value,
				'max_current_value': current_max_value,
				'min_price': $slider_widget.find('#min_price').data('min'),
				'max_price': $slider_widget.find('#max_price').data('max')
			},
			'from_currency': $slider_widget.find('#price_filter_currency').val()
		});

		$.post(ajax_url, ajax_args, function(response) {
			// Debug
			// console.log(response);
			if(!$.isEmptyObject(response['converted_amounts'])) {
				var converted_amounts = response['converted_amounts'];

				var new_current_values = [
					parseInt(converted_amounts['min_current_value']),
					parseInt(converted_amounts['max_current_value']),
				];

				var min_amount = parseInt(converted_amounts['min_price']);
				var max_amount = parseInt(converted_amounts['max_price']);

				$slider_widget.find('#min_price').val(new_current_values[0]);
				$slider_widget.find('#max_price').val(new_current_values[1]);
				$slider_widget.find('#price_filter_currency').val(active_currency);
				$slider.slider('option', 'min', min_amount);
				$slider.slider('option', 'max', max_amount);
				$slider.slider('values', new_current_values);

				$(document.body).trigger('price_slider_slide', new_current_values);
			}
			else {
				console.log('Unexpected response received for "' + ajax_args.exec + '"');
				console.log(response);
			}
			$slider_widget.unblock();
		});

		//$(".price_slider").slider('values', [50, 100]);
		//$("input#min_price").val(50);
		//$("input#max_price").val(100);
		//$(document.body).trigger("price_slider_slide", [50, 100]);
	}

	// Update the values on the page when the active currency is retrieved
	$(document).on('active_currency_retrieved', function(event, active_currency) {
		update_currency_selectors(active_currency);
		update_country_selectors();

		update_product_prices();
		update_currency_amount_shortcodes();

		update_static_currency_elements(active_currency);
		update_price_slider();
	});

	// Update the price slider after it has been initialised
	$(document.body).on('price_slider_create', function(event, current_min_value, current_max_value) {
		price_slider_params = {
			initialized: true,
			current_min_value: current_min_value,
			current_max_value: current_max_value
		}

		// Call the price slider update. We have to call it here as well, because
		// we can't predict if the "active_currency_retrieved" event will be fired
		// before of after "price_slider_create"
		update_price_slider();

		//console.log(current_min_value, current_max_value);
	});

	// Retrieve the active currency. This will also trigger the update of various
	// elements on the page
	get_active_currency();
});
