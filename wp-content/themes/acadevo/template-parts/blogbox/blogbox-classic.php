<article <?php themetechmount_sanitize_html_classes( post_class( themetechmount_blog_classic_extra_class() )); ?>>
	<div class="tm-featured-outer-wrapper tm-post-featured-outer-wrapper">
		 <?php echo themetechmount_get_featured_media( '', 'themetechmount-img-blog' ); // Featured content ?>
		<div class="tm-box-post-date">
			<?php themetechmount_entry_date(); ?>
		</div>
	</div>
	<div class="tm-blog-classic-box-content">
		<div class="tm-post-entry-header">
			<?php if( 'quote' != get_post_format() ) : ?>
				<?php echo acadevo_entry_meta('blogclassic');  // blog post meta details ?>
			<header class="entry-header">
				<?php if( !is_single() ) : ?>
					<?php if( 'quote' != get_post_format() && 'link' != get_post_format() ) : ?>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php endif; ?>
				<?php endif; ?>				
			</header><!-- .entry-header -->
		</div>
		<div class="entry-content">
			<div class="themetechmount-box-desc-text">
				<?php the_content( '' ); ?>
			</div>
			<div class="themetechmount-blogbox-desc-footer">
				<div class="themetechmount-blogbox-footer-readmore">
					<?php echo themetechmount_blogbox_readmore(); ?>
				</div>
			</div>
			<div class="clear clr"></div>		
			<?php
			// pagination if any
			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_attr__( 'Pages:', 'acadevo' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
	</div>
	<?php endif; ?>
</article>