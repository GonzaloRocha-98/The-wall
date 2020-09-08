<?php
    include("BD.php");
    session_start();
    $id = $_SESSION['id'];
    $mensaje_id = $_POST['mensaje_id'];
    $query = "DELETE FROM me_gusta WHERE mensaje_id=".$mensaje_id;
    $result=mysqli_query($conn, $query);
    $query2='DELETE FROM mensaje where id='.$mensaje_id;
    $result2=mysqli_query($conn,$query2);    
?>