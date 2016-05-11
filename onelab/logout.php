<?php 


setcookie( 'sso', '', time()-3600 , '/', '.onelab.citrix.com', false, false);

$redirect = "Location: index.html"; /* Redirect browser */
header($redirect); /* Redirect browser */
die('redirect');

?>


