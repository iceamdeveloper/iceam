<?php

abstract class SP_Constants extends SP_Constants_Core {

	// Plugin meta data
	const PLUGIN_VERSION_NAME = '1.6.12';
	const PREMIUM_VERSION_CODE = '36';

	// Options
	const OPTION_CURRENT_PREMIUM_VERSION = 'pc_premium_version';
	const OPTION_RELATED_CHANGED_PT = 'pc_related_changed_pt';

	// Post Meta data
	const PM_PTL_SORTABLE = 'sp_ptl_sortable';
	const PM_PTL_APDP = 'sp_ptl_after_post_display_parents';
	const PM_PTL_BACKWARDS = 'sp_ptl_backwards_linking';
	const PM_PTL_APDC_EXCERPT = 'sp_ptl_after_post_display_children_excerpt';
	const PM_PTL_APDC_IMAGE = 'sp_ptl_after_post_display_children_image';

	// EDD data
	const EDD_STORE_URL = 'https://www.post-connector.com/';
	const EDD_PLUGIN_NAME = 'Post Connector Premium';
}