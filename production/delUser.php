<?php
include ("config.php");
$user = $collection->findOne(array('_id' => $_GET['id']));
$collection->remove(array('_id' => new MongoId($_GET['id'])), array("justOne" => true));
header('Location:listeUser.php');
