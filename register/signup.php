	<?php
        session_start();

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
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    
		
		if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"],
		$target_file)) {
              echo "The file". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
		} else {
		      echo "Sorry, there was an error uploading your file.";
		}

        
        $userName = $_POST["uname"];
        $email = $_POST["eml"];
        $passWord = $_POST["psw"];
        $image=basename($_FILES["imageUpload"]["name"],".jpg");
		$imageB = "uploads/" . $image . ".jpg";  


        $sql = "INSERT INTO users(Username, Email, Password, imagePath) VALUES ('$userName', '$email', '$passWord', '$imageB')";
		if ($conn->query($sql) === TRUE) {
            echo "Welcome";
            header('Location: ../home/home.php');
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
        
		$conn->close();
	?>	
