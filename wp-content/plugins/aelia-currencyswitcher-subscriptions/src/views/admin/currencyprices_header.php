<?php if(!defined('ABSPATH')) exit; // Exit if accessed directly
use \Aelia\WC\CurrencySwitcher\Subscriptions\Definitions;

// $text_domain is loaded in the calling view
// $currencyprices_manager is loaded in the calling view
?>
<?php
	// Show the section to allow the selection of the product's base currency
	// @since 1.4.0.181107
?>
<div class="product_base_currency">
	<div>
		<?php
			$product_base_currency_field = WC_Aelia_CurrencyPrices_Manager::FIELD_PRODUCT_BASE_CURRENCY;
			if(isset($currencyprices_manager->loop_idx)) {
				$product_base_currency_field .= "[$loop]";
			}

			$currency_options = array();
			$wc_currencies = get_woocommerce_currencies();
			foreach($enabled_currencies as $currency) {
				$currency_options[$currency] = $wc_currencies[$currency];
			}

			woocommerce_wp_select(array(
				'id' => 'subscription_' . $product_base_currency_field,
				'name' => $product_base_currency_field,
				'class' => '',
				'label' => __('Product base currency', Definitions::TEXT_DOMAIN),
				'value' => $currencyprices_manager->get_product_base_currency($post_id),
				'options' => $currency_options,
				'custom_attributes' => array(),
			));
		?>
		<div class="description"><?php
			echo __('Choose which currency should be used as the base currency for ' .
							'the product. This will be the currency from which all other prices will be ' .
							'calculated when left empty.',
							Definitions::TEXT_DOMAIN);
			?>
			<div class="warning"><?php
				echo __('<span class="important">Important: make sure that you enter product prices in the selected ' .
								'currency</span>. If the prices in product base currency are left empty, ' .
								'this setting will have no effect and the default base price (above) will be taken instead.',
								Definitions::TEXT_DOMAIN);
			?></div>
		</div>
	</div>
</div> <!-- Product base currency section - END -->
<div class="product_currency_prices_header">
	<h3><?php
		echo __('Subscription price in specific Currencies', $text_domain);
	?></h3>
	<div>
		<span class="description"><?php
			echo __('Here you can manually specify prices for specific currencies. If you do so, the prices ' .
							'entered will be used instead of converting the base price using exchange rates. To use ' .
							'exchange rates for one or more prices, simply leave the field empty (the "Auto" value will ' .
							'appear to indicate that price for that currency will be calculated automatically).',
						$text_domain);
			echo '<br />';
			echo __('<strong>Note</strong>: the billing period will each subscription will not change. ' .
							'For example, if you specify "per day" above, the same rule will apply to every ' .
							'price in specific currencies (e.g. 10 USD per day, 7 EUR per day, 5 GBP per day, etc).',
						$text_domain);
		?></span>
	</div>
</div>