<?php

$fn = 'Paul';
$sn = 'Durbin';

echo '<!DOCTYPE html><html><body><img src="logo_open.png" /><p><b>Hello ';
echo $fn ;
echo ' '; 
echo $sn;
echo '. The monkey is sad as you do not have an account in CloudPlatform.</b></p></body></html>';
$timeout = 1;
$jsessionidpath = '/';
setcookie( 'sso', 'https://mac-win8.cam.onelab.citrix.com/ccp/sso/logout.php', null , $jsessionidpath, '.onelab.citrix.com', false, false);

?>