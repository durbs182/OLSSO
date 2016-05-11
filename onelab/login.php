<?php 

// in case this is called directly if the access_token exists redirect start.php
include_once 'checkfortoken.php';

$callbackUri = 'https://localhost/token/ccp/onelab/formcallback.php';


$authorizationUri = 'https://ctxidentity.azurewebsites.net/identity/connect/authorize';



session_start();

$time = time();
$rand = rand();

$state="$time$rand"; 

$_SESSION['state']=$state;


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
</head>
<body>
    
<script src="Scripts/jquery-2.0.2.js"></script>
    
<script>
	$(document).ready(function () {
		var authorizationuri = '<?php echo $authorizationUri; ?>';
		var client_id = '16865bd0-7de5-4832-8c5e-d1bd6e11d7cd';
		var redirect_uri = '<?php echo $callbackUri; ?>';
		var response_type = "code id_token token";
		var scopes = "openid all_claims offline_access userid_claims";
		var state = "<?php echo $state; ?>" ;
		
		var url =
			authorizationuri + "?" + 
			"client_id=" + encodeURI(client_id) + "&" + 
			"redirect_uri=" + encodeURI(redirect_uri) + "&" + 
			"response_mode=form_post&" + 
			"response_type=" + encodeURI(response_type) + "&" + 
			"scope=" + encodeURI(scopes) + "&" + 
			"state=" + encodeURI(state);
			
		console.log(url);
		
		sessionStorage["state"] = state;
		window.location.replace(url);
		
		});
</script>
    
</body>
</html>
