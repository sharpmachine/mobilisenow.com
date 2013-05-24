<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h2 class="post-title"><?php the_title(); ?></h2>
			<?php the_content(__('More','ndesignthemes')); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','ndesignthemes').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

	<?php endwhile; endif; ?>
	
	<?php edit_post_link(__('Edit this entry.','ndesignthemes'), '<p>', '</p>'); ?>


		<!--/post -->

	</div>
	<!--/content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>