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
		

        //SETTING VALUES
        $task = $_POST["task"];
        $user = $_SESSION['userName'];
    
		$sql = "INSERT INTO tasks(task, status, Username) VALUES ('$task', 1, '$user')";
		if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
        header('Location: ../home.php');
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
        
		$conn->close();
	?>	
	
    
	
</body>
</html>