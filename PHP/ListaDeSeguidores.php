<?php
function ListaDeSeguidores($id){
    include("BD.php");
    $query = "SELECT usuarioseguido_id FROM siguiendo WHERE usuarios_id = ".$id;
    $result = mysqli_query($conn, $query);
    $array=[];
    while($row=mysqli_fetch_array($result)){
        array_push($array,$row['usuarioseguido_id']);
    };
    arsort($array);
    return($array);}
?>