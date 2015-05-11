<?php

	if(!isset($_GET["goto"]) || $_GET["goto"] == "main"){
		$homeActive = 'active';
	}
	elseif($_GET["goto"] == "add-search" || $_GET["goto"] == "manage-search" || $_GET["goto"] == "load-search"){
		$searchActive = "active";
	}
	
?>
<div class="row">
    <img alt="banner" src="<?php echo $hwctInfo["dir-url"]."/images/logo.png"; ?>" />
</div><!--End of row -->
<div class="row">
<nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">Wall Harvesting Optimizer</a>
    </div><!--End of navigation header -->
    
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="<?php echo $homeActive; ?>"><a href="<?php echo $hwctInfo["plugin-admin-url"]."&goto=main"; ?>">Home</a></li>
          <li class="<?php echo $searchActive; ?> dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Search <b class="caret"></b></a>
            <ul class="dropdown-menu">
            	<li><a href="<?php echo $hwctInfo["plugin-admin-url"]."&goto=add-search"; ?>">Add Search</a></li>
                <li><a href="<?php echo $hwctInfo["plugin-admin-url"]."&goto=manage-search"; ?>">Manage Search</a></li>
            </ul>
          </li>
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