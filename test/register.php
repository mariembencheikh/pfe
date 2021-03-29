<?php
include("config.php");
session_start();
if(isset($_POST["registerForm"])) {
    $userName=$_POST['user'];
    $userPass=$_POST['password'];

    $cursor = $collection->findOne(array('user' => $userName));
    if (empty($cursor)) {
            $collection->insert(array('user' => $userName, 'password' => $userPass));
            header("Location:login.php");
    }
    else {
        echo 'Email has already registred';

    }

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Register new user</h3>
<form action="register.php" method="POST">
    UserName
    <input type="text"  name="user" required  />
    Password:
    <input type="password" name="password" required/>
    <input  name="registerForm"  type="submit" value="register" />
</form>
</body>
</html>


