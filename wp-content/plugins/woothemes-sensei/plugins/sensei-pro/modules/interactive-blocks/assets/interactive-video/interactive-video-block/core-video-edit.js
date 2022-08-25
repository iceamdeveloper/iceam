/**
 * WordPress dependencies
 */
import { useContext, createContext } from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

const OnReplaceContext = createContext( undefined );

/**
 * Provider for the Interactive Video block's communication with core/video block.
 *
 * @param {Object}   props       Component props.
 * @param {Function} props.value The callback to pass to core/video block.
 */
export const OnReplaceProvider = OnReplaceContext.Provider;

/**
 * Hook that determine the new props for the core/video block edit component
 * if OnReplaceContext is defined.
 *
 * @param {Object} props Component Props for the BlockEdit function
 * @return {Object} The new and possibly overwritten- props.
 */
const useNewProps = ( props ) => {
	const onReplace = useContext( OnReplaceContext );
	if ( props.name === 'core/video' && ! props.onReplace && onReplace ) {
		return {
			...props,
			onReplace,
		};
	}
	return props;
};

/**
 * Return a component that modifies the core/video block to use a onReplace
 * callback offered by the interactive video block.
 *
 * @param {Function} BlockEdit The component to overwrite
 * @return {Function} The component to detect core/video and determine onReplace appropriately.
 */
const VideoBlockEdit = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const newProps = useNewProps( props );
		return <BlockEdit { ...newProps } />;
	};
}, 'VideoBlockEdit' );

addFilter(
	'editor.BlockEdit',
	'sensei-pro/interactive-video/video-block-edit',
	VideoBlockEdit
);
