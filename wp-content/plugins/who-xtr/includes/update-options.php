<?php
	
	#-----------------------------------------------------------------
	# Save Facebook App Details
	#-----------------------------------------------------------------
	if( isset($_POST["action"]) && $_POST["action"] == base64_encode("save-fb-details") ){
		$error = 0;
		if(ltrim(rtrim($_POST["hwextpro-fb-app-id"])) == ""){
			$error = 'Please Enter your Facebook App ID';
		}
	
		if(ltrim(rtrim($_POST["hwextpro-fb-app-scrt"])) == ""){
			$error .= ($error) ? " and Facebook App Secret" : "Please Enter your Facebook App Secret";
			$error = ltrim($error, "0");
		}
		
		if($error){
			errorOccurred($hwextproInfo["plugin-admin-url"], $error);
		}
		
		add_hwextpro_options($_POST);
		succeed($hwextproInfo["plugin-admin-url"]."&goto=upload", "Facebook App details saved successfully");
	}
	
	
	#-----------------------------------------------------------------
	# Upload Text File
	#-----------------------------------------------------------------
	if( isset($_POST["action"]) && $_POST["action"] == base64_encode("upload-txt-file") ){
		$path = $hwextproInfo["wp_upload_dir"]["path"]."/";
		$name = str_replace(" ","-",$_FILES['hwextpro-txt-file']['name']);
		$tmp = $_FILES['hwextpro-txt-file']['tmp_name'];
		$type = $_FILES['hwextpro-txt-file']['type'];
		
		$valid_formats = array("txt", "TXT");
		list($old_name, $ext) = explode(".", $name);
		$name = "whoxtr-".$old_name."-".time().".".$ext;
		
		if($type == "text/plain" || in_array($ext,$valid_formats) ){
			if(move_uploaded_file($tmp, $path.$name)){
				$wpdb->insert(
					$hwextproInfo["files-table"],
					array(
						'file_name' => $name,
						'title' => $_POST["hwextpro-file-title"],
						'file_path' => $hwextproInfo["wp_upload_dir"]["path"]."/",
						'file_url' => $hwextproInfo["wp_upload_dir"]["url"]."/"
					),
					array("%s", "%s")
				);
				succeed($hwextproInfo["plugin-admin-url"]."&goto=manage-files", "File has been uploaded successfully");
			}
			else{
				errorOccurred($hwextproInfo["plugin-admin-url"]."&goto=upload", "File transfer failed");
			}
		}
		else{
			errorOccurred($hwextproInfo["plugin-admin-url"]."&goto=upload", "Please upload a valid text file");
		}
	}
	
	#-----------------------------------------------------------------
	# Delete File
	#-----------------------------------------------------------------
	if( isset($_GET["action"]) && $_GET["action"] == base64_encode("delete-file") ){
		$file = $wpdb->get_row('SELECT * FROM `'.$hwextproInfo["files-table"].'` WHERE `fid`='.base64_decode($_GET["file"]), ARRAY_A);
		if($file && !empty($file)){
			$wpdb->query(
				$wpdb->prepare('
					DELETE FROM `'.$hwextproInfo["files-table"].'` WHERE fid = %d
				',$file["fid"])
			);
			
			$upldFile = $file["file_path"].$file["file_name"];
			$txtFile = $file["file_path"].str_replace(".","_emails.",$file["file_name"]);
			$csvfile = $file["file_path"].str_replace(".txt","_emails.csv",$file["file_name"]);
			
			if(file_exists($upldFile)){
				unlink($upldFile);
			}
			
			if(file_exists($txtFile)){
				unlink($txtFile);
			}
			
			if(file_exists($csvfile)){
				unlink($csvfile);
			}
			
			succeed($hwextproInfo["plugin-admin-url"]."&goto=manage-files", "File deleted successfully");
		}
		else{
			errorOccurred($hwextproInfo["plugin-admin-url"]."&goto=manage-files", "File not found with this name");
		}
	}
	
	#-----------------------------------------------------------------
	# Save Plugin Settings
	#-----------------------------------------------------------------
	if( isset($_POST["action"]) && $_POST["action"] == base64_encode("save-hwct-settings") ){
		add_hwextpro_options($_POST);
		succeed($hwextproInfo["plugin-admin-url"]."&goto=settings", "Settings saved successfully");
	}
	
	
	#-----------------------------------------------------------------
	# Get all Details
	#-----------------------------------------------------------------
	$hwextproOptions = get_option("hwextpro_options");
	if(!$hwextproOptions || (!$hwextproOptions["hwextpro-fb-app-id"] && !$hwextproOptions["hwextpro-fb-app-scrt"]) ){
		$hwctOptions = get_option("hwct_options");
		$opt = array(
			"hwextpro-fb-app-id" => $hwctOptions["hwct-fb-app-id"],
			"hwextpro-fb-app-scrt" => $hwctOptions["hwct-fb-app-scrt"]
		);
		add_hwextpro_options($opt);
	}
	
	$hwextproOptions = get_option("hwextpro_options");
?>