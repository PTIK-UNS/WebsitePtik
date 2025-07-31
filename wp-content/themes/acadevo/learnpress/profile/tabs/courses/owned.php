<?php
/**
 * Template for displaying own courses in courses tab of user profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/courses/own.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.11.2
 */

defined( 'ABSPATH' ) || exit();

$profile       = learn_press_get_profile();
$filter_status = LP_Request::get_string( 'filter-status' );
$query         = $profile->query_courses( 'own', array( 'status' => $filter_status ) );
?>

<div class="learn-press-subtab-content">

    <h3 class="profile-heading">
		<?php esc_attr_e( 'My Courses', 'acadevo' ); ?>
    </h3>

	<?php if ( $filters = $profile->get_own_courses_filters( $filter_status ) ) { ?>
        <ul class="lp-sub-menu">
			<?php foreach ( $filters as $class => $link ) { ?>
                <li class="<?php echo esc_attr( $class ); ?>"><?php echo wp_kses_post( $link ); ?></li>
			<?php } ?>
        </ul>
	<?php } ?>

	<?php if ( ! $query['total'] ) {
		learn_press_display_message( __( 'No courses!', 'acadevo' ) );
	} else { ?>
			<div class="row multi-columns-row themetechmount-boxes-row-wrapper">
				<div class="tm-learn-presscourses tm-profilecourses-list">
					<?php
					global $post;
					foreach ( $query['items'] as $item ) {
						$course = learn_press_get_course( $item );
						$post   = get_post( $item );
						setup_postdata( $post );

						echo '<div class="tm-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 ">';
						learn_press_get_template( 'template-parts/coursebox/coursebox-top-image.php' );
						echo '</div>';
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
		<?php $query->get_nav( '', true, $profile->get_current_url() ); ?>

	<?php } ?>
</div>