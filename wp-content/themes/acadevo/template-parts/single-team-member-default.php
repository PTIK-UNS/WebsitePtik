<?php
/*
 *
 *  Single Team member - Default
 *
 */

?>

<div class="tm-team-member-single-content-wrapper tm-team-member-view-default">
	<div class="tm-team-member-single-content row">
			<div class="themetechmount-team-member-single-featured-area col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="themetechmount-team-img">
					<?php echo themetechmount_get_featured_media(); ?>					
				</div>
				<div class="thememount-team-data">
					<h3 class="tm-team-member-single-title"><?php the_title(); ?></h3>
					<div class="tm-team-member-single-category"><?php echo themetechmount_wp_kses( themetechmount_team_member_single_meta( 'position' ) ); ?></div>
				</div>
				<div class="thememount-team-extra-data">
					<h5 class="tm-team-member-personal-detail">Personal Info</h5>
					<?php echo themetechmount_wp_kses( themetechmount_team_member_meta_details() ); ?>				
					<?php echo themetechmount_team_member_extra_details(); ?>
					<div class="clear clr"></div>
					<?php echo themetechmount_wp_kses( themetechmount_box_team_social_links(), 'box_team_social_links' ); ?>
				</div>
			</div><!-- .themetechmount-team-member-single-featured-area -->
			<div class="themetechmount-team-member-single-content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="tm-team-member-content">
					<?php echo themetechmount_team_member_content(); ?>
				</div>
			</div><!-- .themetechmount-team-member-single-content-area -->		
	</div>
</div>

<?php edit_post_link( esc_attr__( 'Edit', 'acadevo' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>