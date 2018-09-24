<?php
        session_start();
        if (!isset($_SESSION['userName'])) {
        header('Location: ../../index.html');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>
<body>
    <div id="myDIV" class="header">
      <h2>My To Do List</h2>
      <input type="text" id="myInput" placeholder="Add new task">
      <span onclick="newElement()" class="addBtn"></span>
    </div>
    
    
    <ul id="myUL">
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
		$sql = "SELECT * FROM tasks WHERE Username = '$user'";
     
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                    echo "<li";
                        if ($row["status"] == 0 ){
                            echo (" class='checked'");
                        }    
                    echo">" . $row["task"] . "</li>";
            }
		} else {
		      echo "<ul> <li> No task to display </ul> </li>";
		}
		
	?>	
    </ul>

    
</body>
<script>

    var list = document.querySelector('ul');
    list.addEventListener('click', function(ev) {
      if (ev.target.tagName === 'LI') {
        ev.target.classList.toggle('checked');
          addCheck(ev.target.innerHTML);

      }
        
    }, false);
    
    function addCheck(taskDone){
            $.ajax({
                type: "POST",
                url: "statusChange.php",
                data: {whichTask: taskDone},
                success: function(){
                }
            });
     }
    
    function newElement() {
      var li = document.createElement("li");
      var inputValue = document.getElementById("myInput").value;
      var t = document.createTextNode(inputValue);
      li.appendChild(t);
      if (inputValue === '') {
        alert("You must write something!");
      } else {
        document.getElementById("myUL").appendChild(li);
        addTask(inputValue);
      }
      document.getElementById("myInput").value = "";

      var span = document.createElement("SPAN");
      var txt = document.createTextNode("\u00D7");
      span.className = "close";
      span.appendChild(txt);
      li.appendChild(span);

      for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
          var div = this.parentElement;
          div.style.display = "none";
        }
      }
    }
    
    function addTask(taskToAdd){
            $.ajax({
                type: "POST",
                url: "set.php",
                data: {task: taskToAdd},
                success: function(){
                    alert("Task added");
                }
            });
        }

    </script>

</html>