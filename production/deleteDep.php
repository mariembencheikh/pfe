<?php
include "config.php";
session_start();

$cursor = $collection_Employees->findOne(array('department' => $_GET['id']));
$collectionDep = $collection_Department->remove(array('nameDep' => $_GET['id']), array("justOne" => true));
$collectionEmp = $collection_Employees->remove(array('department' => $_GET['id']), array("justOne" => true));
$sal=$collection_salaire->findOne(array('department'=>$_GET['id']));
$collection_salaire->remove(array('department'=>$_GET['id']),array("justOne"=>true));
$nbPersonnel = $collection_nbPersonnel->findOne(array('department' => $_GET['id']));
$collection_nbPersonnel->remove(array('department'=>$_GET['id']),array("justOne"=>true));



header("Location:departments.php");

