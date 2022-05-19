<?php 

$con=new mysqli("localhost","root","","blooddb");
if($con->connect_error)
{
	echo "Database Connection Failed";
}

?>