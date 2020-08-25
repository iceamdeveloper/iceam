/**
 * External dependencies
 */
import { addQueryArgs } from '@wordpress/url';
import apiFetch from '@wordpress/api-fetch';
import { uniqBy, get } from 'lodash';

const MAX_PRODUCTS = 100;

// Get the product catalog size.
const productCatalogSize = get(
	window,
	'sensei_wc_paid_courses_block_editor_course.productCatalogSize',
	false
);

// If we don't know the catalog size, assume it is large.
export const isLargeCatalog = productCatalogSize
	? productCatalogSize > MAX_PRODUCTS
	: true;

const getProductsRequests = ( { selected = [], search, courseId } ) => {
	const requests = [
		addQueryArgs( '/sensei-wcpc-internal/v1/course-products', {
			course_id: courseId,
			per_page: MAX_PRODUCTS,
			catalog_visibility: 'visible',
			search,
		} ),
	];

	// Ensure we have all of the selected products as well.
	if ( isLargeCatalog && selected.length ) {
		requests.push(
			addQueryArgs( '/sensei-wcpc-internal/v1/course-products', {
				course_id: courseId,
				catalog_visibility: 'visible',
				include: selected,
			} )
		);
	}

	return requests;
};

/**
 * Get a promise that resolves to a list of products from the API.
 *
 * @param {Object} requestArgs            The request arguments.
 * @param {Array}  requestArgs.selected   A list of the selected products.
 * @param {string} requestArgs.search     The search string.
 * @param {number} requestArgs.courseId   The course id.
 */
export const getProducts = ( { selected = [], search, courseId } ) => {
	const requests = getProductsRequests( { selected, search, courseId } );

	return Promise.all( requests.map( ( path ) => apiFetch( { path } ) ) ).then(
		( data ) => {
			let products = [];
			const userConfirmedModal =
				data.length > 0 ? data[ 0 ].user_confirmed_modal : false;

			data.forEach(
				( response ) =>
					( products = response.products.concat( products ) )
			);

			return {
				userConfirmedModal,
				products: uniqBy( products, 'id' ),
			};
		}
	);
};
