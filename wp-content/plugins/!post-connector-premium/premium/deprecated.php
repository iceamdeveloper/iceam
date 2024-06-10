<?php

/**
 * Post_Connector used to be called SubPosts
 *
 * @deprecated 1.4.0
 */
class SubPosts extends Post_Connector {
	public function __construct() {
		_deprecated_function( __CLASS__, '1.4.0', 'Post_Connector' );
		parent::__construct();
	}

	/**
	 * Method to get the API object
	 *
	 * @access public
	 * @deprecated 1.4.0
	 * @return SP_Post_Connector_API
	 */
	public static function API() {
		_deprecated_function( __CLASS__, '1.4.0', 'Post_Connector' );
		return Post_Connector::API();
	}
}

/**
 * SP_Post_Connector_API used to be called SP_SubPostsAPI
 *
 * @deprecated 1.4.0
 */
class SP_SubPostsAPI extends SP_Post_Connector_API {
	public function __construct() {
		_deprecated_function( __CLASS__, '1.4.0', 'SP_Post_Connector_API' );
		parent::__construct();
	}
}