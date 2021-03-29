<?php
include("config.php");
session_start();
if(isset($_POST['EditForm']))
{


       $user = array('$set' => array('telephone' => $_POST['telephone']));
       $collection->update(array('user' => $_SESSION["user"]), $user);
       header("Location: acceuil.php");

}
else{
    $cursor = $collection->findOne(array("user" => $_SESSION['user']));

}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<h3>Update Data</h3>
<form  method="POST">
    UserName
    <input type="text"  name="user"  value="<?php echo $cursor['user'] ?>" required />
    telehone:
    <input type="text" name="telephone" required />
    <input  name="EditForm"  type="submit" value="Save" />
</form>
</body>
</html>