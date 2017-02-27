jQuery(document).ready(function($) {
	var params = woocommerce_cache_handler_params;
	var ajax_url = params.ajax_url;
	var page_url = window.location.toString();

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

	var update_anchors = function () {
		if(params.page_hash) {
			// Append the page hash to each anchor on the page
			$('a[href^="' + params.home_url + '"]:not(a[href*="ph="]), a[href^="/"]:not(a[href*="ph="])').each(function () {
				var $anchor = $(this);
				var href = $anchor.attr('href');
				href = add_page_hash_to_url(href, params.page_hash);

				$anchor.attr('href', href);
			});
		}
	};

	var update_forms = function() {
		// Support form elements
		$('form').each(function () {
			var $form = $(this);
			var method = $form.attr('method');

			if(method && (method.toLowerCase() === 'get')) {
				$form.append('<input type="hidden" name="ph" value="' + params.page_hash + '" />');
			}
			else {
				var form_action = $form.attr('action');
				if(form_action) {
					form_action = add_page_hash_to_url(form_action, params.page_hash);
					$form.attr('action', form_action);
				}
			}
		});
	}

	var add_page_hash_to_url = function(url, hash) {
		if(url.indexOf('?ph=') > 0 || url.indexOf('&ph=') > 0) {
			return url.replace(/ph=[^&]+/, 'ph=' + hash);
		}

		if(url.indexOf('?') > 0) {
			return url + '&ph=' + hash;
		}

		return url + '?ph=' + hash;
	}

	var reload_page_with_hash = function(hash) {
		window.location = add_page_hash_to_url(page_url, hash);
	};

	var cache_buster_init = function() {
		if(!params.run_cache_buster) {
			return;
		}

		var ajax_args = get_ajax_args({
			'exec': 'get_page_hash'
		});

		// Get the hash for this page, which will be based on currency, customer's
		// country, customer's state and so on
		$.post(ajax_url, ajax_args, function(response) {
			// Debug
			console.log('Cache Buster - Ajax Response', response);
			response['page_hash'] = response['page_hash'] || '';
			// If the page hash is populated, and different from the one we have at the
			// moment, reload the page with the new hash
			if((response['page_hash'] != '') && (response['page_hash'] !== params.page_hash)) {
				reload_page_with_hash(response['page_hash']);
			}
		});

		update_forms();
		update_anchors();

		// Update the anchors when a product is added to cart
		$(document.body).on('added_to_cart', function () {
			update_anchors();
		});
	}

	cache_buster_init();
});
