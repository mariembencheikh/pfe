<?php
include "config.php";
session_start();
if (isset($_GET['id'])) {
    $nb_edit = $collection_Department->findOne(array('nameDep' => $_GET['dep']));
    $intervalles=array();
    $intervalles=$nb_edit['interval'];
    $collection_Department->update(array('nameDep'=>$nb_edit['nameDep']),array('$pull'=>array('interval'=>array('ordre'=>$intervalles[$_GET['id']]['ordre']))));
    $int = $nb_edit['interval'][$_GET['id']]['n1'] . " - " . $nb_edit['interval'][$_GET['id']]['n2'];
    $nb=$collection_nbPersonnel->findOne(array('department'=>$_GET['dep']));
    $collection_nbPersonnel->remove(array('department'=>$nb_edit['nameDep'],'interval'=>$int),array("justOne"=>true));
    $sal=$collection_salaire->findOne(array('department'=>$_GET['dep']));
    $collection_salaire->remove(array('department'=>$nb_edit['nameDep'],'interval'=>$int),array("justOne"=>true));

//    $collection_salaire->update(array('nameDep'=>$nb_edit['nameDep']),array('$pull'=>array('interval'=>$int)));



    header("Location:departments.php");
} else {
    header("Location:departments.php");
}




