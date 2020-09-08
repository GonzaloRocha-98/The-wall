<?php
include_once('PHP/BD.php');
include_once('PHP/auth.php');
$auth= new auth();
if(isset($_POST['boton-login'])){
    $usuario=$_POST['usuario'];
    $contrasenia=$_POST['contrasenia'];
    $auth->inicioSesion($usuario, $contrasenia, $conn);
    if(count($auth->getError())==0){
        header('Location: Inicio.php');
    }
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Wall</title>
    <link rel="stylesheet" href="CSS/Index.css">
    <script type="text/javascript" src="JS/JQuery.js"></script>
    <script src="JS/Index.js"></script>
</head>

<body>
    <div id="login" class="login">
        <img src="img/TheWallLogo.png" alt="" width="200px" >
        <form id="logueo"action="" method="post">
            <p>Usuario</p>
            <input type="text" class="campo" id="usuario" name="usuario" id="usuario" placeholder="Usuario" onkeypress=chequearcampo()><br><br>
            <p>Contraseña</p>
            <input type="password" class="campo" id="contrasenia" name="contrasenia" placeholder="Contraseña" onkeypress= chequearcampo()><br><br>
            <input type="submit" class="boton" disabled="true" value="Ingresar" name="boton-login" id="boton-login">
        </form><br>
        <span></span>
        <a href="Registro.php" style="color: blue">Aun no estas registrado?</a>
        <?php 
        echo "<br>";
        if (count($auth->getError())>0) {
            for ($i=0; $i <count($auth->getError()) ; $i++) { 
                echo $auth->getError()[$i];
                echo "<br>";
            }
        }?>
    </div>
    <footer>Gonzalo Rocha- Matias Paz Francoz</footer>
</body>

</html>