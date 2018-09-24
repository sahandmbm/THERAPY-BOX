<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<body>
	<?php
        session_start();
        if (!isset($_SESSION['userName'])) {
        header('Location: ../../login.html');
        exit();
        }
            //CONNECTING
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "myDB";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
		}

	    $task = $_REQUEST['whichTask'];
        $user = $_SESSION['userName'];
    

        $sql = "SELECT * FROM tasks WHERE task = '$task' AND Username = '$user'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        $taskNm = $row["task"];
        $statusNm = $row["status"];
    
        if($statusNm == 1){
            $query = "UPDATE tasks SET status = 0 WHERE task = '$taskNm';";
        }else{
            $query = "UPDATE tasks SET status = 1 WHERE task = '$taskNm';";
        }
        
        $conn->query($query);
	?>	
	
    
	
</body>
</html>