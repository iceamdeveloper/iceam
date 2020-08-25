/**
 * This file contains a Modal component which requests user confirmation.
 *
 * @since  2.0.0
 */

/**
 * WordPress dependencies.
 */
import { Button, Modal } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * This function constructs the UserConfirmationModal component.
 *
 * The UserConfirmationModal is a modal which requests a confirmation from the user. It contains a title, the modal
 * content and two buttons for 'Cancel' and 'Confirm'.
 *
 * @since 2.0.0
 *
 * @see  Modal https://github.com/WordPress/gutenberg/tree/master/packages/components/src/modal
 *
 * @param {String}   title                       The modal's title.
 * @param {Object}   content                     Content's JSX components. The content should be HTML-escaped.
 * @param {function} onConfirm                   Function that will be called when Confirm button is clicked.
 * @param {function} onCancel                    Function that will be called when Cancel button is clicked.
 * @param {String}   [cancelButtonText=Cancel]   Text of Cancel button.
 * @param {String}   [confirmButtonText=Confirm] Text of Confirm button.
 *
 * @returns {Object} Modal's JSX component.
 */
const UserConfirmationModal = ( {
	title,
	content,
	onConfirm,
	onCancel,
	confirmButtonText = __( 'Confirm', 'sensei-wc-paid-courses' ),
	cancelButtonText = __( 'Cancel', 'sensei-wc-paid-courses' ),
} ) => {
	const hrStyle = {
		color: '#e2e4e7',
		margin: '0px -24px',
	};

	const buttonContainerStyle = {
		textAlign: 'right',
	};

	const buttonsStyle = {
		margin: '14px 0px 0px',
	};

	return (
		<Modal
			title={ title }
			onRequestClose={ onCancel }
			shouldCloseOnClickOutside={ false }
		>
			<div
				className="user-confirmation-modal__message"
				dangerouslySetInnerHTML={ { __html: content } }
			/>
			<hr style={ hrStyle } />
			<div style={ buttonContainerStyle }>
				<Button style={ buttonsStyle } isTertiary onClick={ onCancel }>
					{ cancelButtonText }
				</Button>
				<Button style={ buttonsStyle } isPrimary onClick={ onConfirm }>
					{ confirmButtonText }
				</Button>
			</div>
		</Modal>
	);
};

export default UserConfirmationModal;
