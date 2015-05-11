<?php
include_once("facebook.php");
$fbconfig['appid']  	=  $hwextproOptions["hwextpro-fb-app-id"];
$fbconfig['appsecret']  =  $hwextproOptions["hwextpro-fb-app-scrt"];
$fbconfig['baseurl']    =  $hwextproInfo["plugin-admin-url"];
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
			'redirect_uri'  => $hwextproInfo["plugin-admin-url"]."&goto=upload"
		)
);

$facebook->setFileUploadSupport(true);

?>