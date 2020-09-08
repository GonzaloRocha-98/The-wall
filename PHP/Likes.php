<?php
function likes($id){
    include('BD.php');
    $mensaje_id=$id;
    $query = "SELECT count(*) as total from me_gusta where mensaje_id=".$mensaje_id;
    $result=mysqli_query($conn, $query);
    $likes=mysqli_fetch_assoc($result);
    return($likes['total']);
}
?>