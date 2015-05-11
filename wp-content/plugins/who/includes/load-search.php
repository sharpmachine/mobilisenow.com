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
	
	$lsid = trim($_GET["ctsh"]);
	if(!isset($lsid) && empty($lsid)){
		return;
	}
	
	$serah_result = $wpdb->get_row('SELECT '.$hwctInfo["groups-table"].'.*, '.$hwctInfo["pages-table"].'.*, '.$hwctInfo["search-table"].'.* FROM '.$hwctInfo["groups-table"].', '.$hwctInfo["pages-table"].', '.$hwctInfo["search-table"].' WHERE '.$hwctInfo["groups-table"].'.sid='.$lsid.' AND '.$hwctInfo["pages-table"].'.sid='.$lsid.' AND '.$hwctInfo["search-table"].'.sid='.$lsid, ARRAY_A);
	
	if(!$serah_result || empty($serah_result)){
		echo '<div class="page-header"><h1>No data found with this keyword</h1></div><!--End of page header -->';
		return;
	}
	update_option("hwct_last_search_id", $lsid);
	
	//Resume Search
	if($serah_result["status"] == "cont"){
		echo '<script type="text/javascript">jQuery(document).ready(function($){statusUpdates("cont", $);});</script>';
	}
?>
<div class="page-header">
	<h1>Search Results</h1>
</div><!--End of page header -->
<div class="row">
    <dl class="dl-horizontal">
    	<?php
			$fileName = str_replace(" ","-",$serah_result["keywords"])."-".$serah_result["sid"]."-cron.php";
			echo '<dt>Cron Job Path : </dt>'.'<dd><code>/usr/bin/php '.$hwctInfo["dir-path"].'cron/'.$fileName.'</code></dd>';
			echo '<dt>Executable Path : </dt>'.'<dd><code>'.$hwctInfo["dir-url"].'cron/'.$fileName.'</code></dd>';
		?>
    </dl>
</div><!--End of row -->
<div class="row">
	<div class="col-lg-offset-4 col-lg-3" id="fetchCntrl">
	<?php
	if($serah_result["status"] == "new"){
		echo '<button id="startFetching" style="width: 250px; margin: 0px auto 30px;" type="button" class="btn btn-primary btn-lg btn-block" data-loading-text="Fetching data...">Start Fetching</button>';
	}
	else{
		echo '<a href="'.$hwctInfo["dir-url"]."includes/download-data.php".'" class="btn btn-primary btn-lg btn-block" style="width: 250px; margin: 0px auto 30px;">Download</a>';
	}
?>
	</div>
</div><!--End of row -->
<div class="row" id="searchProg">
	<?php
		$buttons = "&nbsp;";
        $searchDetails = '<p>Keywords: '.$serah_result["keywords"].'</p>';
        $searchDetails .= '<p>Total User\'s Fetched: '.$serah_result["total_users"].'</p>';
        switch($serah_result["status"]){
            case "cont":
                $searchDetails .= '<p class="text-success">Status: Continue</p>';
				$buttons = '
				<div class="btn-group">
					<button id="pauseSearch" type="button" class="btn btn-default">Pause</button>
					<button id="resumeSearch" type="button" class="btn btn-default" disabled="disabled">Resume</button>	
					<button id="stopSearch" type="button" class="btn btn-default">Stop</button>
				</div>';
                break;
            case "pause":
                $searchDetails .= '<p class="text-muted">Status: Pause</p>';
				$buttons = '
				<div class="btn-group">
					<button id="pauseSearch" type="button" class="btn btn-default" disabled="disabled">Pause</button>
					<button id="resumeSearch" type="button" class="btn btn-default">Resume</button>	
					<button id="stopSearch" type="button" class="btn btn-default">Stop</button>
				</div>';
                break;
            case "stop":
                $searchDetails .= '<p class="text-danger">Status: Stop</p>';
                break;
        }
        
		if($serah_result["currently_fetching_from"] == "stup"){
			$currFetcfrm = "Status Updates";
		}
		else{
			$currFetcfrm = $serah_result["currently_fetching_from"];
		}
		
        $searchDetails .= '<div id="inProg"><p>Currently fetching from: '.$currFetcfrm.'</p>';
        
        switch($serah_result["currently_fetching_from"]){
            case "groups":
                try{
                    $currData = $facebook->api($serah_result["current_group"], "GET", array("access_token"=>get_option("hwct_token")));
                }
                catch(Exception $e){
                }
                $searchDetails .= '<div>Group in progress: <a target="_blank" href="http://www.facebook.com/'.$serah_result["current_group"].'">'.$currData["name"].'</a></div>';
                break;
            case "pages":
                try{
                    $currData = $facebook->api($serah_result["current_page"], "GET", array("access_token"=>get_option("hwct_token")));
                }
                catch(Exception $e){
                }
                $searchDetails .= '<div>Page in progress: <a target="_blank" href="'.$currData["link"].'">'.$currData["name"].'</a></div>';
                break;
            case "status-updates":
                $searchDetails .= '<p>Staus Updates in progress</p>';
                break;
        }
        
        $searchDetails .= '</div><!--End of in Prog -->';
		printArray($searchDetails);
        ?>
</div>
<?php
	echo '<div class="col-lg-offset-4 col-lg-3" id="btnContl" style="text-align:center">'.$buttons.'</div>';
?>