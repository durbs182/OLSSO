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
<?php var_dump($jwt); ?>
</p>
<p>
<?php echo"ownerid: $jwt->ownerid"; ?>
</p>

</body>
</html>






