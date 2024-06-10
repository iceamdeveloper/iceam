<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_Hook_Connection_Edit_Premium_Fields extends SP_Hook {
	protected $tag = 'pc_connection_edit_form';

	public function run( $connection ) {

	?>

		<h3 class="pc-title"><?php _e( 'Automatically display linked parents', 'post-connector' ); ?></h3>

		<table class="form-table">
			<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Display linked parents?', 'post-connector' ); ?></th>
				<td colspan="2" class="nowrap">
					<label for="after_post_display_parents" class=""><input type="checkbox" name="after_post_display_parents" id="after_post_display_parents" value="1"<?php echo( ( $connection->get_after_post_display_parents() == '1' ) ? " checked='checked'" : "" ); ?> /> <?php _e( 'Display the linked parent posts under each child post.', 'post-connector' ); ?>
					</label>
				</td>
			</tr>

			</tbody>
		</table>

		<h3 class="pc-title"><?php _e( 'Sortable', 'post-connector' ); ?></h3>
		<table class="form-table">
			<tbody>

			<tr valign="top">
				<th scope="row">
					<label for="sortable" class="sp_label"><?php _e( 'Sortable', 'post-connector' ); ?></label>
				</th>
				<td colspan="2" class="nowrap">
					<label for="sortable" class=""><input type="checkbox" name="sortable" id="sortable" value="1"<?php echo( ( $connection->get_sortable() == '1' ) ? " checked='checked'" : "" ); ?> /> <?php _e( 'Allow users to sort children in the meta box at the edit post screen.', 'post-connector' ); ?>
					</label>
				</td>
			</tr>

			</tbody>
		</table>

		<h3 class="pc-title"><?php _e( 'Backwards linking', 'post-connector' ); ?></h3>

		<table class="form-table">
			<tbody>

			<tr valign="top">
				<th scope="row"><?php _e( 'Enable backwards linking', 'post-connector' ); ?></th>
				<td colspan="2" class="nowrap">
					<label for="backwards_linking" class=""><input type="checkbox" name="backwards_linking" id="backwards_linking" value="1"<?php echo( ( $connection->get_backwards_linking() == '1' ) ? " checked='checked'" : "" ); ?> /> <?php _e( 'Enable Backwards linking.', 'post-connector' ); ?>
					</label>

					<p class="help"><?php _e( 'Backwards linking allows users to link parents to children from within the child post.', 'post-connector' ); ?></p>
				</td>
			</tr>

			</tbody>
		</table>
	<?php

	}
}