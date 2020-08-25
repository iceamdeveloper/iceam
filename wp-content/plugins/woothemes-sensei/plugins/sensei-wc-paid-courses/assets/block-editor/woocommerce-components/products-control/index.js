/* global sensei_admin_course_metadata wp */
/**
 * External dependencies
 */
import { __, _n, sprintf } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { debounce, find } from 'lodash';
import PropTypes from 'prop-types';
import { SearchListControl } from '@woocommerce/components';
import UserConfirmationModal from './modal';

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
			userConfirmed: false,
		};

		this.debouncedOnSearch = debounce( this.onSearch.bind( this ), 400 );
	}

	handleGetProductsSuccess = ( response ) => {
		this.setState( {
			productList: response.products,
			userConfirmed: response.userConfirmedModal,
			loading: false,
		} );
	};

	handleGetProductsFailure = () => {
		this.setState( {
			productList: [],
			userConfirmed: false,
			loading: false,
		} );
	};

	componentDidMount() {
		const { selected, courseId } = this.props;

		getProducts( { selected, courseId } )
			.then( this.handleGetProductsSuccess )
			.catch( this.handleGetProductsFailure );
	}

	onSearch( search ) {
		const { selected, courseId } = this.props;
		getProducts( { selected, search, courseId } )
			.then( this.handleGetProductsSuccess )
			.catch( this.handleGetProductsFailure );
	}

	shouldDisplayModal() {
		const { productList, userConfirmed } = this.state;
		const { productChanges } = this.props;

		let changedProductHasSales = false;

		if (
			productChanges &&
			productChanges.userInitiated &&
			! userConfirmed
		) {
			const allChangedProducts = productChanges.productsAdded.concat(
				productChanges.productsRemoved
			);

			for ( const changedProduct of allChangedProducts ) {
				changedProductHasSales = productList.some(
					( product ) =>
						product.id === changedProduct && product.total_sales > 0
				);

				if ( changedProductHasSales ) {
					return true;
				}
			}
		}

		return false;
	}

	doSearch( search ) {
		this.setState( { loading: true } );
		this.debouncedOnSearch( search );
	}

	render() {
		const { productList, loading } = this.state;
		const { onChange, productChanges, selected } = this.props;

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
					// translators: Placeholder is the number of products selected.
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

		const onConfirm = () => {
			wp.data
				.dispatch( 'core/editor' )
				.editPost( { user_confirmed_modal: true } );

			this.setState(
				Object.assign( {}, this.state, { userConfirmed: true } )
			);
		};

		const onCancel = () => {
			// Get the currently selected products.
			let selectedAfterCancel = [ ...selected ];

			// Undo the user selection by removing added products and by adding the ones that were removed.
			selectedAfterCancel = selectedAfterCancel
				.filter(
					( product ) =>
						! productChanges.productsAdded.includes( product )
				)
				.concat( productChanges.productsRemoved );

			onChange(
				selectedAfterCancel.map( ( productId ) => ( {
					id: productId,
				} ) ),
				false
			);
		};

		return (
			<>
				<Fragment>
					<SearchListControl
						className="woocommerce-products sensei-course-products"
						list={ productList }
						isLoading={ loading }
						selected={ selected
							.map( ( id ) => find( productList, { id } ) )
							.filter( Boolean ) }
						onSearch={
							isLargeCatalog
								? ( search ) => this.doSearch( search )
								: null
						}
						onChange={ onChange }
						messages={ messages }
					/>
				</Fragment>
				{ this.shouldDisplayModal() && (
					<UserConfirmationModal
						title={ sensei_admin_course_metadata.modal_title }
						content={ sensei_admin_course_metadata.modal_content }
						onCancel={ onCancel }
						onConfirm={ onConfirm }
					/>
				) }
			</>
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
