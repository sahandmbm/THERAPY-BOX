<?php
        session_start();
        if (!isset($_SESSION['userName'])) {
        header('Location: ../../index.html');
        exit();
        }
?>

<html>

<head>
    <title>Therapy Box | NEWS</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="user-scalable = yes">
    <link rel="icon" href="LOGO.jpg">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
</head>    
    
<body>
    <h1>SPORTS</h1>
    
    <h2>TEAMS IN SERIE A</h2>
    
    
	<?php
        $file = fopen('http://www.football-data.co.uk/mmz4281/1718/I1.csv', 'r');
        $teams = array();
        while (($line = fgetcsv($file)) !== FALSE) {
            // add all home team names to the array
            array_push($teams, $line[2]);	   	
        }
    

        
        $uniqueTeams = array_unique($teams); 
        array_shift($uniqueTeams);
            echo ("<ul>");
            foreach ($uniqueTeams as $value) {
                echo ("<li>") . $value . ("</li>");
            }
            echo ("</ul>");
    ?>
    
    
    

        <input type="text" name="team" value="Input team name" id="teamName" onclick="value=''">
        <input type="submit" value="Search" onclick="getResult()" id="teamSearch">

    <script type="text/javascript">
        function getResult(){
            $.ajax({
                type: "POST",
                url: "search.php",
                data: {team: $("#teamName").val()},
                success: function(data){
                    $("#wonAgainst").html(data);
                }
            });
        }
    </script>
    
    <div>
        <ul id="wonAgainst">
            
        </ul>
    </div>
    
    
	
	
</body>
</html>