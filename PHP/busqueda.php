<?php
include('BD.php');
if($_POST['palabra']){
    session_start();
    $q=$_POST['palabra']; //se recibe la cadena que queremos buscar
    $sql_res=mysqli_query($conn,"select * from usuarios where id not in(select id from usuarios where id=".$_SESSION['id'].") and (nombre like '%$q%' or apellido like '%$q%' or nombreusuario like '%$q%')");
    while($row=mysqli_fetch_array($sql_res)){
        $id=$row['id'];
        $nombre=$row['nombre'];
        $apellido= $row['apellido'];
        //$direc=$row['direccion'];
        //$foto=$row['foto_contenido'];
         $str='   
        <a href="PerfilAjeno.php?id='.$id.'" style="text-decoration:none;" > <!--Recuperamos el id para pasarlo a otra pagina -->
        <div class="display_box" align="left">
        <div style="float:left; margin-right:6px;"><img src="'."PHP/mostrarimagen.php?id=".$row['id']."&img=foto&tab=usuarios".'" width="60" height="60" ></div> <!--Colocamos la foto Recuperada de la bd -->
        <div style="margin-center:6px;"><b>'.$nombre.' '.$apellido.'</b></div> <!--Recuperamos el nombre recuperado de la bd -->
        <div style="margin-right:6px; font-size:14px;" class="desc">'.$row['nombreusuario'].'</div></div> <!--Recuperamos la direccion recuperada de la bd -->
        </a>
        ';
        echo($str);
        }
    }
    else
    {

    }
?>


