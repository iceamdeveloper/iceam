<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Filter_Meta_Box_Manage_Table_Classes extends SP_Filter {
	protected $tag = 'pc_meta_box_manage_table_classes';
	protected $args = 2;

	public function run( $table_classes, $connection ) {

		// Go straight to the related tab if it's a related connections
		if ( '1' == $connection->get_sortable() ) {
			$table_classes .= " sortable";
		}

		return $table_classes;
	}
}