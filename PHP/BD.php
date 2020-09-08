<?php
$dbServername='localhost';
$dbUsername='root';
$dbPassword='';
$dbName='thewall';
//conexion
   $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName);
   if(mysqli_connect_errno()){
     echo('Verifique la coneccion a la BD ->'.mysqli_connect_error());
    };
?>