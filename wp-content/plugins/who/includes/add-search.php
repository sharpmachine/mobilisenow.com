<?php
	if($hwctOptions["hwct-fb-app-id"] && $hwctOptions["hwct-fb-app-scrt"]){
		if(!$fbUser){
			update_option("hwct_rdUrl", $hwctInfo["plugin-admin-url"]."&goto=".$_GET["goto"]);
			header('location: '.$loginUrl);
			exit;
		}
	}
	else{
		errorOccurred($hwctInfo["plugin-admin-url"]."&goto=main", "Please enter Facebook App Details");
	}
	
?>

<div class="page-header">
	<h1>Search User's</h1>
</div><!--End of page header -->
<form class="form-horizontal" role="" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
    <div class="form-group">
        <label for="" class="col-lg-2 control-label">Keywords</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="query" placeholder="Enter keywords here to search" value="" />
            <span class="help-block" id="search_prog"></span>
        </div>
    </div><!--End of form group -->

    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-3">
        	<input type="hidden" name="search-options[]" value="stup" />
            <input type="hidden" name="action" value="<?php echo base64_encode("save-search-details"); ?>" />
        </div>
    </div><!--End of form group -->
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-3" id="searchDetails"><input id="save_search" type="submit" class="btn btn-primary btn-lg btn-block" value="Next Step" /></div>
    </div><!--End of form group -->
</form>