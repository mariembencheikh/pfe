<?php
include ("config.php");
$user = $collection->findOne(array('name' => $_GET['id']));
$collection->remove(array('name' => $_GET['id']), array("justOne" => true));
header('Location:listeUser.php');
