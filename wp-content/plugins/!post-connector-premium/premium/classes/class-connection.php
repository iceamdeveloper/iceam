<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Connection extends SP_Connection_Core {

	private $sortable = '0';
	private $after_post_display_parents = '0';
	private $backwards_linking = '0';
	private $after_post_display_children_excerpt = '0';
	private $after_post_display_children_image = '0';

	/**
	 * Method to set if connection is sortable
	 *
	 * @param $sortable
	 */
	public function set_sortable( $sortable ) {
		$this->sortable = $sortable;
	}

	/**
	 * Method to get if connection is sortable
	 *
	 * @access public
	 * @return int
	 */
	public function get_sortable() {
		return $this->sortable;
	}

	/**
	 * Method to set the $after_post_display_parents value
	 *
	 * @param int $after_post_display_parents
	 */
	public function set_after_post_display_parents( $after_post_display_parents ) {
		$this->after_post_display_parents = $after_post_display_parents;
	}

	/**
	 * Method to get the $after_post_display_parents value
	 *
	 * @return int
	 */
	public function get_after_post_display_parents() {
		return $this->after_post_display_parents;
	}

	/**
	 * Method to set $backwards_linking
	 *
	 * @param int $backwards_linking
	 */
	public function set_backwards_linking( $backwards_linking ) {
		$this->backwards_linking = $backwards_linking;
	}

	/**
	 * Method to get $backwards_linking
	 *
	 * @return mixed
	 */
	public function get_backwards_linking() {
		return $this->backwards_linking;
	}

	/**
	 * @return string
	 */
	public function get_after_post_display_children_excerpt() {
		return $this->after_post_display_children_excerpt;
	}

	/**
	 * @param string $after_post_display_children_excerpt
	 */
	public function set_after_post_display_children_excerpt( $after_post_display_children_excerpt ) {
		$this->after_post_display_children_excerpt = $after_post_display_children_excerpt;
	}

	/**
	 * @return string
	 */
	public function get_after_post_display_children_image() {
		return $this->after_post_display_children_image;
	}

	/**
	 * @param string $after_post_display_children_image
	 */
	public function set_after_post_display_children_image( $after_post_display_children_image ) {
		$this->after_post_display_children_image = $after_post_display_children_image;
	}

}