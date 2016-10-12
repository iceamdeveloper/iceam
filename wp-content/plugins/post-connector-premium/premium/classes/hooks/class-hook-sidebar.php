<?php

class SP_Hook_Sidebar extends SP_Hook {
	protected $tag = 'pc_sidebar';

	public function run() {
		?>
		<div class="pc-box">
			<h3 class="pc-title"><?php _e( 'Looking for support?', 'post-connector' ); ?></h3>

			<p><?php printf( __( "For support questions please drop us an email at <a href='%s'>%s</a>.", 'post-connector' ), 'mailto:support@post-connector.com', 'support@post-connector.com' ); ?></p>
		</div>
	<?php
	}
}