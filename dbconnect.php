<?php
$servername="localhost";
$username="root";
$password="";
$database="roomrent";

$conn=mysqli_connect($servername,$username,$password,$database);
if($conn){
   // echo "Connection done";
}
else{
    die ("Connection failed because " .mysqli_connect_error());
}

?>