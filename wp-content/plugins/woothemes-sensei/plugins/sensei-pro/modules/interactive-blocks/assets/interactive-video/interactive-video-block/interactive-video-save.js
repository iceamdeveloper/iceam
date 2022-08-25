/**
 * Interactive Video Block save component.
 *
 * @param {Object} props            Component props.
 * @param {Array}  props.children   Component children, including the video and the timeline block.
 * @param {Object} props.blockProps Block props.
 */
const InteractiveVideoSave = ( { children, blockProps } ) => {
	return <div { ...blockProps }>{ children }</div>;
};

export default InteractiveVideoSave;
