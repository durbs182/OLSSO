
<?php
include_once 'JWT.php';

function validatetoken($token) 
{
		
	try
	{
		$key_public = openssl_get_publickey(file_get_contents('auth_server_public_key.cer'));
		
		$jwt = JWT::decode($token,$key_public ,true);
		
		return $jwt;
	}
	catch(Exception $e)
	{
		$msg = $e->getMessage();
		echo 'Token validation error: ', $msg , "\n";
		error_log("validatetoken: invalid token : " . $msg);
		
		throw new Exception("validatetoken: invalid token : " . $msg);
	}
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $access_token = $_POST["access_token"];
  
  $jwt = validatetoken($access_token);
  
  echo $jwt->ownerid;
}




?>