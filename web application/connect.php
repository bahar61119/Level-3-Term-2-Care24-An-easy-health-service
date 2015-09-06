<?php

$host_name = "localhost";
$host_username = "root";
$host_pass = "";

$con = mysql_connect($host_name,$host_username,$host_pass);

if($con){
    if(mysql_select_db("care24",$con)){
	
	}
	else{
		echo "database error";
		die();
	}
}

else{
	echo "Database Problem";
	die();
}
?>
