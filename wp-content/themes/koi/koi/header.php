<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<!--Lord we decree that his this ministry, Mobilise Now will be a blessing to the body of Christ.  We decree that the burning and their hearts desire to see the body mobilised in the love and the power of God would be made manifest in the name of Jesus.  We speak success and wealth over this ministry, and the wisdom and understanding to steward it. Amen-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="description" content="Mobilise Now is a ministry dedicated to mobilising the body of Christ in the power of God.">

    <meta name="keywords" content="mobilise, mobilize, john alcock, heather alcock, sharp machine media, jesse kade, jesus christ, jesus, God, ministry, prayer, intercession, healing, prophesy, prophetic, holy spirit">

<title><?php if (is_home()) {

	echo bloginfo('name');

} elseif (is_404()) {

	_e('404 Not Found','ndesignthemes');

} elseif (is_category()) {

	_e('Category:','ndesignthemes'); wp_title('');

} elseif (is_tag()) {

	_e('Tag:','ndesignthemes'); wp_title('');

} elseif (is_search()) {

	_e('Search Results for:','ndesignthemes'); echo ' ' . $s;

} elseif ( is_day() || is_month() || is_year() ) {

	_e('Archives:','ndesignthemes'); wp_title('');

} else {

	echo wp_title('');

}

?></title>



<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />

<!--[if lt IE 8]><link rel="stylesheet" href="http://www.mobilisenow.com/ie.css" type="text/css" media="screen, projection"><![endif]-->



<?php if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

</head>

<body>

<div id="wrapper">

<div id="header">

	<h1 id="logo"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>

	<p class="description"><?php bloginfo('description'); ?></p>



	



	<ul id="nav">

		<li<?php if (is_home()) { echo ' class="current_home"'; }?>><a href="<?php echo get_option('home'); ?>"><?php _e('Home','ndesignthemes'); ?></a></li>

		<?php wp_list_pages('title_li=&exclude=19,20,21,29,2,3,161,165,167,272, 498, 18'); ?>

<li><a href="http://mobilisenow.com/blog">Blog</a>

<ul>

<?php wp_list_categories('orderby=name&title_li=');

$this_category = get_category($cat);

if (get_category_children($this_category->cat_ID) != "") {

echo "<ul>";

wp_list_categories('orderby=id&show_count=0&title_li=

&use_desc_for_title=1&child_of='.$this_category->cat_ID);

echo "</ul>";

}

?>



</ul>

</li>

<?php wp_list_pages('title_li=&include=2,3,161,165,167, 498'); ?>	

<?php wp_nav_menu( array('menu' => 'Main Navigation' )); ?>

</ul>



</div>

<!--/header -->