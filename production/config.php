<?php
$m = new MongoClient("mongodb://192.168.100.15"); // connexion
$db = $m->selectDB("exemple");
$collection = $m->selectCollection($db, 'test');
$collection_Department = $m->selectCollection($db,'departments');
$collection_Employees = $m->selectCollection($db,'functions');
$collection_nbClients = $m->selectCollection($db,'nbClients');
$collection_hotel = $m->selectCollection($db,'societe');
$collection_nbPersonnel = $m->selectCollection($db,'nbPersonel');
$collection_coutFixe = $m->selectCollection($db,'coutFixe');
$collection_saison = $m->selectCollection($db,'saison');
$collection_salaire = $m->selectCollection($db,'salaireDep');
//$collection_nbPersonnel->insert(array('department'=>'1',array('interval'=>'2','fun1'=>'1','f2'=>'2'),array('interval'=>'3','fun1'=>'1','f2'=>'2')));
