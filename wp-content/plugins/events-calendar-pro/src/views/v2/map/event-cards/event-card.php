<?php
/**
 * View: Map View - Event Card
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/map/event-cards/event-card.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 *
 * @var WP_Post $event        The event post object with properties added by the `tribe_get_event` function.
 * @var object  $map_provider Object with data of map provider.
 * @var int     $index        The index of the event card, starting from 0.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 */
$wrapper_classes = [ 'tribe-events-pro-map__event-card-wrapper' ];

$wrapper_classes['tribe-events-pro-map__event-card-wrapper--featured']      = $event->featured;
$wrapper_classes['tribe-events-pro-map__event-card-wrapper--has-thumbnail'] = $event->thumbnail->exists;

$article_classes = get_post_class( [ 'tribe-events-pro-map__event-card' ], $event->ID );

$data_src_attr = '';

if ( empty( $map_provider->is_premium ) ) {
	$wrapper_classes['tribe-events-pro-map__event-card-wrapper--active'] = 0 === $index;

	if ( $event->venues->count() ) {
		$iframe_url = add_query_arg( [
			'key' => $map_provider->api_key,
			'q'   => urlencode( $event->venues->first()->geolocation->address ),
		], $map_provider->iframe_url );

		$data_src_attr = 'data-src="' . esc_url( $iframe_url ) . '"';
	}
}

$aria_selected = $aria_expanded = ! $map_provider->is_premium && ( 0 === $index ) ? 'true' : 'false';
$aria_controls = 'tribe-events-pro-map-event-actions-' . $event->ID;
?>
<div
	<?php tribe_classes( $wrapper_classes ) ?>
	<?php echo $data_src_attr; ?>
	data-js="tribe-events-pro-map-event-card-wrapper"
	data-event-id="<?php echo esc_attr( $event->ID ); ?>"
>

	<button
		class="tribe-events-pro-map__event-card-button"
		data-js="tribe-events-pro-map-event-card-button"
		aria-selected="<?php echo esc_attr( $aria_selected ); ?>"
		aria-controls="<?php echo esc_attr( $aria_controls ); ?>"
		aria-expanded="<?php echo esc_attr( $aria_expanded ); ?>"
	>
		<article <?php tribe_classes( $article_classes ); ?>>
			<div class="tribe-common-g-row tribe-events-pro-map__event-row">

				<?php $this->template( 'map/event-cards/event-card/date-tag', [ 'event' => $event ] ); ?>

				<?php $this->template( 'map/event-cards/event-card/event', [ 'event' => $event, 'index' => $index ] ); ?>

			</div>
		</article>
	</button>

	<div class="tribe-events-pro-map__event-card-spacer">
		<div class="tribe-common-g-row tribe-events-pro-map__event-row-spacer">
			<div class="tribe-common-g-col tribe-events-pro-map__event-wrapper-spacer">
				<div class="tribe-common-g-row tribe-events-pro-map__event-spacer">
					<div class="tribe-common-g-col tribe-events-pro-map__event-details-spacer">
						<?php $this->template( 'map/event-cards/event-card/actions', [ 'event' => $event, 'index' => $index, 'linked' => true ] ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->template( 'map/event-cards/event-card/tooltip', [ 'event' => $event ] ); ?>

</div>
