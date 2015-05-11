<?php 

include_once("facebook.php");

$fbconfig['appid']  	=  $hwctOptions["hwct-fb-app-id"];
$fbconfig['appsecret']  =  $hwctOptions["hwct-fb-app-scrt"];
$fbconfig['baseurl']    =  $hwctInfo["plugin-admin-url"];
$fbUser = null;

// Create our Application instance.
$facebook = new Facebook(array(
  'appId'  => $fbconfig['appid'],
  'secret' => $fbconfig['appsecret'],
  'cookie' => true,
));

//Facebook Authentication part
$fbUser = $facebook->getUser();

$loginUrl = $facebook->getLoginUrl(array(
			'scope'         => 'user_about_me,manage_pages',
			'redirect_uri'  => $hwctInfo["plugin-admin-url"]."&goto=manage-search"
		)
);

$facebook->setFileUploadSupport(true);

//Get Page Access Token
if(isset($_GET["goto"]) && $_GET["goto"] != "main"){
	if($fbUser && !get_option("hwct_token") ){
		$pageData = $facebook->api(array(
			"method" => 'fql.query',
			"query" => 'SELECT access_token from page where page_id IN (SELECT page_id from page_admin where uid = '.$fbUser.')',
			"access_token" => $_SESSION["fb_".$fbconfig["appid"]."_access_token"]
		));
		
		if($pageData && !empty($pageData)){
			update_option("hwct_token", $pageData[array_rand($pageData,1)]["access_token"]);
		}
		elseif((!$pageData || empty($pageData)) && !isset($_SESSION["no-page"])){
			$_SESSION["no-page"] = 1;
			errorOccurred($hwctInfo["plugin-admin-url"], 'Please first create a Facebook fan page <a target="_blank" href="https://www.facebook.com/pages/create/" class="alert-link">here</a>');
			exit;
		}
	}
	elseif($fbUser && get_option("hwct_token")){
		try{
			$tokenStatus = $facebook->api("debug_token?input_token=".get_option("hwct_token"), "GET", array("access_token"=>$_SESSION["fb_".$fbconfig["appid"]."_access_token"]));
		}
		catch(Exception $e){
		}
		
		if(!$tokenStatus || $tokenStatus["data"]["error"]){
			$pageData = $facebook->api(array(
				"method" => 'fql.query',
				"query" => 'SELECT access_token from page where page_id IN (SELECT page_id from page_admin where uid = '.$fbUser.')',
				"access_token" => $_SESSION["fb_".$fbconfig["appid"]."_access_token"]
			));
			update_option("hwct_token", $pageData[array_rand($pageData,1)]["access_token"]);
		}
		
	}
}

?>