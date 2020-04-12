/**
 * External dependencies
 */
import { addQueryArgs } from '@wordpress/url';
import apiFetch from '@wordpress/api-fetch';
import { flatten, uniqBy } from 'lodash';

export const isLargeCatalog = window.wc_product_block_data ? window.wc_product_block_data.isLargeCatalog : false;

const getProductsRequests = ( { selected = [], search, courseId } ) => {
	const requests = [
		addQueryArgs( '/sensei-wcpc-internal/v1/course-products', {
			course_id: courseId,
			per_page: isLargeCatalog ? 100 : -1,
			catalog_visibility: 'visible',
			search,
		} ),
	];

	// If we have a large catalog, we might not get all selected products in the first page.
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
 * @param {object} - A query object with the list of selected products and search term.
 */
export const getProducts = ( { selected = [], search, courseId } ) => {
	const requests = getProductsRequests( { selected, search, courseId } );

	return Promise.all( requests.map( ( path ) => apiFetch( { path } ) ) ).then( ( data ) => {
		return uniqBy( flatten( data ), 'id' );
	} );
};
