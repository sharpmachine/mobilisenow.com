<?php
include("../../../../wp-config.php");

global $hwctInfo, $wpdb;
$lsid = get_option("hwct_last_search_id");
$searchData = $wpdb->get_row('SELECT * FROM `'.$hwctInfo["search-table"].'` WHERE `sid`='.$lsid, ARRAY_A);

if(isset($searchData) && !empty($searchData)){
	$file = $searchData["file_path"].$searchData["file_name"];
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
	}	
}

?>