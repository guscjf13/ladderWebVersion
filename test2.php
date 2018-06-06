<?php
include "db.php";
$maxpeople = (int)$_POST["maxPeople"];

echo $maxpeople;

$path = "/test/test";
$firebase->set($path,$maxpeople);

?>