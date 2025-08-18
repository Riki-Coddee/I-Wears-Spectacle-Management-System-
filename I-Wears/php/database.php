<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername="localhost";
$username="root";
$password="";
$database="Iwear";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo("Sorry we failed to connect:".mysqli_connect_error());
}

?>