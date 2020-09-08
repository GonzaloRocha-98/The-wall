<?php
include('PHP/ListaDeSeguidores.php');
include('PHP/Publicaciones.php');
include('PHP/BD.php');
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
if(isset($_SESSION['nombre'])){
    $nombre=$_SESSION['id'];
}
else{
    header('Location: Index.php');
    exit(); 
}
if (isset($_POST['enviar'])){
    $foto = $_FILES['foto']['tmp_name'];
    $tipo = $_FILES['foto']['type'];
    $post = $_POST['caja-post'];
    $usuario_id= $_SESSION['id'];
    if ($foto != null){
        $data=file_get_contents($foto);
        $data=mysqli_escape_string($conn,$data);
        $foto=$data;
    };
    $hoy = date('Y/m/d H:i:s');
    $query = mysqli_query($conn, "INSERT INTO mensaje(texto, imagen_contenido, imagen_tipo, usuarios_id, fechayhora)
                                VALUES ('$post', '$foto', '$tipo', '$usuario_id', '$hoy')");
    header("Location: Inicio.php");
    };
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="JS/JQuery.js"></script>
    <title>Posteo</title>
    <link rel="stylesheet" href="CSS/Inicio.css">
    <script type="text/javascript" src="JS/Inicio.js"></script>
</head>

<body>
    <header>
        <div id="header">
            <img     id="logo" src="./img/TheWallLogo.png" height="100" width="220">
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
        <div id="new-post" class="muro">
            <div id="caja-new-post">
            <div id="nuevo-estado">
                    <p>Nuevo estado</p>
                </div>         
                <form enctype="multipart/form-data"  method="post">
                    <div id="caja-post">
                        <textarea name="caja-post" id="post"cols="30" rows="10" placeholder="Escribe algo.." onkeyup= chequearPost() ></textarea>
                    </div>
                    <div id="opciones">
                        <p>Subir un archivo: </p>
                        <input type="file" id="foto" name="foto" accept="image/*" onchange=chequearPost() >
                        <input type="submit" id="enviar" name="enviar" class="boton" disabled="true" value="Publicar">
                    </div>
                </form>
            </div>
        </div>
        <?php
        if(isset($_GET['indice'])){
            $indice= $_GET['indice'];
        }
        else{
            $indice=0;}
        $array_id = ListaDeSeguidores($_SESSION['id']);
        array_push($array_id,$_SESSION['id']);
        $array = publicaciones($array_id, $indice);
        foreach($array as $key){
            echo($key);
            }
        $str='<div id="ver-más">';
        $tamaño_array = count($array);
        if($indice > 0){
            $indiceAnt=$indice - 10;
            $str.='<a href="Inicio.php?indice='.$indiceAnt.'">Mas Reciente</a>';
        }
        $indice=$indice+10;
        if($tamaño_array ==10){
            $str.='
            <a href="Inicio.php?indice='.$indice.'" >Mas Antiguo</a>';
        };
        $str.=   '</div>';
        echo($str);
        ?>
    </div>
    <footer>Gonzalo Rocha- Matias Paz Francoz</footer>
</body>

</html>