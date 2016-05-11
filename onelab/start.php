<?php

include_once 'validatetoken.php';

$jwt = validatetoken("login.php");

$atJwt = getAccessTokenJwt();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
</head>
<body>
<h2>ID Token</h2>

<p>
<?php echo"name: $jwt->name"; ?>
</p>
<p>
<?php echo"ownerid: $jwt->ownerid"; ?>
</p>
<p>
<?php echo"domainuserid: $jwt->domainuserid"; ?>
</p>
<p>
<?php echo"department: $jwt->department"; ?>
</p>

<h2>Access Token</h2>
<p>
<?php echo"$_SESSION['access_token']"; ?>
</p>

</body>
</html>






