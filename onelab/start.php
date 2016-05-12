<?php

include_once 'validatetoken.php';

$jwt = validatetoken("login.php");

$atJwt = getAccessTokenJwt();

$at = $_SESSION['access_token'];
$it = $_SESSION['id_token'];

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
<?php echo"email: $jwt->email"; ?>
</p>
<p>
<?php echo"domainuserid: $jwt->domainuserid"; ?>
</p>
<p>
<?php echo"location: $jwt->location"; ?>
</p>
<p>
<?php echo"country: $jwt->country"; ?>
</p>
<p>
<?php echo"employeeNumber: $jwt->employeeNumber"; ?>
</p>

<p>
<?php echo"$it"; ?>
</p>

<h2>Access Token</h2>
<p>
<?php echo"$at"; ?>
</p>

</body>
</html>






