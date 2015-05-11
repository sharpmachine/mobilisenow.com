<?php

	if($hwextproOptions["hwextpro-fb-app-id"] && $hwextproOptions["hwextpro-fb-app-scrt"]){
		if(!$fbUser){
			update_option("hwextpro_rdUrl", $hwextproInfo["plugin-admin-url"]."&goto=".$_GET["goto"]);
			header('location: '.$loginUrl);
			exit;
		}
	}
	else{
		errorOccurred($hwextproInfo["plugin-admin-url"]."&goto=main", "Please enter Facebook App Details");
	}
	
	//Unset Session
	unset($_SESSION["start-from"]);
	unset($_SESSION["up-to"]);
	unset($_SESSION["steps"]);
	unset($_SESSION["mail-created"]);
				
	if(isset($_GET["file"])){
		$fileData = $wpdb->get_row('SELECT * FROM `'.$hwextproInfo["files-table"].'` WHERE `fid`='.base64_decode($_GET["file"]), ARRAY_A);
		if($fileData && !empty($fileData)){
			?>
            <div class="page-header">
                <h1>Step 3:</h1>
                <p class="text-info">Now click on the button below to start collecting data for <strong>&quot;<?php echo $fileData["file_name"]; ?>&quot;</strong></p>
            </div><!--End of page header -->
            
            <div class="row" style="margin-bottom:40px;">
                <div class="form-group">
                    <label for="" class="col-lg-1 control-label">Extract</label>
                </div><!--End of form group -->
                
                <div class="form-group">
                    <label for="" class="col-lg-1 control-label"></label>
                    <div class="col-lg-2">
                    	<div class="checkbox"><label><input class="searchFields" type="checkbox" value="id" />Id</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" value="name" />Name</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" name="search-fields" value="first_name" />First Name</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" name="search-fields" value="last_name" />Last Name</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" name="search-fields" value="link" />Link</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" value="username" />Email</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" name="search-fields" value="gender" />Gender</label></div>
                        <div class="checkbox"><label><input class="searchFields" type="checkbox" name="search-fields" value="locale" />Locale</label></div>
                    </div>
                </div><!--End of form group -->
            </div><!--End of row -->
            
            <div class="row">
            	<div class="col-lg-offset-4 col-lg-3">
                	<a id="extract" class="btn btn-primary btn-lg btn-block" href="javascript:void(0)" data-file="<?php echo $fileData["fid"]; ?>" data-from="file" data-loading-text="Extracting Data...">Extract Data</a>
                    <a id="download" style="display:none;" class="btn btn-success btn-lg btn-block" href="javascript:void(0)" data-file="<?php echo $fileData["fid"]; ?>" data-from="file">Download</a>
                </div>
            </div><!--End of row -->

            <div class="row">
                <div class="progress progress-striped active" style="margin-top:20px; display:none;" id="status">
                    <div class="progress-bar" role="progressbar">
                        <span class="sr-only"></span>
                    </div>
                </div><!--End of progress -->
            </div><!--End of row -->
            <?php
		}
		else{
			echo '<h4>No file found with this name. Please try another</h4>';
			return;
		}
	}
?>