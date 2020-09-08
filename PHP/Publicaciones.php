<?php 
    function publicaciones($array_id, $indice){
    include("Likes.php");
    include('BD.php');
    $id = $_SESSION['id'];
    $query= "SELECT * FROM mensaje WHERE usuarios_id IN";
    $valores = " (";
    foreach($array_id as $value){
        $valores .= $value.",";
    }
    $valores = trim($valores, ',');
    $valores.=")";
    $query.=$valores."order by fechayhora desc limit $indice,10"; // limit a,b(a partir de a toma b filas)
    $result = mysqli_query($conn, $query);
    $array=[];
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $query2 = "SELECT * FROM usuarios WHERE id= ".$row['usuarios_id'];
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_array($result2);
        $likes= likes($row['id']);
        $aux = "SELECT count(*) as cant from me_gusta where usuarios_id =".$id." and mensaje_id=".$row['id'];
        $result3=mysqli_query($conn, $aux);
        $me_gusta=mysqli_fetch_assoc($result3);
        if($me_gusta['cant'] >0){
            $mg = "Quitar Me Gusta";
        }
        else{
            $mg="MeGusta";
        };
        if($row['usuarios_id']!=$id){
            $str='        
            <div id="publicacion" class="muro">
                <div class="informacion-user">
                    <a href="PerfilAjeno.php?id='.$row2['id'].'"><img id="foto-user" class="foto-user" src= "PHP\mostrarimagen.php?id='.$row['usuarios_id'].'&img=foto&tab=usuarios"
                    <a href="PerfilAjeno.php?id='.$row2['id'].'" id="nombre-user" class="nombres">'.$row2['nombre'].' '.$row2['apellido'].'</a>
                    <p id="fecha-hora">'.$row['fechayhora'].'</p>
                </div>
                <div id="post">
                    <div id="text-post">
                        <p>'.$row['texto'].'</p>
                    </div>
                    <div id="imagen-post">
                        <img id="imagen'.$i.'" class = "imagen"src="PHP\mostrarimagen.php?id='.$row['id'].'&img=imagen&tab=mensaje"; onerror = display("imagen'.$i.'") >
                    </div>
                    <div class="reacciones">
                        <a >'.$likes.' Me Gusta</a>&nbsp;&nbsp;&nbsp;
                    </div>
                    <input type="submit" onclick=me_gusta("'.$row['id'].'") id='.$row['id'].'  class="boton" name="" value="'.$mg.'">
                    </div>
            </div>';
        }
        else{
            $str='        
            <div id="publicacion" class="muro">
                <div class="informacion-user">
                <input type="submit" onclick=borrar("'.$row['id'].'")  class="boton" name="" value="Borrar" style="float:right; margin-rigth:2px; border:none">
                    <a href="MiPerfil.php"><img id="foto-user" class="foto-user" src= "PHP\mostrarimagen.php?id='.$row['usuarios_id'].'&img=foto&tab=usuarios"
                    <a href="MiPerfil.php" id="nombre-user" class="nombres">'.$row2['nombre'].' '.$row2['apellido'].'</a>
                    <p id="fecha-hora">'.$row['fechayhora'].'</p>
                </div>
                <div id="post">
                    <div id="text-post">
                        <p>'.$row['texto'].'</p>
                    </div>
                    <div id="imagen-post">
                        <img id="imagen'.$i.'" class = "imagen"src="PHP\mostrarimagen.php?id='.$row['id'].'&img=imagen&tab=mensaje"; onerror = display("imagen'.$i.'") >
                    </div>
                    <div class="reacciones">
                        <a >'.$likes.' Me Gusta</a>&nbsp;&nbsp;&nbsp;
                    </div>
                    <input type="submit" onclick=me_gusta("'.$row['id'].'") id='.$row['id'].'  class="boton" name="" value="'.$mg.'">
                    </div>
            </div>';
        };
        array_push($array, $str);
        $i++;
    }
    return($array);}
?>