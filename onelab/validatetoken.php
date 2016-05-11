<?php

function redirect($redirectpage)
{
	$redirect = "Location: " . $redirectpage; 
	header($redirect); /* Redirect browser */
	die('redirect');
}

function validatetoken($redirectpage) 
{
	session_start();

	// get oauth token from cookie
	// if not present redirect to $redirectpage
	// if found check that token is valid by decoding it
	if (isset($_SESSION['id_token']))
	{
		include_once 'JWT.php';
		
		$id_token = $_SESSION['id_token'];
		
		
		
		try
		{
			$key_public = openssl_get_publickey(file_get_contents('auth_server_public_key.cer'));
			//$key_public = openssl_get_publickey(file_get_contents('test.cer'));
			
			$jwt = JWT::decode($id_token,$key_public ,true);
			
			var_dump($jwt);
			die("");
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