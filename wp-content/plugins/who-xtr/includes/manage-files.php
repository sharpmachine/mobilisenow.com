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
	
	$query = 'SELECT * FROM `'.$hwextproInfo["files-table"].'`';
	$pager = new PS_Pagination($wpdb->dbh, $query, 10, 5, "page=hw-extpro&goto=manage-files");
	$fileData = $pager->paginate();
	$fileCount = $pager->offset;
	$totalFiles = $pager->total_rows;
?>

<div class="page-header">
	<h1>Step 2:</h1>
    <p class="text-info">Please select a file from the below list</p>
</div><!--End of page header -->
<table class="table table-bordered table-responsive">
        <tr>
            <th>#</th>
            <th>File Name</th>
            <th>Title</th>
            <th>Extracted</th>
            <th>Actions</th>
        </tr>
        <?php
		if( $fileData && !empty($fileData) ){
			while($file = mysql_fetch_assoc($fileData)){
				$fileCount += 1;
				$downloadLink = "";
				
				$txtfile = $file["file_path"].str_replace(".","_emails.",$file["file_name"]);
				$csvfile = $file["file_path"].str_replace(".txt","_emails.csv",$file["file_name"]);
				
				if(file_exists($file["file_path"].$file["file_name"])){
					$viewLink = $file["file_url"].$file["file_name"];
					$fileName = '<a href="'.$hwextproInfo["plugin-admin-url"].'&goto=extract&file='.base64_encode($file["fid"]).'">'.$file["file_name"].'</a>';
				}
				else{
					$viewLink = "javascript:void(0)";
					$fileName = '<span class="text-danger">'.$file["file_name"].' &nbsp;(File Deleted)</span>';
				}
				
				if(file_exists($txtfile)){
					$downloadLink = '<a title="Download txt file" href="'.$hwextproInfo["dir-url"].'includes/download-data.php?file='.base64_encode($file["fid"]).'" class="btn btn-primary btn-xs" role="button">Download</a>';
				}
				
				if(file_exists($csvfile)){
					$downloadLink .= '&nbsp;&nbsp;<a title="Download csv file" href="'.$hwextproInfo["dir-url"].'includes/download-data-csv.php?file='.base64_encode($file["fid"]).'" class="btn btn-info btn-xs" role="button">Download</a>';
				}
				
				echo '
					<tr>
						<td>'.$fileCount.'</td>
						<td>'.$fileName.'</td>
						<td>'.$file["title"].'</td>
						<td>'.$downloadLink.'</td>
						<td>
							<a target="_blank" title="View" href="'.$viewLink.'"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
							<a class="delete_file" title="Delete" href="'.$hwextproInfo["plugin-admin-url"].'&goto=manage-files&action='.base64_encode("delete-file").'&file='.base64_encode($file["fid"]).'"><span class="glyphicon glyphicon-remove"></span></a>
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