<?php

        session_start();
        if (!isset($_SESSION['userName'])) {
        header('Location: ../../index.html');
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
	    //UPLOADING THE IMAGE INTO UPLOADS FILE
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    
		
		if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"],
		$target_file)) {
              echo "The file". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
		} else {
		      echo "Sorry, there was an error uploading your file.";
		}

        $uname = $_SESSION['userName'];
        
        $image=basename($_FILES["imageUpload"]["name"],".jpg");
		$imageB = "upload/" . $image . ".jpg";  


        $sql = "INSERT INTO imagePaths(Username, imagePath) VALUES ('$uname', '$imageB')";
            
		if ($conn->query($sql) === TRUE) {
            header('Location: photos.php');
            exit();
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
            exit();
		}
        
		$conn->close();
?>