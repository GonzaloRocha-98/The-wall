<?php
    include("BD.php");
    session_start();
    $id = $_SESSION['id'];
    $mensaje_id=$_POST['id_mensaje'];
    $query='INSERT INTO me_gusta (usuarios_id, mensaje_id) VALUES ('.$id.', '.$mensaje_id.')';
    $result=mysqli_query($conn,$query);
?>