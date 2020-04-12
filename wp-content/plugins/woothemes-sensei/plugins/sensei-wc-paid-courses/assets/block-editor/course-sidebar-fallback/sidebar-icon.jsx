/**
 * WordPress dependencies.
 */
import { Icon } from '@wordpress/components';

/**
 * Internal dependencies.
 */
import SenseiIconSvg from './sensei-icon-svg';

export default ( props ) => (
	<Icon
		{ ...props }
		icon={ <SenseiIconSvg /> }
	/>
);
