<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Hook_Connection_Edit_Display_Linked_Children_Fields extends SP_Hook {
	protected $tag = 'pc_connection_edit_form_display_linked_children';

	public function run( $connection ) {

	?>
        <tr valign="top">
            <th scope="row"><?php _e( 'Display excerpt?', 'post-connector' ); ?></th>
            <td colspan="2" class="nowrap">
                <label for="after_post_display_children_excerpt" class=""><input type="checkbox" name="after_post_display_children_excerpt" id="after_post_display_children_excerpt" value="1"<?php echo( ( $connection->get_after_post_display_children_excerpt() == '1' ) ? " checked='checked'" : "" ); ?> /> <?php _e( 'Display the excerpt of linked children.', 'post-connector' ); ?>
                </label>
            </td>
        </tr>

		<tr valign="top">
			<th scope="row"><?php _e( 'Display image?', 'post-connector' ); ?></th>
			<td colspan="2" class="nowrap">
				<label for="after_post_display_children_image" class=""><input type="checkbox" name="after_post_display_children_image" id="after_post_display_children_image" value="1"<?php echo( ( $connection->get_after_post_display_children_image() == '1' ) ? " checked='checked'" : "" ); ?> /> <?php _e( 'Display the featured image of linked children.', 'post-connector' ); ?>
				</label>
			</td>
		</tr>

	<?php

	}
}