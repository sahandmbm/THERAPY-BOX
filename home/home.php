<?php
        session_start();
        if (!isset($_SESSION['userName'])) {
        header('Location: ../index.html');
        exit();
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Therapy Box</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="user-scalable = yes">
    <link rel="icon" href="LOGO.jpg">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase|Nova+Mono" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
    
    <!-- PIE CHART -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

        
            <?php 
            
                $var = file_get_contents("https://therapy-box.co.uk/hackathon/clothing-api.php?username=swapnil");
                echo "var table=".$var.";";
            
            ?>
            var jack = 0, jump=0, hood=0, sweat=0, rain=0, blaz=0, unknownCloth=0 ;
            for(j=0;j<=table.payload.length;j++)
                {
                    if(table.payload[j].clothe == "jacket"){
                       jack++;
                    }else if(table.payload[j].clothe == "jumper"){
                        jump++;
                    }else if(table.payload[j].clothe == "hoodie"){
                        hood++;     
                    }else if(table.payload[j].clothe == "sweater"){
                        sweat++;
                    }else if(table.payload[j].clothe == "raincoat"){
                        rain++;
                    }else if(table.payload[j].clothe == "blazer"){
                        blaz++;
                    }else{
                         unknownCloth++;
                    }
                                             
                    
                }
            
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Cloth');
            data.addColumn('number', 'Id');
              
            data.addRows([
              ['Jacket', jack],
              ['Hoodie', hood],
              ['Sweater', sweat],
              ['Jumper', jump],
              ['Raincoat', rain],
              ['Blazer', blaz],
              ['Other', unknownCloth]
            ]);  
              
            var options = {backgroundColor: 'transparent',
                           'width':300,
                           'height':150,
                            legend: 'none'};
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
    
</head>
<body>

    <!-- HEADER -->
    <h1 id="header">Good day <?php echo $_SESSION['userName'] ?></h1>
    
    <!-- BOXES -->
    <div id="boxes">
    
            <!-- weather -->
        <div class="box" id="weatherBox">
            <h2 class="boxName"> Weather </h2>
            <div class="boxData">
                <img src="weather/Clouds_icon.png" alt="weather" id="weatherIcon">
                <p id="temp">   </p>
                <p id="loc"> </p>
            </div>
        </div>
        
                <!-- DATA COLLECTION -->
        <script type="text/javascript">
                getLocation();
            
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else { 
                        x.innerHTML = "Geolocation is not supported by this browser.";
                    }
                }
                function showPosition(position) {

                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    var lin = "https://samples.openweathermap.org/data/2.5/weather?lat=" + lat + "&" + lon + "=139&appid=d0a10211ea3d36b0a6423a104782130e";
                    
                    setCookie("link",lin,1);
                    
                }

                function setCookie(name,value,days) {
                    var expires = "";
                    if (days) {
                        var date = new Date();
                        date.setTime(date.getTime() + (days*24*60*60*1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
                }
            
            <?php
                $varLoc = $_COOKIE[link];
                $var2 = file_get_contents($varLoc);
                echo "var weath=".$var2.";";
            ?>
            
            if(weath.weather[0].main == "Clear"){
                $("#weatherIcon").attr("src", "weather/Sun_icon.png");
            } else if(weath.weather[0].main == "Clouds"){
                $("#weatherIcon").attr("src", "weather/Clouds_icon.png");
            }else{
                $("#weatherIcon").attr("src", "weather/Rain_icon.png");
            }
            
            document.getElementById('loc').innerHTML = weath.name;
            document.getElementById('temp').innerHTML = Math.round(weath.main.temp - 273.15) + "<br> degrees";
            
        </script>
        
        
        


            <!-- news -->
        <a href="news/getRSS.php">
            <div class="box" id="newsBox">
                <h2 class="boxName"> News </h2>
                <div class="boxData">
                    <?php 
                        $xml=("http://feeds.bbci.co.uk/news/rss.xml#");
                        $xmlDoc = new DOMDocument();
                        $xmlDoc->load($xml);

                        $x=$xmlDoc->getElementsByTagName('item');
                        for ($i=0; $i<=1; $i++) {
                            
                          $item_title=$x->item($i)->getElementsByTagName('title')
                          ->item(0)->childNodes->item(0)->nodeValue;
                            
                          $item_link=$x->item($i)->getElementsByTagName('link')
                          ->item(0)->childNodes->item(0)->nodeValue;
                            
                          $item_desc=$x->item($i)->getElementsByTagName('description')
                          ->item(0)->childNodes->item(0)->nodeValue;


                          echo ('<h2 class="headline">');
                          echo "<a href='" . $item_link . "'>" . $item_title;
                          echo ("</h2>");
                          echo ("<p class='content'>" . $item_desc . "</p>");
                        }

                    ?>
                </div>
            </div>
        </a>


        
            <!-- sport -->
        <a href="sport/sport.php">
            <div class="box" id="sportsBox">
                <h2 class="boxName"> Sport </h2>
                <div class="boxData">
                    <?php 
                        $xml=("http://www.goal.com/en/feeds/news?fmt=rss&ICID=HP");
                        $xmlDoc = new DOMDocument();
                        $xmlDoc->load($xml);

                        $x=$xmlDoc->getElementsByTagName('item');

                            
                          $item_title=$x->item(0)->getElementsByTagName('title')
                          ->item(0)->childNodes->item(0)->nodeValue;
                            
                          $item_link=$x->item(0)->getElementsByTagName('link')
                          ->item(0)->childNodes->item(0)->nodeValue;
                            
                          $item_desc=$x->item(0)->getElementsByTagName('description')
                          ->item(0)->childNodes->item(0)->nodeValue;


                          echo ('<h2 class="headline">');
                          echo "<a href='" . $item_link . "'>" . $item_title;
                          echo ("</h2>");
                          echo ("<p class='content'>" . $item_desc . "</p>");
                        

                    ?>
                </div>
            </div>
        </a>

            <!-- photo -->

        <a href="photos/photos.php">
            <div class="box">
                <h2 class="boxName"> Photos </h2>
                <div class="boxData" id="photoPre">
                        <?php	
                            //CONNECTING TO DATABASE
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "myDB";

                            $user = $_SESSION['userName'];

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT * FROM imagePaths WHERE Username = '$user'";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                        echo ('<img src="photos/' . $row["imagePath"] . ('"') . '>');
                                }
                            } else {
                                  echo "<p> No Image to display <p>";
                            }

                        ?>
                </div>
            </div>
        </a>

            <!-- task -->
        <a href="task/task.php">
            <div class="box">
                <h2 class="boxName"> Tasks </h2>
                <div class="boxData">
                        <?php	
                            //CONNECTING TO DATABASE
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "myDB";
                    
                            $user = $_SESSION['userName'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT * FROM tasks WHERE status = 1 AND Username = '$user'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo '<ul id="taskList">';
                                while($row = $result->fetch_assoc()) {
                                    echo "<li>" . $row["task"] . "</li>";
                                }
                                echo '</ul>';
                            } else {
                                  echo "Click here to add new tasks";
                            }
                        $conn->close();
                        ?>	
                </div>
            </div>
        </a>

            <!-- clothes -->

        <div class="box">
            <h2 class="boxName"> Clothes </h2>
            <div class="boxData">
                <div id="chart_div"></div>
            </div>
        </div>
    
    
    </div>
    
    
    
</body>


</html>