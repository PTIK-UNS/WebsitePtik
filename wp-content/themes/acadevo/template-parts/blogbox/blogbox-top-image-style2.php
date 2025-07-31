<article class="themetechmount-box themetechmount-box-blog themetechmount-box-topimage tm-box-style2 themetechmount-blogbox-format-<?php echo get_post_format() ?> <?php echo themetechmount_sanitize_html_classes(themetechmount_post_class()); ?>">
	<div class="post-item">
		<div class="themetechmount-box-content">	

			<div class="tm-featured-outer-wrapper tm-post-featured-outer-wrapper">
				<div class="tm-box-postdate">
						<?php
			// Date
	
			$date_format =  themetechmount_get_option('blogbox_meta_dateformat'); ?>
			<span class="tm-meta-line posted-on">
				<span class="screen-reader-text tm-hide"><?php echo esc_attr_x( 'Posted on', 'Used before publish date.', 'acadevo' ); ?> </span>		
				<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date($date_format); ?></time>				
				<time class="updated tm-hide" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo get_the_modified_date($date_format); ?></time>
			</span>
				</div>
				<?php echo themetechmount_get_featured_media( '', 'themetechmount-img-blog-top' ); // Featured content ?>
				
			</div>		
			<div class="themetechmount-box-desc">
				<div class="entry-header">
					<?php echo acadevo_entry_meta(); ?>
					<?php echo themetechmount_box_title(); ?>
				</div>		
			   		<div class="themetechmount-box-desc-text"><?php echo themetechmount_blogbox_description(); ?></div>
			</div>
        </div>
	</div>
</article>
