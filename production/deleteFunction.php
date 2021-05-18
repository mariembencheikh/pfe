<?php
include "config.php";
session_start();

$cursor=$collection_Employees->findOne(array('_id'=>new MongoId($_GET['id'])));

$collectionEmp = $collection_Employees->remove(array('_id' => new MongoId($_GET['id'])) , array("justOne"=> true));

header("Location:listeFonctions.php");

