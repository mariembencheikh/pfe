<?php
$m = new MongoClient("mongodb://192.168.100.2"); // connexion
$db = $m->selectDB("exemple");
$collection = $m->selectCollection($db, 'test');

