<article class="themetechmount-box themetechmount-box-team themetechmount-box-view-topimage-bottomcontent">
	<div class="themetechmount-post-item">
		<div class="themetechmount-team-image-box">
			<?php echo themetechmount_wp_kses(themetechmount_featured_image('themetechmount-img-team-member')); ?>
			<div class="themetechmount-overlay">
               <a href="<?php echo get_permalink(); ?>"><i class="tm-acadevo-icon-plus-1"></i></a>
            </div>
		</div>	
		<div class="themetechmount-box-content">
			<div class="themetechmount-box-inner">				
				<?php $designation = themetechmount_get_meta( 'themetechmount_details_line_positions', 'tm_team_info' , 'team_details_line_position' ); ?>
				<div class="themetechmount-team-position"><?php echo themetechmount_get_meta( 'themetechmount_team_member_details', 'tm_team_info' , 'team_details_line_position' ); ?></div>	
				<?php echo themetechmount_box_title(); ?>	
				<div class="tm-team-details-wrapper">
					<?php $phoneno = themetechmount_get_meta( 'themetechmount_team_member_details', 'tm_team_info' , 'team_details_line_phone' );
						if( !empty($phoneno) ){ ?>
							<i class="tm-acadevo-icon-phone"></i> <?php echo esc_attr($phoneno); ?>
						<?php } ?>
				</div>
				<?php echo themetechmount_box_instructor_social_links(); ?>				
			</div>
		</div>	
	</div>
</article>
 