/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';
import { registerPlugin, getPlugin } from '@wordpress/plugins';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { Slot } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

/**
 * Internal dependencies.
 */
import Icon from './sidebar-icon';

const pluginHandle = 'sensei-lms-course-sidebar';

const CourseSidebarFallback = () => {
	return (
		<Fragment>
			<PluginSidebarMoreMenuItem
				target={ pluginHandle }
				icon={ <Icon /> }
			>
				{ __( 'Sensei LMS', 'sensei-wc-paid-courses' ) }
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
				name={ pluginHandle }
				title={ __( "Sensei LMS", "sensei-wc-paid-courses" ) }
				icon={ <Icon /> }
			>
				<Slot name="SenseiCourseSidebar" />
			</PluginSidebar>
		</Fragment>
	);
}

setTimeout( () => {
	// Only register our sidebar if Sensei LMS hasn't already registered it.
	if ( ! getPlugin( pluginHandle ) ) {
		registerPlugin( pluginHandle, { render: CourseSidebarFallback } );
	}
} );
