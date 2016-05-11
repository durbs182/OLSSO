<?php

// in case this is called directly if the access_token exists redirect start.php
include_once 'checkfortoken.php';


session_start();


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$unauthorized = "unauthorized.php";
$start = "start.php";

ini_set('display_errors', 'On');


$id_token = $state = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_token = test_input($_POST["id_token"]);
  $state = test_input($_POST["state"]);
}


if(isset($state))
{
	$instate = $state;
	$state = $_SESSION['state'];
	
	if($state == $instate)
	{
		error_log("formcallback.php: states match");
	}
	else
	{
		error_log("formcallback.php: states do not match");
		$idtoken = "";
		die("");
	}
} 

session_destroy();



if($id_token != "")
{
  try
  {
	error_log("formcallback.php: " . $id_token);
	include_once 'JWT.php';
  
	//$key_public = openssl_get_publickey(file_get_contents('test.cer'));
	
	
	// validate token
	$key_public = openssl_get_publickey(file_get_contents('auth_server_public_key.cer'));
	$jwt = JWT::decode($id_token, $key_public ,true);
      
	//var_dump($jwt);
			
	//setcookie( "id_token", $id_token, $expiry , '/', '.onelab.citrix.com', true, true);
	

	session_start();
	
	$_SESSION['id_token']=$id_token;
    
	// return start.php to call
	header('Location: ' . $start,true,302);
	die($start);
  }
  catch(Exception $e)
  {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
	error_log($e);
  }
}

header('Location: ' . $unauthorized,true,302);

 
?>