<?php
	
	#-----------------------------------------------------------------
	# Save Facebook App Details
	#-----------------------------------------------------------------
	if( isset($_POST["action"]) && $_POST["action"] == base64_encode("save-fb-details") ){
		$error = 0;
		if(ltrim(rtrim($_POST["hwct-fb-app-id"])) == ""){
			$error = 'Please Enter your Facebook App ID';
		}
	
		if(ltrim(rtrim($_POST["hwct-fb-app-scrt"])) == ""){
			$error .= ($error) ? " and Facebook App Secret" : "Please Enter your Facebook App Secret";
			$error = ltrim($error, "0");
		}
		
		if($error){
			errorOccurred($hwctInfo["plugin-admin-url"], $error);
		}
		
		add_hwct_options($_POST);
		succeed($hwctInfo["plugin-admin-url"], "Facebook App details saved successfully");
	}
	
	#-----------------------------------------------------------------
	# Save Search Details
	#-----------------------------------------------------------------
	if( isset($_POST["action"]) && $_POST["action"] == base64_encode("save-search-details") ){
		$keywords = ltrim(rtrim($_POST["query"]));
		$searchIn = $_POST["search-options"];
		if(!isset($keywords) || empty($keywords) || !isset($searchIn) || empty($searchIn) ){
			errorOccurred($hwctInfo["plugin-admin-url"]."&goto=add-search", "Keywords or search options are missing");
		}
		
		//Insert Data into search table
		$wpdb->insert($hwctInfo["search-table"], 
			array(
				"keywords" => urlencode($keywords),
				"search_in" => serialize($searchIn),
				"start_time" => date("F j, Y, g:i a")
			),
			array(
				"%s","%s","%s"
			)
		);
		$lsid = $wpdb->insert_id;
		update_option("hwct_last_search_id", $lsid);
		
		//Insert data into groups table
		$wpdb->insert(
			$hwctInfo["groups-table"],
			array(
				'sid' => $lsid,
				'total_groups' => serialize(rtrim($_POST["grp-sel-ids"],','))
			),
			array("%d", "%s")
		);
		
		//Insert data into pages table
		$wpdb->insert(
			$hwctInfo["pages-table"],
			array(
				'sid' => $lsid,
				'total_pages' => serialize(rtrim($_POST["pg-sel-ids"],','))
			),
			array("%d", "%s")
		);
		
		//Insert data into status updates table
		$wpdb->insert($hwctInfo["status-updates-table"],array('sid' => $lsid),array("%d"));
		
		
		
		//Create Text file for fetching id's
		$fileName = "who-".str_replace(" ","-",$keywords)."-".$lsid.".txt";
		$fileHandler = fopen($hwctInfo["wp_upload_dir"]["path"]."/".$fileName, 'w');
		if($fileHandler){
			fwrite($fileHandler, "");
			fclose($fileHandler);
			$wpdb->update(
				$hwctInfo["search-table"], 
				array(
					'file_name' => $fileName,
					'file_path' => $hwctInfo["wp_upload_dir"]["path"]."/",
					'file_url' => $hwctInfo["wp_upload_dir"]["url"]."/",
				), 
				array('sid' => $lsid), 
				array('%s', '%s', '%s'), 
				array('%d') 
			);
		}
		
		//insert data into Files table if exists
		if($wpdb->get_var("SHOW TABLES LIKE '".$hwextproInfo["files-table"]."'")){
			$wpdb->insert(
				$hwextproInfo["files-table"],
				array(
					'sid' => $lsid,
					'file_name' => $fileName,
					'file_path' => $hwctInfo["wp_upload_dir"]["path"]."/",
					'file_url' => $hwctInfo["wp_upload_dir"]["url"]."/",
				),
				array("%d", "%s", '%s', '%s')
			);
		}
		
		//Create PHP File for cron jobs
		$fileName = str_replace(" ","-",$keywords)."-".$lsid."-cron.php";
		$fileHandler = fopen($hwctInfo["dir-path"]."cron/".$fileName, 'w');
		if($fileHandler){
			$data = hwct_get_file_data($keywords,$lsid);
			fwrite($fileHandler, $data);
		}
		fclose($fileHandler);
		succeed($hwctInfo["plugin-admin-url"]."&goto=manage-search", "Search details saved successfully");
	}
	
	#-----------------------------------------------------------------
	# Delete Search Details
	#-----------------------------------------------------------------
	if( isset($_GET["action"]) && $_GET["action"] == base64_encode("rsfl") ){
		$srid = $_GET["srid"];
		deleteSearchDetails($srid);
		succeed($hwctInfo["plugin-admin-url"]."&goto=manage-search", "Search details deleted successfully");
	}
	
	
	#-----------------------------------------------------------------
	# Get all Details
	#-----------------------------------------------------------------
	$hwctOptions = get_option("hwct_options");
?>