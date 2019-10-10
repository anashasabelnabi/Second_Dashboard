<?php
session_start();
if (isset($_SESSION['username'])) {
  echo 'Welcome'.$_SESSION['username']; 
}else{
  
  header('Location: login/login/index.php');
  echo "not prmetied broo";
}
include('dataoperation.php');
$db = new DataOperation();
$errors = [];
if (count($_POST) > 0){

		$title = $_POST['title'];
		$rate = $_POST['rate'];
		$author_id = $_POST['author_id'];
		$published_at = $_POST['published_at'];
		$image_path = $_FILES['image_path']['name'];
		$author_name = $_POST['author_name'];

		if(strlen($title)==0){
			$errors['title'] = "Title Required";
		}
		if(strlen($rate )==0){
			$errors['rate'] = "Rate Required";
		}
		if(strlen($author_id )==0){
			$errors['author_id'] = "Author_id Required";
		}
		if(strlen($published_at )==0){
			$errors['published_at'] = "Published_at Required";
		}
		if(strlen($image_path )==0){
			$errors['image_path'] = "Image_path Required";
		}
		if(strlen($author_name)==0){
			$errors['author_name'] = "Author_name Required";
		}
 
		if(isset($_POST['add'])){
			if (empty($errors)){
          $data = [
            "title" => $_POST['title'],
            "rate" => $_POST['rate'],
            "author_id" => $_POST['author_id'],
            "published_at" => $_POST['published_at'],
            "image_path" => $_FILES['image_path']['name'],
            "author_name" => $_POST['author_name']
        ];
				if($db->insert_record('books',$data)){
					move_uploaded_file($_FILES['image_path']['tmp_name'], "pictures/".$image_path);
					echo 'Image Uploaded suucefully';
				    header('Location: dashboard.php');
				}
				else{
				    echo "ERROR: Could not able to execute. " . mysqli_error($db->conn);	
				}
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Library System</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="add.php" method="post" enctype="multipart/form-data" >

<fieldset>

<!-- Form Name -->
<legend>Books</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" placeholder="title" class="form-control input-md"  type="text">
  <?php

  	if(array_key_exists('title', $errors)){
  		echo "<p style='color:red'>The ".$errors['title']." </p>";
  	}
	
  ?> 
   
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rate">Rate</label>  
  <div class="col-md-4">
  <input id="rate" name="rate" type="number" placeholder="Rate" class="form-control input-md"  type="text">
  <?php

  	if(array_key_exists('rate', $errors)){
  		echo "<p style='color:red'>The ".$errors['rate']." </p>";
  	}
	
  ?> 
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="author_id">Author ID</label>
  <div class="col-md-4">                     
    <input  class="form-control" id="author_id" name="author_id" placeholder="Author ID" type="number">
    <?php

  	if(array_key_exists('author_id', $errors)){
  		echo "<p style='color:red'>The ".$errors['author_id']." </p>";
  	}
	
  ?> 
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="published_at">Published At</label>  
  <div class="col-md-4">
  <input id="published_at" name="published_at" placeholder="Published At" class="form-control input-md" type="date">
    <?php

  	if(array_key_exists('published_at', $errors)){
  		echo "<p style='color:red'>The ".$errors['published_at']." </p>";
  	}
	
  ?> 
  </div>
</div>

    
 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="image_path">Image</label>
  <div class="col-md-4">
    <input id="image_path" name="image_path" class="input-file" type="file">
    <?php

  	if(array_key_exists('image_path', $errors)){
  		echo "<p style='color:red'>The ".$errors['image_path']." </p>";
  	}
	
  ?> 
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="author_name">title</label>  
  <div class="col-md-4">
  <input id="author_name" name="author_name" placeholder="Author_Name" class="form-control input-md" type="text">
   <?php

  	if(array_key_exists('author_name', $errors)){
  		echo "<p style='color:red'>The ".$errors['author_name']." </p>";
  	}
  ?>   
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add">Add</label>
  <div class="col-md-4">
    <button id="add" name="add" type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>

