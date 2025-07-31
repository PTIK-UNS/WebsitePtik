<?php
$themetech_course = LP_Global::course();
$themetech_enroll_stu = $themetech_course->get_users_enrolled();
$themetech_enroll_stu = $themetech_enroll_stu ? $themetech_enroll_stu : 0;
?>
<article class="themetechmount-boxes themetechmount-box-course themetechmount-boxe-view-top-image themetechmount-course-box-view-top-image">
	<div class="themetechmount-post-item"> 
		<div class="themetechmount-box-content">
			<div class="themetechmount-post-item-inner">
			
				<?php echo themetechmount_get_featured_media( get_the_ID(), 'themetechmount-img-coursebox', true ); ?>
			</div>
			<div class="themetechmount-box-bottom-content">
				<div class="tm-bottom-content-inner">
					<?php echo themetechmount_box_title();?>
					<div class="themetechmount-box-desc-text">
						<?php echo themetechmount_coursebox_description();?>
					</div>	
				</div>
				<div class="themetechmount-course-box-meta">
					<div class="tm-enrolled">
						<span class="tm-count tm-meta-line"><i class="fa fa-user" aria-hidden="true"></i><?php echo esc_attr( $themetech_enroll_stu ); ?></span>
						<?php 
							if( comments_open() ){
								$comments = wp_count_comments( get_the_ID() );
								$comments = $comments->approved; //Get Total Comments
								echo '<span class="tm-comments tm-meta-line"><i class="fa fa-comment-o"></i>'. $comments .'</span>';
							}
						?>
					</div>	
					<?php echo themetechmount_get_course_price($themetech_course);?>
				</div>								
			</div>	
		</div>
	</div>	
</article>