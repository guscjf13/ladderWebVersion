<?php
include "db.php";
$index = 1;
$wincrease_path="/project/".$index."/things/increase";
$wincrease = $firebase->get($wincrease_path);
$z = 1;
                $percentage = 0;
            	$done = 0;
            	$issue = 0;

            	while($wincrease >= $z){
            		echo "wincrease".$wincrease."<br>";
                	$cal_path="/project/".$index."/things/".$z."/state";
                	$cal = $firebase->get($cal_path);
                	echo "zzzzzzzzzzzzzzzcal:".$cal."<br>";
                	if($cal == null){
                	}elseif($cal == 3){
                		echo "start done:".$done."<br>";
                		$done++;
                		echo "end done:".$done."<br>";
                	}elseif($cal == 2){
                		echo "start issue:".$issue."<br>";
                		$issue++;
                		echo "end issue:".$issue."<br>";
                	}
                	$z++;
                	echo "ending z:".$z."<br>";
            	}
            	echo "percentage:".$percentage."<br>";
            	echo "done:".$done."<br>";
            	echo "issue:".$issue."<br>";
            	$percentage = ($done/$wincrease)*100 - ($issue*5);
            	$percentage = $percentage%100;
            	echo $percentage;

?>