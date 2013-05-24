<?
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>



	<div id="content">



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



			<h2 class="post-title"><?php the_title(); ?></h2>

			<?php the_content(__('More','ndesignthemes')); ?>

			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','ndesignthemes').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>



	<?php endwhile; endif; ?>

	

	<?php edit_post_link(__('Edit this entry.','ndesignthemes'), '<p>', '</p>'); ?>





		<!--/post -->
    <form class="contact" action="http://www.mobilisenow.com/formmail.php" method="post">
    <label>Name:</label>
    <input name="Name" type="text" id="Name" />
    <br />
    <label>Phone:</label>
    <input name="Phone" type="text" id="Phone"/>
    <br />
    <label>Email:</label>
    <input name="Email" type="text" id="Email"/>
    <br />
    <label>Subject:</label>
    <select name="Subject">
      <option value="Schools">Schools</option>
      <option value="Kingdom Projects">Kingdom Projects</option>
      <option value="Events">Events</option>
      <option value="Resources">Resources</option>
      <option value="Giving">Giving</option>
      <option value="Blog">Blog</option>
      <option value="Prayer Request">Prayer Request</option>
      <option value="Booking">Booking</option>
      <option value="Testimony">Testimony</option>
      <option value="Other">Other</option>
    </select>
    <br />
    <label>Message:</label>
    <textarea name="Message" cols="" rows="" id="Message"></textarea>
    <br />
    
    <input type="hidden" name="subject" value="Contact Us Submission" />
    <input type="hidden" name="good_url" value="thank-you" />
    <input type="hidden" name="recipients" value="info@mobilisenow.com" />
    <input name="submit" type="submit" class="send" onclick="MM_validateForm('Name','','R','Phone','','NisNum','Email','','RisEmail','Message','','R');return document.MM_returnValue" value="Send" />
    </form>


	</div>

	<!--/content -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>