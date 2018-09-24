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
      <h2>My photo gallery</h2>
    </div>
    
    <form action="set.php" method="post" enctype="multipart/form-data">

        <input type="file" id="files" required accept="image/jpg" name="imageUpload" >
        <label for="files" id="picSel">Add picture</label>
        <button type="submit" name="submit" id="uploadImg">Upload</button>
        
    </form>
    
    <p id="break">  </p>
    <div id="photoBox">
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
                    echo '<img src="' . $row["imagePath"] . ('"') . (' style="width:280px; height:280px;" ') . '>';
            }
		} else {
		      echo "<p> No Image to display <p>";
		}
		
	?>
    </div>
</body>

</html>