<?php

	$file = fopen('http://www.football-data.co.uk/mmz4281/1718/I1.csv', 'r');
	$team = $_REQUEST["team"]; 
	$team1 = strtoupper($team); 	
	$teams = array(); 
	while (($line = fgetcsv($file)) !== FALSE) {
	   	if (strtoupper($line[2]) == $team1 && $line[9] == "H"){
	   		array_push($teams, $line[3]);
	   	} else if (strtoupper($line[3]) == $team1 && $line[9] == "A"){
	   		array_push($teams, $line[2]);
	   	}
	}

	fclose($file);
	$output = "<p>" . $team . " has beaten : </p> <br>";
	$flag = false;
	foreach ($teams as $value) {
		$output .= " <li> " . $value . " </li> ";
		$flag = true;
	}

	if ($flag == false){
		$output = "The entered team (".$team.")was not found. Please choose a team from the list.";
	}

    echo $output;
    exit();
	
?>