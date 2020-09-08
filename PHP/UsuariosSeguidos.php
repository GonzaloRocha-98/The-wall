<?php
session_start();
function Seguidos(){
include("BD.php");
$query = "SELECT usuarioseguido_id FROM siguiendo WHERE usuarios_id = ".$_SESSION['id'];
$result = mysqli_query($conn, $query);
$array=[];
while($row = mysqli_fetch_array($result)){
    $query2="SELECT * FROM usuarios WHERE id = ".$row['usuarioseguido_id'];
    $result2= mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($result2);
    $str =
    '
    <div id="usuario-seguido" >
        <div id="foto-seguidor">
            <a href="PerfilAjeno.php?id='.$row2['id'].'"><img src="PHP/mostrarimagen.php?id='.$row2['id'].'&img=foto&tab=usuarios" height="70" width="70"></a>
        </div>
        <div id="nombre">
            <a href="PerfilAjeno.php?id='.$row2['id'].'" style="text-decoration:none"><p class="letraSeguidor">'.$row2['nombre'].'</p></a>
        </div>
        <div id="usuario">
            <a href="PerfilAjeno.php?id='.$row2['id'].'" style="text-decoration:none"><p class="letraSeguidor">'.$row2['nombreusuario'].'</p></a>
        </div>
        <div id="dejar-de-seguir">
            <input onclick=dejar("'.$row2['nombreusuario'].'") id="'.$row2['nombreusuario'].'" class="boton-dejar-de-seguir" name="dejar-seguido" type="submit" value="Dejar de seguir">
        </div>
    </div>
    <br><br>
    ';
    array_push($array, $str);
}
return($array);
}
?>