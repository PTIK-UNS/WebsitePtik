<?php
	global $tm_instrucotr_id;
	global $tm_instructor_name;
	global $tm_instructor_desig;
?>
<article class="themetechmount-box themetechmount-box-team themetechmount-teambox-view-overlay">
	<div class="themetechmount-post-item">
		<div class="themetechmount-team-image-box">
			<a href="<?php echo esc_url( learn_press_user_profile_link( $tm_instrucotr_id ) ); ?>"><?php echo get_avatar( $tm_instrucotr_id , 700 ); ?></a>
	        <div class="themetechmount-overlay">				
			</div>	
			<?php echo themetechmount_box_instructor_social_links($tm_instrucotr_id); ?>
		</div>	
			<div class="themetechmount-box-content">
				<div class="themetechmount-box-title"><h4><a href="<?php echo esc_url( learn_press_user_profile_link( $tm_instrucotr_id ) ); ?>"><?php echo esc_attr($tm_instructor_name); ?></a></h4></div>	
				<div class="themetechmount-team-position"><?php echo esc_attr($tm_instructor_desig); ?></div>							
			</div>			
	</div>
</article>
 