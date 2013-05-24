<div id="footer">



	<div class="footer1">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>



			<h4><?php _e('Recent Posts','ndesignthemes'); ?></h4>

			<?php query_posts('showposts=5'); ?>

			<ul>

			<?php while (have_posts()) : the_post(); ?>

				<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <em>(<?php the_time('M d') ?>)</em></li>

			<?php endwhile;?>

			</ul>



		<?php endif; ?>

	</div>

	

	<div class="footer2">



		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>



			<h4><?php _e('Recent Comments','ndesignthemes'); ?></h4>

			<?php include (TEMPLATEPATH . '/recent-comments.php'); ?>



		<?php endif; ?>

	</div>

	

	<div class="footer3">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>



			<h4><?php _e('Connect With Us','ndesignthemes'); ?></h4>

	

<?php 

	$theme_opts = get_option('theme_opts');

	

	if ( !$theme_opts['social_off'] ) include (TEMPLATEPATH . "/socialmedia.php"); ?>



		<?php endif; ?>



	</div>

	

	<p class="credits">&copy; <a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a> <?php echo date('Y') ?> <span>&bull;</span> Powered by <a href="http://wordpress.org">WordPress</a> <span>&bull;</span> 

	<a href="http://icondock.com">Icons</a> &amp; <a href="http://www.ndesign-studio.com/wp-themes">Wordpress Theme</a> by <a href="http://www.ndesign-studio.com">N.Design</a></p>

</div>

<!--/footer -->



</div>

<!--/wrapper -->

<?php wp_footer(); ?>

<script type="text/javascript" src="http://www.mobilisenow.com/formvalidation.js"></script>

</body>

</html>

