<?php

include_once 'validatetoken.php';

$jwt = validatetoken("login.php");



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
</head>
<body>
<h2>JWT</h2>

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
<?php echo"domainuserid: $jwt->domainuserid"; ?>
</p>
<p>
<?php echo"department: $jwt->department"; ?>
</p>

</body>
</html>






