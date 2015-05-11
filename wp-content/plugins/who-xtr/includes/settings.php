<?php
	$hwextproRdUrl = get_option("hwextpro_rdUrl");
	if($hwextproOptions["hwextpro-fb-app-id"] && $hwextproOptions["hwextpro-fb-app-scrt"]){
		if(!$fbUser){
			header('location: '.$loginUrl);
			exit;
		}
		elseif( isset($_GET["code"]) && isset($hwextproRdUrl) && !empty($hwextproRdUrl) ){
			delete_option("hwextpro_rdUrl");
			header('location: '.$hwextproRdUrl);
			exit;
		}
	}
	else{
		errorOccurred($hwextproInfo["plugin-admin-url"]."&goto=main", "Please enter Facebook App Details");
	}
	
	$reqAmount = ($hwextproOptions["req-amount"] && !empty($hwextproOptions["req-amount"])) ? $hwextproOptions["req-amount"] : 500;
	
?>
<div class="page-header">
	<h1>Plugin Settings</h1>
</div><!--End of page header -->
<form class="form-horizontal" role="" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
	<div class="form-group">
        <label for="" class="col-lg-4 control-label">uids executed per request from facebook</label>
        <div class="col-lg-6">
        	<div id="slider"></div>
            <p class="help-block"><span class="text-info"><?php echo $reqAmount; ?> Requests</span></p>
        </div>
    </div><!--End of form group -->
    <div class="form-group">
    	<label for="" class="col-lg-4 control-label"></label>
        <div class="col-lg-offset-6 col-lg-1">
        	<input type="hidden" name="action" value="<?php echo base64_encode("save-hwct-settings"); ?>" />
        	<input type="hidden" id="reqAmount" name="req-amount" value="<?php echo $reqAmount; ?>" />
            <input type="submit" class="btn btn-primary" value="Save" />
        </div>
    </div><!--End of form group -->
</form>