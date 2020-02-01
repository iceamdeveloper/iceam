<?php
/**
 * View: Venue meta
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/venue/meta.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 *
 * @var WP_Post $venue The venue post object.
 *
 */
?>
<div class="tribe-events-pro-venue__meta">

	<div class="tribe-events-pro-venue__meta-row tribe-common-g-row">

		<div class="tribe-events-pro-venue__meta-data tribe-common-g-col">

			<?php $this->template( 'venue/meta/title', [ 'venue' => $venue ] ); ?>

			<?php $this->template( 'venue/meta/details', [ 'venue' => $venue ] ); ?>

			<?php $this->template( 'venue/meta/content', [ 'venue' => $venue ] ); ?>

		</div>

		<div class="tribe-events-pro-venue__meta-map tribe-common-g-col">
			<?php $this->template( 'venue/meta/map', [ 'venue' => $venue ] ); ?>
		</div>

	</div>

</div>
