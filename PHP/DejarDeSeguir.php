<?php
include("BD.php");
session_start();
$id =$_SESSION['id'];
$nombreusuario = $_POST['nombreusuario'];
$query="SELECT * FROM usuarios WHERE nombreusuario ='".$nombreusuario."'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
    $query2 = "DELETE FROM siguiendo WHERE usuarios_id= '$id' AND usuarioseguido_id =".$row['id'];
    $result2 = mysqli_query($conn,$query2);
}
?>