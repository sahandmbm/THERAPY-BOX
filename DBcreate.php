
	<?php
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
    
        
		// sql to create table
		$sql = "CREATE TABLE users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		                              Username VARCHAR(30) NOT NULL, 
                                      Email VARCHAR(30) NOT NULL, 
                                      Password  VARCHAR(30) NOT NULL,
		                              imagePath VARCHAR(60) NOT NULL)";
    
        $sql2 = "CREATE TABLE tasks(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		                              task VARCHAR(30) NOT NULL, 
                                      status BIT NOT NULL,
                                      Username VARCHAR(30) NOT NULL)";
    
        $sql3 = "CREATE TABLE imagePaths(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		                              Username VARCHAR(30) NOT NULL, 
		                              imagePath VARCHAR(60) NOT NULL)";
    
    
		if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
		echo "Table Users created successfully";
		} else {
		echo "Error creating table: " . $conn->error;
		}
		$conn->close();
	?>	
	