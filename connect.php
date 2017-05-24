<?php
$servername = "dcm.uhcl.edu";
$username = "bogimanevijayakn";
$password = "1546184";
$dbname = "sakila";
// connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
	 printf("Can't connect to MySQL Server. Errorcode: %s\n", 
       mysqli_connect_error());
   exit;
}	
	
?>