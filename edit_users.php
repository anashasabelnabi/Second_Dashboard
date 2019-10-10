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
$id=$_GET['id'];
	if (!empty($id)) 
	{
		$where = array("id"=>$id,);
		$row=$db->select_data("users","*",$where);
		$old_first_name = $row[1];
		$old_last_name = $row[2];
		$old_email = $row[3];
		$old_password = $row[4];
		$old_mobile = $row[5];
		
	}

	if (count($_POST) > 0)
	{
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$mobile= $_POST['mobile'];

				if(strlen($first_name)==0){
					$errors['first_name'] = "first_name Required";
				}
				if(strlen($last_name )==0){
					$errors['last_name'] = "last_name Required";
				}
				if(strlen($email )==0){
					$errors['email'] = "emailRequired";
				}
				if(strlen($password )==0){
					$errors['password'] = "password Required";
				}
				if(strlen($mobile )==0){
					$errors['mobile'] = "mobile";
				}
				if(isset($_POST['edit'])){
					if (empty($errors)){
						$id=$_GET['id'];
						$where = array("id"=>$id);
						$myarray = array(
							"first_name"=>$_POST["first_name"],
							"last_name"=>$_POST["last_name"],
							"email"=>$_POST["email"],
							"password"=>$_POST["password"],
							"mobile"=>$_POST['mobile']);
		 				$mydata=$db->update_data("users",$where,$myarray);
		 				header('Location: list_of_users.php');	  
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
  <label class="col-md-4 control-label" for="first_name">First Name</label>  
  <div class="col-md-4">
  <input id="first_name" name="first_name" value="<?= $old_first_name?>" class="form-control input-md" type="text">
  <?php

  	if(array_key_exists('first_name', $errors)){
  		echo "<p style='color:red'>The ".$errors['first_name']." </p>";
  	}
	
  ?> 
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Last Name">Last Name</label>  
  <div class="col-md-4">
  <input id="last_name" name="last_name" type="text" value="<?= $old_last_name ?>" class="form-control input-md"  type="text">
    <?php

  	if(array_key_exists('last_name', $errors)){
  		echo "<p style='color:red'>The ".$errors['last_name']." </p>";
  	}
	
  ?> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>
  <div class="col-md-4">                     
    <input  class="form-control" id="email" name="email" value="<?= $old_email ?>" type="email">
  </div>
</div>
<?php

  	if(array_key_exists('email', $errors)){
  		echo "<p style='color:red'>The ".$errors['email']." </p>";
  	}
	
  ?> 



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>  
  <div class="col-md-4">
  <input id="password" name="password" value="<?= $old_password ?>" class="form-control input-md"  type="text">
  <?php

  	if(array_key_exists('password', $errors)){
  		echo "<p style='color:red'>The ".$errors['password']." </p>";
  	}
	
  ?> 
    
  </div>
</div>

    
 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="mobile">Mobile</label>
  <div class="col-md-4">
    <input id="mobile" name="mobile" value="<?= $old_mobile ?>" class="form-control input-md"  type="text">
    
    <?php

  	if(array_key_exists('mobile', $errors)){
  		echo "<p style='color:red'>The ".$errors['mobile']." </p>";
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