/**
 * WordPress dependencies.
 */
import { withSelect, withDispatch } from '@wordpress/data';
import { compose } from '@wordpress/compose';

/**
 * Internal dependencies.
 */
import Panel from './panel';

/**
 * The meta key for the product IDs.
 */
const productsMetaKey = '_course_woocommerce_product';

/**
 * Function to inject Panel's properties.
 */
const withProperties = withSelect( ( select ) => ( {
	productIds: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[
		productsMetaKey
	],
	productChanges: select( 'core/editor' ).getEditedPostAttribute(
		'productChanges'
	),
	courseId: select( 'core/editor' ).getCurrentPostId(),
} ) );

/**
 * Function to inject the onChange callback as a prop. Updates the post with the
 * new product IDs when called.
 */
const withOnChange = withDispatch( ( dispatch, ownProps, { select } ) => {
	const { editPost } = dispatch( 'core/editor' );

	return {
		onChange( newProducts, userInitiated = true ) {
			const newProductIds = newProducts.map( ( { id } ) => id );
			const oldProductIds = select(
				'core/editor'
			).getEditedPostAttribute( 'meta' )[ productsMetaKey ];

			const productsAdded = newProductIds.filter(
				( n ) => ! oldProductIds.includes( n )
			);
			const productsRemoved = oldProductIds.filter(
				( n ) => ! newProductIds.includes( n )
			);

			editPost( {
				meta: {
					[ productsMetaKey ]: newProductIds,
				},
				productChanges: {
					productsAdded,
					productsRemoved,
					userInitiated,
				},
			} );
		},
	};
} );

// Wrap and export the Panel component.
export default compose( withProperties, withOnChange )( Panel );
