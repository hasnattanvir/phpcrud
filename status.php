<?php
require('dbcon/db_connection.php');

$id=$_GET['en_id'];
$status= $_GET['status_pro'];
$q = "update students set status_pro=$status where id=$id";
mysqli_query($conn,$q);

header('location:index.php');

?>