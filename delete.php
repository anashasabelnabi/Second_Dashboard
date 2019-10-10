<?php
/*
include('dbconfig.php');
$id= $_POST['id'];
if (!empty($id)){
			$sql =" DELETE FROM books  Where id='$id'" ;
			$result=mysqli_query($db, $sql);
			if(mysqli_query($db, $sql))
			{
				echo "Records Deleted successfully.";
				header('Location: dashboard.php');	
			} 
			else
			{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
			}
}
?>
