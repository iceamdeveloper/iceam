<?php

/**
 * Class Product_Post_Connector
 */
class SP_Product_Post_Connector extends Yoast_Product {

	public function __construct() {
		parent::__construct(
			SP_Constants::EDD_STORE_URL,
			SP_Constants::EDD_PLUGIN_NAME,
			plugin_basename( Post_Connector::get_plugin_file() ),
			SP_Constants::PLUGIN_VERSION_NAME,
			'https://www.post-connector.com/',
			'admin.php?page=post_connector_license',
			'post-connector',
			SP_Constants::PLUGIN_AUTHOR
		);
	}

} 