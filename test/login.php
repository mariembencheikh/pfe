<?php
include("config.php");
session_start();
    if(isset($_POST["submitForm"])) {
        $userName=$_POST['user'];
        $userPass=$_POST['password'];
        $cursor = $collection->findOne(array('user' => $userName, 'password' => $userPass));
        if ($cursor) {
                header('Location:acceuil.php ');
        }
    }
$_SESSION["user"]=$userName;
?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Login</h3>
<form  method="POST">
    UserName
    <input type="text"  name="user" required  />
    Password:
    <input type="password" name="password" required/>
    <input  name="submitForm"  type="submit" value="login" />
</form>
</body>
</html>





