<?php
include("config.php");
session_start();
$user=$collection->findOne(array("_id" => $_POST['id']));
$new=array('$set',array('etat'=>0));
$collection->update(array("_id"=>$_POST['id']),$new);
