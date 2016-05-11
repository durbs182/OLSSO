<?php

include_once 'JWT.php';

function redirect($redirectpage)
{
	$redirect = "Location: " . $redirectpage; 
	header($redirect); /* Redirect browser */
	die('redirect');
}

function getAccessTokenJwt()
{
	var_dump($_SESSION);
	die("");
	
	if (isset($_SESSION['access_token']))
	{
		$key_public = openssl_get_publickey(file_get_contents('auth_server_public_key.cer'));
		$access_token = $_SESSION['access_token'];
		$jwt = JWT::decode($access_token,$key_public ,true);
		
		return $jwt;
	}
	
	return null;
}

function validatetoken($redirectpage) 
{
	session_start();

	// get oauth token from cookie
	// if not present redirect to $redirectpage
	// if found check that token is valid by decoding it
	if (isset($_SESSION['id_token']))
	{
		$id_token = $_SESSION['id_token'];
		
		try
		{
			$key_public = openssl_get_publickey(file_get_contents('auth_server_public_key.cer'));
			
			$jwt = JWT::decode($id_token,$key_public ,true);
			
			//var_dump($jwt);
			//die("");
			return $jwt;
		}
		catch(Exception $e)
		{
			$msg = $e->getMessage();
			echo 'Token validation error: ', $msg , "\n";
			error_log("validatetoken: invalid token : " . $msg);
		}
	}

	//setcookie("id_token", "", time()-3600);
	session_destroy();
	redirect($redirectpage);
}



?>