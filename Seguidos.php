<?php
    include('PHP/UsuariosSeguidos.php');
    include('PHP/BD.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Seguidos.css">
    <script type ="text/javascript" src="JS/JQuery.js"></script>
    <script type ="text/javascript" src="JS/Seguidos.js"></script>
</head>

<body>
    <header>
        <div id="header">
            <img id="logo" src="img/TheWallLogo.png" height="100" width="220">
            <form>
                <div id="buscador">
                    <img id="lupa" src="img/lupa.png" alt="">
                    <input id="barra" class="busca" type="text" placeholder="Buscar..">
                </div>
            </form>
            <nav id="navegacion">
                <a href="Inicio.php"><img src="Iconos\icons-inicio.png" height="50" width="50"> </a>
                <a href="MiPerfil.php"><img src="Iconos\icons-perfil.png" height="50" width="50"> </a>
                <a href="PHP/desloguear.php"><img src="Iconos\icons-cerrarSesion.png" height="50" width="50"> </a>
            </nav>
        </div>
    </header>
    <div id="display"></div>
    <div id="main" class="main">
        <div id="Usuarios-seguidos" class="muro">
        <?php
            $array = Seguidos();
            foreach($array as $key){
                echo($key);
            }
        ?>
        </div>
    </div>
    <footer>Gonzalo Rocha- Matias Paz Francoz</footer>

</body>

</html>