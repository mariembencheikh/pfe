<?php
include "config.php";
session_start();
$cursor=$collection_nbClients->findOne(array('_id' => new MongoId($_GET['id'])));
$collectionInterval = $collection_nbClients->remove(array('_id' => new MongoId($_GET['id']) ) , array("justOne"=> true));
header("Location:interval.php");