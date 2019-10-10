<?php
session_start();
if (isset($_SESSION['username'])) {
  echo 'Welcome'.$_SESSION['username']; 
}else{
  
  header('Location: login/login/index.php');
  echo "You are not allowed to enter this page";
}
include('dataoperation.php');
$db = new DataOperation();
$errors = [];
$id=$_GET['id'];
	if (!empty($id)) 
	{
		$where = array("id"=>$id,);
		$mydata=$db->select_data("books","*",$where);
		$old_title = $mydata[1];
		$old_rate = $mydata[2];
		$old_author_id = $mydata[3];
		$old_published_at = $mydata[4];
		$old_image_path = $mydata[5];
		$old_author_name = $mydata[6];
		
	}

	if (count($_POST) > 0)
	{
			$title = $_POST['title'];
			$rate = $_POST['rate'];
			$author_id = $_POST['author_id'];
			$published_at = $_POST['published_at'];
			$image_path = $_FILES['image_path']['name'];
			$author_name= $_POST['author_name'];
			if (empty($_FILES['image_path']['tmp_name'])) {
					$image_path = $old_image_path;
			}

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

		
				if(isset($_POST['edit'])){
					if (empty($errors)){
						$id=$_GET['id'];
						$where = array("id"=>$id);
						$myarray = array(
							"title"=>$_POST["title"],
							"rate"=>$_POST["rate"],
							"author_id"=>$_POST["author_id"],
							"published_at"=>$_POST["published_at"],
							"image_path"=>$_FILES['image_path']['tmp_name'],
							"author_name"=>$_POST["author_name"]);
		 				if ($mydata=$db->update_data("books",$where,$myarray)){

		 					move_uploaded_file($_FILES['image_path']['tmp_name'], "pictures/".$image_path);
		 					header('Location: dashboard.php');	
		 					
		 				}
						
						
				       

						/*$sql ="UPDATE books SET  title='$title', rate ='$rate ',author_id ='$author_id',published_at ='$published_at',image_path='$image_path' , author_name='$author_name' Where id='$id'" ;
				
				//if(mysqli_query($db, $sql))
				//{
					
				//} else
				//{
				    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
				//}*/
				}
			
			}
		}	
					
				
			
				
?>

<!DOCTYPE html>
<html>
<head>
	<title>Library System</title>
</head>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<form class="form-horizontal"  method="post" enctype="multipart/form-data" >
<fieldset>

<!-- Form Name -->
<legend>Books</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" value="<?= $old_title?>" class="form-control input-md" type="text">
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
  <input id="rate" name="rate" type="number" value="<?= $old_rate ?>" class="form-control input-md"  type="text">
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
    <input  class="form-control" id="author_id" name="author_id" value="<?= $old_author_id ?>" type="number">
  </div>
</div>
<?php

  	if(array_key_exists('author_id', $errors)){
  		echo "<p style='color:red'>The ".$errors['author_id']." </p>";
  	}
	
  ?> 



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="published_at">Published At</label>  
  <div class="col-md-4">
  <input id="published_at" name="published_at" value="<?= $old_published_at ?>" class="form-control input-md" required="" type="date">
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
    <img src="pictures/<?= $old_image_path ?>" width="150">
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
  <input id="author_name" name="author_name" placeholder="Author_Name" class="form-control input-md" value="<?= $old_author_name ?>" required="" type="text">
  <?php

  	if(array_key_exists('author_name', $errors)){
  		echo "<p style='color:red'>The ".$errors['author_name']." </p>";
  	}
  ?>   

    
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="edit">Edit</label>
  <div class="col-md-4">
    <button id="edit" name="edit" type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>