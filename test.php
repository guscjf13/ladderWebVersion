<?php

$leader = "\"test1\"";
$leader = explode("\"", $leader)[1];
$invite_id = "test1";

echo strcmp($leader,$invite_id);
?>