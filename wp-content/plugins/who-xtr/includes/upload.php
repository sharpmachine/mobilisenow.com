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
	
?>
<div class="page-header">
	<h1>Step 1:</h1>
    <p class="text-info">Please upload the txt file you generated in the waycool tool to get the facebook emails</p>
</div><!--End of page header -->
<form class="form-horizontal" role="" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="" class="col-lg-2 control-label">Upload file</label>
        <div class="col-lg-8">
            <input name="hwextpro-txt-file" type="file" id="upload_file">
            <span class="help-block">Please select a file to upload</span>
        </div>
    </div><!--End of form group -->
    
    <div class="form-group">
        <label for="" class="col-lg-2 control-label">Title</label>
        <div class="col-xs-5">
            <input type="text" name="hwextpro-file-title" value="" class="form-control input-sm" placeholder="File title" />
        </div>
    </div><!--End of form group -->
    
    <div class="form-group">
        <div class="col-lg-offset-6 col-lg-1">
        	<input type="hidden" name="action" value="<?php echo base64_encode("upload-txt-file"); ?>" />
            <input type="submit" class="btn btn-primary" value="Upload" />
        </div>
    </div><!--End of form group -->
</form>