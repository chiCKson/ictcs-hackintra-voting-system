<?php
define('SERVER','localhost:3306');
define('USER','root');
define('PASSWORD','');
define('DATABASE','ictcslk_hackintra');
class DB{
	function connect(){
		$conn = mysqli_connect(SERVER, USER, PASSWORD,DATABASE);
		if (!$conn) {
			die("Connection failed: ".mysqli_connect_error());
		}
		return $conn;
	}	
	function disconnect($conn){
		mysqli_close($conn);
	}
	
	function set_data($conn,$sql){
		if (mysqli_query($conn, $sql)) {
			//nothing
			return true;
		} else {
			return false;
		}
	}
	function get_data($conn,$sql){
		$result = mysqli_query($conn, $sql);
		return $result;
	}
}    
?>