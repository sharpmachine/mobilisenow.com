<?php
	$hwctRdUrl = get_option("hwct_rdUrl");
	if($hwctOptions["hwct-fb-app-id"] && $hwctOptions["hwct-fb-app-scrt"]){
		if(!$fbUser){
			header('location: '.$loginUrl);
			exit;
		}
		elseif( isset($_GET["code"]) && isset($hwctRdUrl) && !empty($hwctRdUrl) ){
			delete_option("hwct_rdUrl");
			header('location: '.$hwctRdUrl);
			exit;
		}
	}
	else{
		errorOccurred($hwctInfo["plugin-admin-url"]."&goto=main", "Please enter Facebook App Details");
	}
	
	$query = 'SELECT * FROM `'.$hwctInfo["search-table"].'`';
	$pager = new PS_Pagination($wpdb->dbh, $query, 10, 5, "page=hw-wct&goto=manage-search");
	$searchData = $pager->paginate();
	$searchCount = $pager->offset;
	$totalSearchs = $pager->total_rows;
?>
<div class="page-header">
	<h2>Manage Search</h2>
</div><!--End of Page header -->
<div class="row">
	<table class="table table-bordered table-hover table-responsive">
        <tr>
            <th>#</th>
            <th>Keywords</th>
            <th>Total user's fetched</th>
            <th>Currently fetching from</th>
            <th>Search In</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
		if( $searchData && !empty($searchData) ){
			while($search = mysql_fetch_assoc($searchData)){
				$searchCount += 1;
				$fetchfrm = $search["currently_fetching_from"];
				if($search["currently_fetching_from"] == "stup"){
					$fetchfrm = "Status Updates";
				}
				$searchIn = implode(", ", unserialize($search["search_in"]));
				
				$searchStatus = '<strong class="text-success">Continue</strong>';
				if($search["status"] == "stop"){
					$searchStatus = '<strong class="text-danger">Stoped</strong>';
				}
				elseif($search["status"] == "pause"){
					$searchStatus = '<strong class="text-muted">Paused</strong>';
				}
				elseif($search["status"] == "new"){
					$searchStatus = '<strong class="text-primary">New</strong>';
				}
				
				$conLink = $hwctInfo["plugin-admin-url"].'&goto=load-search&ctsh='.$search["sid"];
				$delLink = $hwctInfo["plugin-admin-url"].'&goto=manage-search&srid='.$search["sid"].'&action='.base64_encode("rsfl");
				
				echo '
					<tr>
						<td>'.$searchCount.'</td>
						<td>'.$search["keywords"].'</td>
						<td>'.$search["total_users"].'</td>
						<td>'.$fetchfrm.'</td>
						<td>'.$searchIn.'</td>
						<td>'.$searchStatus.'</td>
						<td>
							<a title="Configure" href="'.$conLink.'"><span class="glyphicon glyphicon-cog"></span></a>
							<a class="delSearch" title="Remove this search" href="'.$delLink.'"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				';
			}
		}
		?>
     </table>
</div><!--End of row -->
<div class="row">
    <div class="col-lg-offset-4 col-lg-3">
        <ul class="pagination">
        <?php
            echo $pager->renderFirst();
            echo $pager->renderPrev();
            echo $pager->renderNav('<li>', '</li>');
            echo $pager->renderNext();
            echo $pager->renderLast();
        ?>
        </ul>
    </div><!--End of pagination -->
</div><!--End of row -->