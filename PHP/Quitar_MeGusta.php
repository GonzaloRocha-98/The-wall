<?php
    include("BD.php");
    session_start();
    $id = $_SESSION['id'];
    $id_mensaje = $_POST['id_mensaje'];
    $query3='DELETE FROM me_gusta where mensaje_id='.$id_mensaje.' AND usuarios_id='.$id;
    $result3=mysqli_query($conn,$query3);

?>