<?php
include "config.php";
session_start();
//departments
$collectionDep = $collection_Department->remove(array('_id' => new MongoId($_GET['id'])), array("justOne" => true));



//functions
$cursor = $collection_Employees->find();
foreach ($cursor as $c){
    if($c['department']==$_GET['dep']){
        $collectionEmp = $collection_Employees->remove(array('department' => $_GET['dep']), array("justOne" => true));
    }
}


//salaireDep
$sal=$collection_salaire->find();
foreach ($sal as $s){
    if($s['department']==$_GET['dep']){
        $collection_salaire->remove(array('department'=>$_GET['dep']),array("justOne"=>true));

    }
}


//nbPersonnel par department

$nbPersonnel = $collection_nbPersonnel->find();
foreach ($nbPersonnel as $nb){
    if($nb['department']==$_GET['dep']){
        $collection_nbPersonnel->remove(array('department'=>$_GET['dep']),array("justOne"=>true));

    }
}



header("Location:departments.php");

