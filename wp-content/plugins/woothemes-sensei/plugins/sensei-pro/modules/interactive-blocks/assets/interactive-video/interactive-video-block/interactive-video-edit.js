/**
 * External dependencies
 */
import useEditorPlayer from 'sensei/assets/shared/helpers/player/use-editor-player';
import {
	useConfirmDialogProps,
	ConfirmDialog,
} from 'sensei/assets/blocks/editor-components/confirm-dialog';

/**
 * WordPress dependencies
 */
import {
	useBlockProps,
	InnerBlocks,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { useEffect, useState, useCallback } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';
import {
	createBlock,
	createBlocksFromInnerBlocksTemplate,
	store as blocksStore,
} from '@wordpress/blocks';
import { __, sprintf } from '@wordpress/i18n';
import { store as noticeStore } from '@wordpress/notices';

/**
 * Internal dependencies
 */
import InteractiveVideoSettings from './interactive-video-settings';
import usePrevious from '../use-previous';
import { EditorPlayerProvider } from '../editor-player-context';
import withRecursionNotAllowed from '../../with-recursion-not-allowed';
import { OnReplaceProvider } from './core-video-edit';
import timelineBlockMeta from '../timeline-block';
import isValidVideoBlock from './is-valid-video-block';

/**
 * Hook to get the player instance.
 *
 * @param {string} clientId Block client ID.
 *
 * @return {Object|undefined} Player instance.
 */
const usePlayer = ( clientId ) => {
	const { videoBlock } = useSelect(
		( select ) => {
			const { innerBlocks } = select( blockEditorStore ).getBlock(
				clientId
			);

			const block = innerBlocks[ 0 ];

			// Check if it's a valid video block.
			const valid = isValidVideoBlock( block );

			return { videoBlock: valid ? block : undefined };
		},
		[ clientId ]
	);

	return useEditorPlayer( videoBlock );
};

/**
 * Hook that displays confirmation when trying to change the video.
 * If confirmed, it will clear the timeline, otherwise it will revert the change.
 *
 * @param {string} clientId Block client ID.
 *
 * @return {Object} Confirm dialog props.
 */
const useVideoChangeConfirmation = ( clientId ) => {
	const [ confirmDialogProps, confirm ] = useConfirmDialogProps();

	const { replaceBlock, replaceInnerBlocks } = useDispatch(
		blockEditorStore
	);

	// Get blocks references.
	const { interactiveVideoBlock } = useSelect(
		( select ) => ( {
			interactiveVideoBlock: select( blockEditorStore ).getBlock(
				clientId
			),
		} ),
		[ clientId ]
	);
	const [ videoBlock, timelineBlock ] = interactiveVideoBlock.innerBlocks;

	// Video URL for embed or video.
	const videoUrl = videoBlock?.attributes?.url || videoBlock?.attributes?.src;

	// Previous states.
	const previousVideoUrl = usePrevious( videoUrl );
	const previousInteractiveVideoBlock = usePrevious( interactiveVideoBlock );

	// State to avoid showing confirmation after reverted.
	const [ revertedTo, setRevertedTo ] = useState( null );

	useEffect( () => {
		if (
			// If previous video was set.
			previousVideoUrl &&
			// If timeline had content.
			timelineBlock.innerBlocks.length > 0 &&
			// If video URL was changed.
			previousVideoUrl !== videoUrl &&
			// If the change wasn't the revert.
			videoUrl !== revertedTo
		) {
			confirm(
				__(
					"Changing the video will delete all content that you've added to the Interactive Timeline. Are you sure you want to continue?",
					'sensei-pro'
				)
			).then( ( value ) => {
				if ( value ) {
					replaceInnerBlocks( timelineBlock.clientId, [] );
				} else {
					replaceBlock(
						clientId,
						createBlock(
							previousInteractiveVideoBlock.name,
							previousInteractiveVideoBlock.attributes,
							previousInteractiveVideoBlock.innerBlocks
						)
					);
					setRevertedTo( previousVideoUrl );
				}
			} );
		}
	}, [
		previousVideoUrl,
		videoUrl,
		revertedTo,
		timelineBlock,
		previousInteractiveVideoBlock,
		clientId,
		confirm,
		replaceBlock,
		replaceInnerBlocks,
	] );

	return confirmDialogProps;
};

/**
 * Hook that detects whether the user is using an invalid video block and restores
 * the video back to the first variation (the video block), but only if it has
 * no breakpoints registered.
 *
 * @param {string} clientId Block client ID.
 */
const useVideoInvalidProvider = ( clientId ) => {
	const { replaceBlock, replaceInnerBlocks } = useDispatch(
		blockEditorStore
	);
	const { createErrorNotice } = useDispatch( noticeStore );

	// Get blocks references.
	const { interactiveVideoBlock, firstBlockVariation } = useSelect(
		( select ) => {
			const block = select( blockEditorStore ).getBlock( clientId );
			return {
				interactiveVideoBlock: block,
				firstBlockVariation: select( blocksStore ).getBlockVariations(
					block.name,
					'block'
				)[ 0 ],
			};
		},
		[ clientId ]
	);
	const [ videoBlock, timelineBlock ] = interactiveVideoBlock.innerBlocks;

	useEffect( () => {
		if (
			// If the block is not valid
			! isValidVideoBlock( videoBlock ) &&
			// If timeline has no content.
			timelineBlock.innerBlocks.length === 0
		) {
			const message = sprintf(
				// Translators: placeholder is video provider name
				__(
					'Videos from the provider "%s" are not supported in the Interactive Video Block',
					'sensei-pro'
				),
				videoBlock.attributes.providerNameSlug
			);
			createErrorNotice( message, {
				type: 'snackbar',
				explicitDismiss: true,
			} );
			const block = {
				...interactiveVideoBlock,
				attributes: firstBlockVariation.attributes,
				innerBlocks: createBlocksFromInnerBlocksTemplate(
					firstBlockVariation.innerBlocks
				),
			};
			replaceBlock(
				clientId,
				createBlock( block.name, block.attributes, block.innerBlocks )
			);
		}
	}, [
		clientId,
		replaceBlock,
		replaceInnerBlocks,
		firstBlockVariation,
		createErrorNotice,
		interactiveVideoBlock,
		videoBlock,
		timelineBlock,
	] );
};

/**
 * Hook that returns a function to be used as onReplace for the core/video block.
 *
 * @param {Object}   options               Hook options.
 * @param {Function} options.setAttributes Block set attributes function.
 * @param {string}   options.clientId      Block client ID.
 * @return {Function} The function to be passed as onReplace for the core/video block.
 */
const useOnReplaceVideoBlock = ( { clientId, setAttributes } ) => {
	const { replaceInnerBlocks } = useDispatch( blockEditorStore );
	return useCallback(
		( newBlock ) => {
			replaceInnerBlocks(
				clientId,
				createBlocksFromInnerBlocksTemplate( [
					[ newBlock.name, newBlock.attributes ],
					[ timelineBlockMeta.name ],
				] )
			);
		},
		[ replaceInnerBlocks, clientId, setAttributes ]
	);
};

/**
 * Interactive Video Block edit component.
 *
 * @param {Object} props Component props.
 */
const InteractiveVideoEdit = ( props ) => {
	const { clientId, setAttributes } = props;
	const blockProps = useBlockProps();
	const player = usePlayer( clientId );
	const confirmDialogProps = useVideoChangeConfirmation( clientId );
	useVideoInvalidProvider( clientId );
	const onReplace = useOnReplaceVideoBlock( {
		clientId,
		setAttributes,
	} );

	return (
		<EditorPlayerProvider value={ player }>
			<InteractiveVideoSettings { ...props } />
			<div { ...blockProps }>
				<OnReplaceProvider value={ onReplace }>
					<InnerBlocks templateLock="all" />
				</OnReplaceProvider>
			</div>
			<ConfirmDialog
				title={ __( 'Change video', 'sensei-pro' ) }
				confirmButtonText={ __( 'Change video', 'sensei-pro' ) }
				{ ...confirmDialogProps }
			/>
		</EditorPlayerProvider>
	);
};

export default withRecursionNotAllowed( InteractiveVideoEdit );
