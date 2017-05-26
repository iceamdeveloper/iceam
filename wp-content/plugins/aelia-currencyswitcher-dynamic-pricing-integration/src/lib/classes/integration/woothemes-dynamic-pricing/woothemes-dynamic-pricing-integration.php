<?php
namespace Aelia\WC\CurrencySwitcher\DynamicPricing;
if(!defined('ABSPATH')) exit; // Exit if accessed directly

use Aelia\WC\CurrencySwitcher\WC_Aelia_CurrencySwitcher;

/**
 * Implements support for Dynamic Pricing plugin.
 */
class Dynamic_Pricing_Integration {
	// @var Aelia\WC\Logger The logger used by the class.
	protected $_logger;

	protected $_currency_prices_manager;

	protected function logger() {
		if(empty($this->_logger)) {
			$this->_logger = $this->currency_switcher()->get_logger();
		}
		return $this->_logger;
	}

	/**
	 * Returns the instance of the Currency Switcher plugin.
	 *
	 * @return WC_Aelia_CurrencySwitcher
	 */
	protected function currency_switcher() {
		return isset($GLOBALS['woocommerce-aelia-currencyswitcher']) ? $GLOBALS['woocommerce-aelia-currencyswitcher'] : null;
	}

	/**
	 * Returns the instance of the settings controller loaded by the plugin.
	 *
	 * @return Aelia\WC\CurrencySwitcher\Settings
	 */
	protected function settings() {
		return WC_Aelia_CurrencySwitcher::settings();
	}

	protected function currency_prices_manager() {
		if(empty($this->_currency_prices_manager)) {
			$this->_currency_prices_manager = $this->currency_switcher()->currencyprices_manager();
		}
		return $this->_currency_prices_manager;
	}

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_filter('plugins_loaded', array($this, 'plugins_loaded'), 10);
	}

	/**
	 * Converts an amount from base currency to the currently selected currency.
	 *
	 * @param float amount The amount to convert.
	 * @param string from_currency The source currency. If empty, the base currency
	 * is taken.
	 * @param string to_currency The destination currency. If empty, the currently
	 * selected currency is taken.
	 * @return float The amount converted in the destination currency.
	 */
	protected function convert($amount, $from_currency = null, $to_currency = null) {
		if(empty($from_currency)) {
			$from_currency = $this->settings()->base_currency();
		}

		if(empty($to_currency)) {
			$to_currency = $this->currency_switcher()->get_selected_currency();
		}

		return $this->currency_switcher()->convert($amount,
																							 $from_currency,
																							 $to_currency);
	}

	protected function get_product_base_currency($product_id) {
		return $this->currency_prices_manager()->get_product_base_currency($product_id);
	}

	/**
	 * Performs operations when the plugins are loaded.
	 */
	public function plugins_loaded() {
		// Safeguard mechanism. This class can only do its job when the Currency
		// Switcher is active. If, for any reason, the class is loaded and the CS is
		// not active, no operation should be performed.
		$currency_switcher = $this->currency_switcher();
		if(is_object($currency_switcher)) {
			$this->set_hooks();
		}
	}

	/**
	 * Set the hooks required by the class.
	 */
	protected function set_hooks() {
		add_filter('woocommerce_dynamic_pricing_get_rule_amount', array($this, 'woocommerce_dynamic_pricing_get_rule_amount'), 20, 4);
		add_filter('wc_dynamic_pricing_load_modules', array($this, 'wc_dynamic_pricing_load_modules'), 20);
	}

	/**
	 * Handler for woocommerce_dynamic_pricing_get_rule_amount filter.
	 * When an absolute discount (e.g. $20) is added by Dynamic Pricing plugin,
	 * this method converts it into the currently selected currency.
	 *
	 * @param float amount The discount.
	 * @param array rule An array describing the rule being applied.
	 * @param cart_item The cart item on which the rule is being applied.
	 * @param object module The module that triggered the rule
	 * product instance created by Dynamic Pricing plugin.
	 * @return float
	 */
	public function woocommerce_dynamic_pricing_get_rule_amount($amount, $rule, $cart_item, $module) {
		$rule_type = $rule['type'];

		$from_currency = null;
		if(!empty($cart_item['product_id']) &&
			 in_array(strtolower($module->module_id), array('simple_product', 'advanced_product'))) {
			$from_currency = $this->get_product_base_currency($cart_item['product_id']);
		}

		if(in_array($rule_type, array('price_discount', 'fixed_price'))) {
			$amount = $this->convert($amount, $from_currency);
		}

		return $amount;
	}

	/**
	 * Intercept dynamic pricing modules and ensure that their fixed price values
	 * are properly converted into currency.
	 *
	 * @param array modules An array for dynamic pricing modules.
	 * @return array
	 */
	public function wc_dynamic_pricing_load_modules($modules) {
		// Debug
		//var_dump($modules);
		foreach($modules as $module_type => $module) {
			// Determine the method that will be used to process the module rules
			$module_process_method = 'process_' . $module_type . '_rules';

			if(method_exists($this, $module_process_method)) {
				$module = $this->$module_process_method($module, $module_type);

				// Return the processed module
				$modules[$module_type] = $module;
			}
			else {
				//$this->logger()->debug(__('Attempted to process an unsupported Dynamic Pricing module.'),
				//													array(
				//														'Module Type' => $module_type,
				//													));
			}
		}

		return $modules;
	}

	/**
	 * Processes the rules for a WC_Dynamic_Pricing_Simple_Category module,
	 * converting absolute discounts into the currently selected currency before
	 * they are applied.
	 *
	 * @param WC_Dynamic_Pricing_Simple_Category module The moduel to be processed.
	 * @return WC_Dynamic_Pricing_Simple_Category
	 */
	protected function process_simple_category_rules($module, $module_type) {
		if(is_array($module->available_rulesets)) {
			foreach($module->available_rulesets as $set_id => $rule_set) {
				// Take a copy of the rules before processing them. This will allow to
				// process them again, if needed, starting from their initial state
				if(!isset($rule_set['aelia_cs_original_pricing_rules'])) {
					$pricing_rules = get_value('rules', $rule_set);
					$rule_set['aelia_cs_original_pricing_rules'] = $pricing_rules;
				}
				else {
					$pricing_rules = get_value('aelia_cs_original_pricing_rules', $rule_set);
				}

				if(!is_array($pricing_rules)) {
					$this->logger()->debug(__('Category Pricing rule set - "rules" attribute is not an array. Skipping.'),
																			array(
																				'Rule Set ID' => $set_id,
																			));
					continue;
				}

				foreach($pricing_rules as $rule_idx => $rule_settings) {
					// If rule involves a fixed price, then such price must be converted into
					// the selected currency
					if(in_array($rule_settings['type'], array('fixed_product', 'fixed_price'))) {
						$rule_settings['amount'] = $this->convert($rule_settings['amount']);
					}
					$rule_set['rules'][$rule_idx] = $rule_settings;
				}

				// Replace the rule set with the one containing converted prices
				$module->available_rulesets[$set_id] = $rule_set;
			}
		}

		return $module;
	}

	/**
	 * Processes the rules for a WC_Dynamic_Pricing_Simple_Category module,
	 * converting absolute discounts into the currently selected currency before
	 * they are applied.
	 *
	 * @param WC_Dynamic_Pricing_Simple_Category module The moduel to be processed.
	 * @return WC_Dynamic_Pricing_Simple_Category
	 */
	protected function process_advanced_category_rules($module, $module_type) {
		if(is_array($module->adjustment_sets)) {
			foreach($module->adjustment_sets  as $set_id => $adjustment_set) {
				// Take a copy of the rules before processing them. This will allow to
				// process them again, if needed, starting from their initial state
				if(empty($adjustment_set->aelia_cs_original_pricing_rules)) {
					$pricing_rules = get_value('pricing_rules', $adjustment_set);
					$adjustment_set->aelia_cs_original_pricing_rules = $pricing_rules;
				}
				else {
					$pricing_rules = get_value('aelia_cs_original_pricing_rules', $adjustment_set);
				}

				if(!is_array($pricing_rules)) {
					$this->logger()->debug(__('Pricing Adjustment set - "pricing rules" attribute is not an array. Skipping.'),
																		array(
																			'Pricing Adjustment Set ID' => $set_id,
																		));
					continue;
				}

				foreach($pricing_rules as $rule_idx => $rule_settings) {
					// If rule involves a fixed price, then such price must be converted into
					// the selected currency
					if(in_array($rule_settings['type'], array('fixed_adjustment', 'fixed_price'))) {
						$rule_settings['amount'] = $this->convert($rule_settings['amount']);
					}

					$adjustment_set->pricing_rules[$rule_idx] = $rule_settings;
				}

				// Replace the rule set with the one containing converted prices
				$module->adjustment_sets[$set_id] = $adjustment_set;
			}
		}

		return $module;
	}

	/**
	 * Processes the rules for a WC_Dynamic_Pricing_Advanced_Totals module,
	 * converting absolute discounts into the currently selected currency before
	 * they are applied.
	 *
	 * @param WC_Dynamic_Pricing_Advanced_Totals module The moduel to be processed.
	 * @return WC_Dynamic_Pricing_Advanced_Totals
	 */
	protected function process_advanced_totals_rules($module, $module_type) {
		if(is_array($module->adjustment_sets )) {
			foreach($module->adjustment_sets  as $set_id => $adjustment_set) {
				// Take a copy of the rules before processing them. This will allow to
				// process them again, if needed, starting from their initial state
				if(empty($adjustment_set->aelia_cs_original_pricing_rules)) {
					$pricing_rules = get_value('pricing_rules', $adjustment_set);
					$adjustment_set->aelia_cs_original_pricing_rules = $pricing_rules;
				}
				else {
					$pricing_rules = get_value('aelia_cs_original_pricing_rules', $adjustment_set);
				}

				if(!is_array($pricing_rules)) {
					$this->logger()->debug(__('Pricing Adjustment set - "pricing rules" attribute is not an array. Skipping.'),
																		array(
																			'Pricing Adjustment Set ID' => $set_id,
																		));
					continue;
				}

				foreach($pricing_rules as $rule_idx => $rule_settings) {
					$order_total_from = get_value('from', $rule_settings);
					$rule_settings['from'] = is_numeric($order_total_from) ? $this->convert($order_total_from) : $rule_settings['from'];

					$order_total_to = get_value('to', $rule_settings);
					$rule_settings['to'] = is_numeric($order_total_to) ? $this->convert($order_total_to) : $rule_settings['to'];

					$adjustment_set->pricing_rules[$rule_idx] = $rule_settings;
				}

				// Replace the rule set with the one containing converted prices
				$module->adjustment_sets[$set_id] = $adjustment_set;
			}
		}

		return $module;
	}

	/**
	 * Processes the rules for a WC_Dynamic_Pricing_Simple_Membership module,
	 * converting absolute discounts into the currently selected currency before
	 * they are applied.
	 *
	 * @param WC_Dynamic_Pricing_Simple_Membership module The module to be processed.
	 * @return WC_Dynamic_Pricing_Simple_Membership
	 * @since 3.8.4.150824
	 */
	protected function process_simple_membership_rules($module, $module_type) {
		if(is_array($module->available_rulesets)) {
			foreach($module->available_rulesets as $set_id => $discount) {
				// Take a copy of the discount before processing them. This will allow to
				// process them again, if needed, starting from their initial state
				if(!isset($discount['aelia_cs_original_pricing_rules'])) {
					// For Role discounts, there is a single discount for each set
					$discount['aelia_cs_original_pricing_rules'] = $discount;
				}
				else {
					$discount = get_value('aelia_cs_original_pricing_rules', $discount);
				}

				if(!is_array($discount)) {
					$this->logger()->debug(__('Membership Pricing rule set - "rules" attribute is not an array. Skipping.'),
																 array(
																	'Rule Set ID' => $set_id,
																 ));
					continue;
				}

				// If rule involves a fixed price, then such price must be converted into
				// the selected currency
				if(in_array($discount['type'], array('fixed_product', 'fixed_price'))) {
					$discount['amount'] = $this->convert($discount['amount']);
				}

				// Replace the rule with the one containing converted prices
				$module->available_rulesets[$set_id] = $discount;
			}
		}
		return $module;
	}
}