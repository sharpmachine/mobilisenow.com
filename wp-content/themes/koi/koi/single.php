<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post">
			<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p class="post-date"><span class="day"><?php the_time(__('d','ndesignthemes')) ?></span> <span class="month"><?php the_time(__('M','ndesignthemes')) ?></span> <span class="year"><?php the_time(__('Y','ndesignthemes')) ?></span> <span class="postcomment"><?php comments_popup_link(__('No Comments','ndesignthemes'), __('1 Comment','ndesignthemes'), __('% Comments','ndesignthemes')); ?></span></p>
			<p class="post-data"><span class="postauthor">by <?php the_author_link(); ?></span><span class="postcategory">in <?php the_category(', ') ?></span> <?php the_tags( '<span class="posttag">Tags: ', ', ', '</span>'); ?> <?php edit_post_link(__('[Edit]','ndesignthemes')); ?></p>
			<?php the_content(__('More','ndesignthemes')); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','ndesignthemes').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<p class="post-nav"><span class="previous"><?php previous_post_link(__('<em>Previous</em> %link','ndesignthemes')) ?></span> <span class="next"><?php next_post_link(__('<em>Next</em> %link','ndesignthemes')) ?></span></p>

	<?php comments_template(); ?>

		</div>
		<!--/post -->

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>


	</div>
	<!--/content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


		

