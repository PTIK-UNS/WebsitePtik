<?php
/**
 * View: Month View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @since 6.1.4 Changing our nonce verification structures.
 * @since 6.2.0 Moved the header information into a new components/header.php template.
 * @since 6.14.2 Improved accessibility for calendar view.
 *
 * @version 6.14.2
 *
 * @var string   $rest_url             The REST URL.
 * @var string   $rest_method          The HTTP method, either `POST` or `GET`, the View will use to make requests.
 * @var int      $should_manage_url    int containing if it should manage the URL.
 * @var bool     $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes    Classes used for the container of the view.
 * @var array    $container_data       An additional set of container `data` attributes.
 * @var string   $breakpoint_pointer   String we use as pointer to the current view we are setting up with breakpoints.
 */

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
	$header_classes[] = 'tribe-events-header--has-event-search';
}
?>
<div
	<?php tec_classes( $container_classes ); ?>
	data-js="tribe-events-view"
	data-view-rest-url="<?php echo esc_url( $rest_url ); ?>"
	data-view-rest-method="<?php echo esc_attr( $rest_method ); ?>"
	data-view-manage-url="<?php echo esc_attr( $should_manage_url ); ?>"
	<?php foreach ( $container_data as $key => $value ) : ?>
		data-view-<?php echo esc_attr( $key ) ?>="<?php echo esc_attr( $value ) ?>"
	<?php endforeach; ?>
	<?php if ( ! empty( $breakpoint_pointer ) ) : ?>
		data-view-breakpoint-pointer="<?php echo esc_attr( $breakpoint_pointer ); ?>"
	<?php endif; ?>
>
	<section class="tribe-common-l-container tribe-events-l-container">
		<?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'the-events-calendar' ) ] ); ?>

		<?php $this->template( 'components/json-ld-data' ); ?>

		<?php $this->template( 'components/data' ); ?>

		<?php $this->template( 'components/before' ); ?>

		<?php $this->template( 'components/header' ); ?>

		<?php $this->template( 'components/filter-bar' ); ?>

		<h2 class="tribe-common-a11y-visual-hide" id="tribe-events-calendar-header">
			<?php // translators: %s: event label plural. ?>
			<?php printf( esc_html__( 'Calendar of %s', 'the-events-calendar' ), esc_html( tribe_get_event_label_plural() ) ); ?>
		</h2>
		<table
			class="tribe-events-calendar-month"
			data-js="tribe-events-month-grid"
			aria-readonly="true"
			role="presentation"
		>

			<?php $this->template( 'month/calendar-header' ); ?>

			<?php $this->template( 'month/calendar-body' ); ?>

		</table>

		<?php $this->template( 'components/messages', [ 'classes' => [ 'tribe-events-header__messages--mobile' ] ] ); ?>

		<?php $this->template( 'month/mobile-events' ); ?>

		<?php $this->template( 'components/ical-link' ); ?>

		<?php $this->template( 'components/after' ); ?>

	</section>

</div>

<?php $this->template( 'components/breakpoints' ); ?>
