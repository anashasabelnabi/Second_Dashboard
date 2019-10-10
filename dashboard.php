<?php
session_start();
if (isset($_SESSION['username'])) {
  echo 'Welcome'.$_SESSION['username']; 
}else{
  
  header('Location: login/login/index.php');
  echo "not prmetied broo";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
body{
    color: #404E67;
    background: #F5F7FA;
    font-family: 'Open Sans', sans-serif;
  }
  .table-wrapper {
    width: 700px;
    margin: 30px auto;
        background: #fff;
        padding: 20px;  
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
    }
  .table-title .add-new i {
    margin-right: 4px;
  }
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
    cursor: pointer;
        display: inline-block;
        margin: 0 5px;
    min-width: 24px;
    }    
  
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
  table.table td a.add i {
        font-size: 24px;
      margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
  table.table .form-control.error {
    border-color: #f50000;
  }
  table.table td .add {
    display: none;
  }
</style>
</head>
<body>  
<?php
  include('dataoperation.php');
  $db = new DataOperation();
?>
<div class="container">
    <div class="table-wrapper">
            <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Dashboard</h2></div>
                    <div class="col-sm-4">
                      <a class="btn btn-info add-new" title="add"  href="<?= 'add.php' ?>"><i class="fa fa-plus"></i>Add Book</a>
                      <a class="btn btn-info add-new" title="add"  href="<?= 'list_of_users.php' ?>">List Of Users</a>
                    </div>
                </div>
            </div>
      <table class="table table-bordered" border="2" style="width:100%">
      
        <tr>
          <th>Book_ID</th>
          <th>Title</th> 
          <th>Actions</th>
        </tr>                            
        <?php 
          $mydata=$db->fetch_data("books");
          foreach ($mydata as $row){
        ?>            
           <tr> 
              <td><?= $row['id'] ?></td>
              <td><?= $row['title'] ?></td>
              <td>   
              <a class="edit" cl title="Edit" data-toggle="tooltip" href="<?= 'edit.php?id='.$row['id'] ?>"><i class="material-icons">&#xE254;</i></a>
              <?php 
                
                if (isset($_POST["delete"])){
                    $id= $_POST['id'];
                    $where = array("id"=>$id);
                   if ($mydata=$db->delete_record("books",$where)) {
                       header('Location: dashboard.php?msg=Records Deleted successfully.');   
                   } 
                }
              ?>
              <form  method="POST" >
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="submit" class="btn btn-info add-new" name="delete" value="Delete" >
              </form>
              </td>
           </tr>
           <?php } ?>
      </table> 
      <a class="btn btn-info add-new" title="add"  href="<?= 'logout.php' ?>">logout</a> 
    </div>
</div>            
</body>
</html>                            