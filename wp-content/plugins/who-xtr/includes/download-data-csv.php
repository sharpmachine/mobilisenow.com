<?php

include("../../../../wp-config.php");
global $hwextproInfo, $wpdb;
$fileData = $wpdb->get_row('SELECT * FROM `'.$hwextproInfo["files-table"].'` WHERE `fid`='.base64_decode($_GET["file"]), ARRAY_A);
if(isset($fileData) && !empty($fileData)){
	$file = $fileData["file_path"].str_replace(".txt","_emails.csv",$fileData["file_name"]);
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header("Content-type: text/csv");
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