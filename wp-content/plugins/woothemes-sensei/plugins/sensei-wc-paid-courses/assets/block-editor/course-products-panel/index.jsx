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
 * Function to inject the product IDs as a prop.
 */
const withProductIds = withSelect( ( select ) => (
	{
		productIds: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ productsMetaKey ],
	}
) );

/**
 * Function to inject the course ID as a prop.
 */
const withCourseId = withSelect( ( select ) => (
	{
		courseId: select( 'core/editor' ).getCurrentPostId(),
	}
) );

/**
 * Function to inject the onChange callback as a prop. Updates the post with the
 * new product IDs when called.
 */
const withOnChange = withDispatch( ( dispatch ) => {
	const { editPost } = dispatch( 'core/editor' );

	return {
		onChange( newProducts ) {
			const newProductIds = newProducts.map( ( { id } ) => id );

			editPost(
				{
					meta: {
						[ productsMetaKey ]: newProductIds,
					}
				}
			);
		}
	}
} );

// Wrap and export the Panel component.
export default compose(
	withProductIds,
	withCourseId,
	withOnChange
)( Panel );
