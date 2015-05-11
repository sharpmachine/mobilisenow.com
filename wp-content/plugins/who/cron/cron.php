<?php session_start(); ob_start(); ?>
<style type="text/css">
pre {
    background-color: #F5F5F5;
    border: 1px solid #CCCCCC;
    border-radius: 4px;
    color: #333333;
    display: block;
    font-size: 13px;
    line-height: 1.42857;
    margin: 0 0 10px;
    padding: 9.5px;
    word-break: break-all;
    word-wrap: break-word;
}

.container{
}

a {
    color: #428BCA;
    text-decoration: none;
}

</style>
<div class="container">
<?php
	function hwct_post_request($path, $postOpt){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $path."ajax-actions.php");
		curl_setopt($ch,CURLOPT_POST, count($postOpt));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $postOpt);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data, true);
	}
	
	global $wpdb, $hwctInfo;
	$lsid = SEARCH_ID;
	$searchData = $wpdb->get_row('SELECT * FROM `'.$hwctInfo["search-table"].'` WHERE sid='.$lsid, ARRAY_A);
	
	//Chnage status
	if($searchData["status"] == "new"){
		$wpdb->update(
			$hwctInfo["search-table"], 
			array(
				'status' => "cont"
			), 
			array('sid' => $lsid), 
			array('%s'), 
			array('%d') 
		);
	}
	
	$searchData = $wpdb->get_row('SELECT * FROM `'.$hwctInfo["search-table"].'` WHERE sid='.$lsid, ARRAY_A);
	
	if($searchData && $searchData["status"] == "cont"){
		$searchResult = hwct_post_request($hwctInfo["dir-url"],array("hwct_last_search_id" => $lsid, "hwct_load"=> "save-status-updates"));
		if($searchResult["action"] == "cont"){
			echo $searchResult["progData"];
		}
		elseif($searchResult["action"] == "stop"){
			printArray($searchResult["error"]);
		}
		else{
			printArray("Some error occurred while executing campaign");
		}
	}
	else{
		printArray("Search might be stopped or paused");
		exit;
	}
?>
</div>