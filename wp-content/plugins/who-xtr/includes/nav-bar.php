<?php

	if(!isset($_GET["goto"]) || $_GET["goto"] == "main"){
		$homeActive = 'active';
	}
	elseif($_GET["goto"] == "upload"){
		$uploadActive = "active";
	}
	elseif($_GET["goto"] == "manage-files"){
		$uploadedActive = "active";
	}
	elseif($_GET["goto"] == "settings"){
		$setActive = "active";
	}
	
?>
<div class="row" style="margin-top:10px;">
	<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Warning: </strong>This tool is extremely powerful and Fb will limit your use if you over abuse this service. Over use has resulted in accounts being banned so please use this wisely and not use this tool full time. We recommend a maximum of 50,000 extractions every few days but it is obviously up to you. We have warned you.</div>
</div><!--End of row -->
<div class="row" style="margin-top:10px;">
    <img class="img-responsive" alt="banner" src="<?php echo $hwextproInfo["dir-url"]."/images/logo.png"; ?>" />
</div><!--End of row -->
<div class="row">
<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">WHO XTR</a>
    </div><!--End of navigation header -->
    
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="<?php echo $homeActive; ?>"><a href="<?php echo $hwextproInfo["plugin-admin-url"]."&goto=main"; ?>">Home</a></li>
          <li class="<?php echo $uploadActive; ?>"><a href="<?php echo $hwextproInfo["plugin-admin-url"]."&goto=upload"; ?>">Upload</a></li>
          <li class="<?php echo $uploadedActive; ?>"><a href="<?php echo $hwextproInfo["plugin-admin-url"]."&goto=manage-files"; ?>">Manage Uploads</a></li>
          <li class="<?php echo $setActive; ?>"><a href="<?php echo $hwextproInfo["plugin-admin-url"]."&goto=settings"; ?>">Settings</a></li>
        </ul>
    </div><!--End of navbar collapse -->
</nav>
</div><!--End of row -->
<?php
if(isset($_SESSION["error"]) && $_SESSION["error"] == 1){
	echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$_SESSION["error-message"].'</div>';
	unset($_SESSION["error"]);
	unset($_SESSION["error-message"]);
	unset($_SESSION["no-page"]);
}

if(isset($_SESSION["success"]) && $_SESSION["success"] == 1){
	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$_SESSION["success-message"].'</div>';
	unset($_SESSION["success"]);
	unset($_SESSION["success-message"]);
}

?>