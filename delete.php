<?php
require('dbcon/db_connection.php');
$id=$_GET['delid']; 
$res=mysqli_query($conn,"SELECT* from students WHERE id=$id limit 1");
if($row=mysqli_fetch_array($res)) 
{
$deleteimage=$row['photo']; 
}
$folder="images/";
unlink($folder.$deleteimage);
$result=mysqli_query($conn,"DELETE from students WHERE id=$id") ; 
if($result)
{
	 header("location:index.php");
}
?> 

?>