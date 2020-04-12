jQuery(document).ready( function() {

	/**
	 * Initialize select2 drop-downs.
	 */
	if ( jQuery( 'select#course-woocommerce-product-options' ).length > 0 ) {
		jQuery( 'select#course-woocommerce-product-options' ).select2(
			{
				width: 'resolve',
				multiple: true,
				// eslint-disable-next-line no-undef
				placeholder: sensei_admin_course_metadata.product_options_placeholder,
			}
		);
	}

} );
