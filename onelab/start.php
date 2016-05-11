<?php
//$jsessionidpath = 'test';
//$timeout = 3600;
//setcookie( 'sso', 'true', time()+$timeout , $jsessionidpath, '.onelab.citrix.com', false, false);

//die("");
$unauthorized = "Unauthorized.php";
$ccpEndpoint = "http://cloud2.cam.onelab.citrix.com/client";
$ApiEndPoint =  $ccpEndpoint . "/api";

// get users configured domains
$domainid = "";

include_once 'validatetoken.php';


$jwt = validatetoken("login.php");

// sub is domain\username get just username
$sub = explode("\\", $jwt->sub);
$username = $jwt->sub;



// if domainid is passed as querystring use that
if(count($_GET) > 0 && isset($_GET['domainid']))
{
	$domainid = $_GET['domainid'];
}
else
{
	// returns null if no user found
	$user = getCcpUserByUserName($username, $ApiEndPoint);
	
	if($user == null)
	{
		// if user not found create one
		die('no ccp user ' . $username);
	}
	
	$domains = getCcpUserDomains($user, $ApiEndPoint);
	
	if(count($domains) > 1 )
	{
		// show list
		echo'<!DOCTYPE html><html><body><a href="start.php"><img src="logo_open.png" /></a><p><b>Username: ' .$username. '</b></p><p><b>Note:</b>Select the required CloudPlatform domain and click submit to continue login.</p><form action="start.php">';
		
		$checked = 'checked';
		
		foreach (array_keys($domains) as $domainid) 
		{
			echo'<input ' . $checked . ' type="radio" name="domainid" value="' . $domainid . '">' . $domains[$domainid] . '<br>';
			
			$checked = '';
		}
		echo'<input type="submit" value="Submit"></form></body></html>'; 	
		die('');
	}
	else
	{
		$keys = array_keys($domains);
		$domainid = $keys[0];
	}
}

// TODO if more than 1 domain offer list for selection
$url = getCcpLoginUrl($ApiEndPoint, $username, $domainid);
	
if(getCcpLoginResponse($url))
{
	header("Location: " . $ccpEndpoint ); 

	die('redirect');
}
else
{
	die('CCP login failed');
}

?>






