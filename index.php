<?php  
require("db.php");
if(isset($_POST['submitBtn']) && !empty($_POST['submitBtn'])) {
    if(isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
        //Allowed file type
        $allowed_extensions = array("jpg","jpeg","png","gif");
    
        //File extension
        $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));
    
        //Check extension
        if(in_array($ext, $allowed_extensions)) {
           //Convert image to base64
           $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
           $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
           $query = "INSERT INTO images (id, encoded_image) VALUES (NULL, 'sachithaaa');";
			
//			echo("<br>");
//			echo($query);
//			echo("<br>");
           mysqli_query($con, $query);
//			echo($encoded_image);
//			$con->query($query);
           echo "File name : " . $_FILES['uploadFile']['name'];
           echo "<br>";
           if(mysqli_affected_rows($con) > 0) {
              echo "Status : Uploaded";
              $last_insert_id = mysqli_insert_id($con); 
           } else {
              echo "Status : Failed to upload!";
           }
       } else {
           echo "File not allowed";
       }
  }
}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" id="form" enctype="multipart/form-data">
     Upload image : 
     <input type="file" name="uploadFile" value="" />
     <input type="submit" name="submitBtn" value="Upload" />
</form>
<?php
	echo '<img src="'.$encoded_image.'" width="250">';
if($last_insert_id) {
  $query = "select `encoded_image` from `images` where `id`= ". $last_insert_id;
  $result = mysqli_query($con, $query);
  if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_object($result);
    echo "<br><br>";
    
  }
}
?>
</body>
</html>