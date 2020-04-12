/**
 * External dependencies
 */
import { __, _n, sprintf } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { debounce, find } from 'lodash';
import PropTypes from 'prop-types';
import { SearchListControl } from '@woocommerce/components';

/**
 * Internal dependencies
 */
import { isLargeCatalog, getProducts } from '../utils';

class ProductsControl extends Component {
	constructor() {
		super( ...arguments );
		this.state = {
			list: [],
			loading: true,
		};

		this.debouncedOnSearch = debounce( this.onSearch.bind( this ), 400 );
	}

	componentDidMount() {
		const { selected, courseId } = this.props;

		getProducts( { selected, courseId } )
			.then( ( list ) => {
				this.setState( { list, loading: false } );
			} )
			.catch( () => {
				this.setState( { list: [], loading: false } );
			} );
	}

	onSearch( search ) {
		const { selected, courseId } = this.props;
		getProducts( { selected, search, courseId } )
			.then( ( list ) => {
				this.setState( { list, loading: false } );
			} )
			.catch( () => {
				this.setState( { list: [], loading: false } );
			} );
	}

	render() {
		const { list, loading } = this.state;
		const { onChange, selected } = this.props;

		const messages = {
			clear: __( 'Clear all products', 'sensei-wc-paid-courses' ),
			list: __( 'Products', 'sensei-wc-paid-courses' ),
			noItems: __(
				"Your store doesn't have any products.",
				'sensei-wc-paid-courses'
			),
			search: __(
				'Search for products to display',
				'sensei-wc-paid-courses'
			),
			selected: ( n ) =>
				sprintf(
					_n(
						'%d product selected',
						'%d products selected',
						n,
						'sensei-wc-paid-courses'
					),
					n
				),
			updated: __(
				'Product search results updated.',
				'sensei-wc-paid-courses'
			),
		};

		return (
			<Fragment>
				<SearchListControl
					className="woocommerce-products"
					list={ list }
					isLoading={ loading }
					selected={ selected.map( ( id ) => find( list, { id } ) ).filter( Boolean ) }
					onSearch={ isLargeCatalog ? this.debouncedOnSearch : null }
					onChange={ onChange }
					messages={ messages }
				/>
			</Fragment>
		);
	}
}

ProductsControl.propTypes = {
	/**
	 * Callback to update the selected products.
	 */
	onChange: PropTypes.func.isRequired,
	/**
	 * The list of currently selected IDs.
	 */
	selected: PropTypes.array.isRequired,
};

export default ProductsControl;
