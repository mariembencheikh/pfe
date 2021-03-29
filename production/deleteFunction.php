<?php
include "config.php";
session_start();

$cursor=$collection_Employees->findOne(array('function'=>$_GET['id']));

$collectionEmp = $collection_Employees->remove(array('function' => $_GET['id'] ) , array("justOne"=> true));

header("Location:employees.php");

