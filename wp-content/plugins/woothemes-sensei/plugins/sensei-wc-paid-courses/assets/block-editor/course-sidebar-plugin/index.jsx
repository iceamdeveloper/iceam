/**
 * WordPress dependencies.
 */
import { registerPlugin } from '@wordpress/plugins';
import { Fill } from '@wordpress/components';

/**
 * Internal dependencies.
 */
import CourseProductsPanel from '../course-products-panel';

registerPlugin( 'sensei-wc-paid-courses-course-sidebar-plugin', {
	render: () => (
		<Fill name="SenseiCourseSidebar">
			<CourseProductsPanel />
		</Fill>
	),
} );
