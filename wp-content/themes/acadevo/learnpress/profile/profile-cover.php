<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

$user = $profile->get_user();

if ( $user->is_instructor() ) {
	$tm_instructor_designation = get_the_author_meta( 'tm_instructor_designation', $user->get_id() );
}
?>
<div class="tm-learn-press-profile-header">
	<div class="tm-learn-press-profile-item clearfix">
		<div class="tm-learn-press-left">
			<?php echo wp_kses_post( $user->get_profile_picture( '', 150 ) ); ?>
		</div>
		<div class="tm-learn-press-right">
			<h2 class="tm-authorname"><?php echo esc_attr( $user->get_display_name() ); ?></h2>
			<?php if (!empty($tm_instructor_designation) ) : ?>
				<div class="tm_instructor_designation"><?php echo esc_attr($tm_instructor_designation); ?></div>
			<?php endif; ?>
			<?php echo themetechmount_box_instructor_social_links($user->get_id()); ?>
		</div>		
	</div>
</div>