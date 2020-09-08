<?php
include('PHP/Publicaciones.php');
include('PHP/BD.php');
include('PHP/ListaDeSeguidores.php');
session_start();
if(isset($_SESSION['nombre'])){

}
else{
    header('Location: Index.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/PerfilAjeno.css">
    <script type="text/javascript" src="JS/JQuery.js"></script>
    <script type="text/javascript" src="JS/PerfilAjeno.js"></script>
</head>
<body>
    <header>
        <div id="header">
            <img id="logo" src="img/TheWallLogo.png" height="100" width="220">
            <form>
                    <div id="buscador">
                        <img id="lupa" src="./img/lupa.png" alt="">
                        <input id="barra" class="busca" type="text" placeholder="Buscar.."> 
                    </div>  
            </form>
            <nav class="navegacion">
                <a href="Inicio.php"><img src="Iconos\icons-inicio.png" height="50" width="50"> </a>
                <a href="MiPerfil.php"><img src=<?php $str=$_SESSION['id']; echo("PHP\mostrarimagen.php?id=$str&img=foto&tab=usuarios");?> id="foto-perfil"> </a>
                <a href="PHP/desloguear.php"><img src="Iconos\icons-cerrarSesion.png" height="50" width="50"> </a>
            </nav>
        </div>
    </header>
    <div id="display"></div>
    <div id="main" class="main">
        <div id="perfil" class="perfil">
            <?php
            $id = $_GET['id'];
            $query = "SELECT * FROM usuarios WHERE id=$id";        
            $result= mysqli_query($conn, $query);    
            $lista_seguidos=ListaDeSeguidores($_SESSION['id']);
            while($row=mysqli_fetch_array($result)){
                if(in_array($id,$lista_seguidos))
                    {
                    $str=
                        '<div id="info-perfil">
                            <img class="foto-perfil" src="PHP/mostrarimagen.php?id='.$row['id'].'&img=foto&tab=usuarios") alt="">
                            <div id="descripcion">
                                <p id="nombre" class="letraPerfil">'.$row['nombre'].'</p>
                                <p id="apellido" class="letraPerfil">'.$row['apellido'].'</p>
                                <p id="usuario" class="letraPerfil">'.$row['nombreusuario'].'</p>
                            </div>
                            <div id="boton">
                            <input onclick=dejar("'.$row['nombreusuario'].'") id="'.$row['nombreusuario'].'" class="boton"  type="submit" value="Dejar de seguir">
                            </div>
                        </div>';
                    }else{
                    $str=
                    '<div id="info-perfil">
                        <img class="foto-perfil" src="PHP/mostrarimagen.php?id='.$row['id'].'&img=foto&tab=usuarios") alt="">
                        <div id="descripcion">
                            <p id="nombre" class="letraPerfil">'.$row['nombre'].'</p>
                            <p id="apellido" class="letraPerfil">'.$row['apellido'].'</p>
                            <p id="usuario" class="letraPerfil">'.$row['nombreusuario'].'</p>
                        </div>
                        <div id="boton">
                        <input onclick=dejar("'.$row['nombreusuario'].'") id="'.$row['nombreusuario'].'" class="boton"  type="submit" value="Seguir">
                        </div>
                    </div>';
                          
                        };
                } 
                
            echo("$str");
            ?>
        </div>
        <?php
        if(isset($_GET['indice'])){
             $indice= $_GET['indice'];
        }
        else{
            $indice=0;}
        $array_id =[];
        array_push($array_id,$_GET['id']);
            $array = publicaciones($array_id, $indice);
            foreach($array as $key){
                echo($key);
            }
            $str='<div id="ver-más">';
            $tamaño_array = count($array);
            if($indice > 0){
                $indiceAnt=$indice - 10;
                $str.='<a href="MiPerfil.php?indice='.$indiceAnt.'">Mas Reciente</a>';
            }
            $indice=$indice+10;
            if($tamaño_array ==10){
                $str.='
                <a href="MiPerfil.php?indice='.$indice.'" >Mas Antiguo</a>';
            };
            $str.=   '</div>';
            echo($str);
            ?>
    </div>
    <footer>Gonzalo Rocha- Matias Paz Francoz</footer>
</body>

</html>