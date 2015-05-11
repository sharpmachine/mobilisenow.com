<script type="text/javascript">
	var pluginUrl = "<?php echo $hwextproInfo["dir-url"]; ?>";
</script>
<style type="text/css">.preload, .preload body {overflow:hidden;}</style>
<?php
	include("header.php");
	
	wp_enqueue_style('hwextpro-bootstrap');
	wp_enqueue_style('hwextpro-style');
	wp_enqueue_style("hwextpro-jquery-ui");
	
	include("ps_pagination.php");
	include("update-options.php");
	include("connect/fbmain.php");
	include("nav-bar.php");
	
	if( isset($_GET['goto']) ){
		$page = $_GET['goto'].".php";
		$includePath = $hwextproInfo["dir-path"]."includes/";
		if(file_exists($includePath.$page) ){
			include_once($includePath.$page);
		}
		else{
			echo '<div class="jumbotron"><h1>No Page Found</h1></div>';
		}
	} 
	else{
		include("main.php"); 
	}
		
		
	include("footer.php");
	
	wp_enqueue_script("hwextpro-bootstrap");
	wp_enqueue_script("jquery-ui-slider");
	wp_enqueue_script("hwextpro-js-functions");
	wp_enqueue_script("hwextpro-js");
	
?>