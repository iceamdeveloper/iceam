
/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';
import { Panel, PanelBody, PanelRow } from '@wordpress/components';

/**
 * Internal dependencies.
 */
import ProductsControl from '../woocommerce-components/products-control';

export default function( { productIds, onChange, courseId } ) {
	return (
		<Panel>
			<PanelBody title={ __( "Products", "sensei-wc-paid-courses" ) }>
				<PanelRow>
					<ProductsControl
						selected={ productIds }
						onChange={ onChange }
						courseId={ courseId }
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	);
}
