<?php
	require "fbsdk/src/Facebook/autoload.php";
	session_start();
	$fb = new Facebook\Facebook([
	  'app_id'                => '391758004914889',
	  'app_secret'            => '98967db0a39d77ed94f543246a5eb1a1',
	  'default_graph_version' => 'v3.2',
	]);
?>