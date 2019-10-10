<?php

include('dbconfig.php');
class DataOperation extends dbconfig{

	
	public function insert_record($table , $fields){
	  	// "INSERT INTO books (id,name,) values ('','','')"
	  	$sql = "INSERT INTO ".$table;
	  	$sql .= "(".implode(",", array_keys($fields)).") values";
	  	$sql .= "('".implode("','", array_values($fields))."')"; 
	  	$query = mysqli_query($this->conn ,$sql);
	  	echo $sql;
	  	if ($query) {
	  		return true;	
	  	}
	  	return false;
	}
	public function fetch_data($table){
		//"select * from books"
		$sql="SELECT * FROM ".$table ;
		$array =array();
		$query = mysqli_query($this->conn ,$sql);
		while ($row=mysqli_fetch_assoc($query)) {
			$array[] = $row;    
		}
		return $array;
	}
	public function select_data($table,$columns,$where= null ){
		$condition ="";
		foreach ( $where as $key => $value) {
			// id='5' AND name = 'something'
			$condition .= $key ."='" . $value ."' AND ";	
		}
		$condition = substr($condition, 0 , -5);
		//"SELECT id , tile from books where id = id"
		$sql ="SELECT ".$columns." FROM ".$table;
		if ($where) {	
			$sql .=" where ".$condition;
 		}
 	
		$query = mysqli_query($this->conn ,$sql);
		$row=mysqli_fetch_array($query); 
		return $row;
	}
	public function update_data($table,$where = null ,$fields){
		//"update books set id='$id' , tile='$tilte'  where id = id"
		$condition ="";
		$sql = "";
		foreach ( $where as $key => $value) {
			// id='5' AND name = 'something'
			$condition .= $key . "='" . $value ."' AND ";	
		}
		$condition = substr($condition, 0 , -5);	
		foreach ($fields as $key => $value) {
			//  tile = '' , author  = '';
			$sql .= $key . "='".$value."', ";			
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		/*if ($where) {	
			$sql .=" WHERE ".$condition;
 		}*/
		if (mysqli_query($this->conn ,$sql)) {
			return true ;	
		}
	}


    public function delete_record($table,$where){
    	$condition ="";
		$sql = "";
		foreach ( $where as $key => $value) {
			// id='5' AND name = 'something'
			$condition .= $key . "='" . $value ."' AND ";	
		}
		$condition = substr($condition, 0 , -5);
		// delete from table where id = id
		$sql = " DELETE FROM ".$table." WHERE " .$condition;	
		echo $sql ;
		if (mysqli_query($this->conn ,$sql)) {
			return true ;
    	} 
			
    }
}
?>