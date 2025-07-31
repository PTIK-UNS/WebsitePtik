<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
global $acadevo_theme_options;
$lp_sidebar = $acadevo_theme_options['sidebar_lpcourse'];

if ( !empty($lp_sidebar) && ($lp_sidebar != 'no' )) {
	$tm_course_container_class = 'col-lg-6 col-md-6 col-xs-12';
}
else{
	$tm_course_container_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
}

?>
<div class="tm-box-col-wrapper <?php echo esc_attr( $tm_course_container_class );?>">
<article class="themetechmount-boxes themetechmount-box-course themetechmount-boxe-view-top-image themetechmount-course-box-view-top-image">
	<?php
		learn_press_get_template( 'lp-template/course-box.php' );
	?>
</article>
</div>