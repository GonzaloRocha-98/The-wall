<?php
session_start();
include('PHP/auth.php');
include('PHP/BD.php');
if(isset($_SESSION['nombre'])){
    $id=$_SESSION['id'];
}
else{
    header('Location: Index.php');
    exit(); 
};
$auth=new auth();
if(isset($_POST['confirmarCambio'])){      
    if($auth->validarPasw($_POST['contraActual'],$id,$conn)){    
        if(isset($_POST['nuevoNombre'])){
            $nombre=$_POST['nuevoNombre'];
            }
            else{
                $nombre=$_SESSION['nombre'];
            }
        if(isset($_POST['nuevoApellido'])){
            $apellido=$_POST['nuevoApellido'];
            }
            else{
                $apellido=$_SESSION['apellido'];
            }
        if(isset($_POST['nuevoEmail'])){
            $email=$_POST['nuevoEmail'];
            }
            else{
                $email=$_SESSION['email'];
            }
        if(isset($_POST['nuevaContra'])){
            $nuevaContrasenia=$_POST['nuevaContra'];
            $repetircontrasenia=$_POST['repetirNuevaContra'];
            }
            else{
                $nuevaContrasenia="";
                $repetircontrasenia="";
            }

        $foto = $_FILES['foto']['tmp_name'];
        $tipo = $_FILES['foto']['type'];
            
        $aux=$auth->usuarioCambiarDatos($nombre, $apellido, $email, $nuevaContrasenia, $repetircontrasenia, $foto, $tipo, $id ,$conn);
        if ($aux){
            header('Location: MiPerfil.php');
        }
   }else{
       
   }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/EditarPerfil.css">
    <script type="text/javascript" src="JS/JQuery.js"></script>
    <script type="text/javascript" src="JS/EditarPerfil.js"></script>
</head>
<body>
    <header>
        <div id="header">
            <img id="logo" src="./img/TheWallLogo.png" height="100" width="220">
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
    <div id="cambiar-datos" class="muro">
    <?php
                if ($auth->getError() != null){
                    foreach ($auth->getError() as $value){
                        echo ("<div class='alerta' >
                        ". $value . "
                      </div>");
                        }
                     }
                ?>
            <div id="datos">
                <form enctype="multipart/form-data" id="modificar-datos" method="POST" style="text-align:center;margin:auto;width: 80%; display:flex-box" >
                <div>
                    <input class="tamanioCajaModificarDatos" name="nuevoNombre" value="<?php echo($_SESSION['nombre'])?>" id="cambioNombre" type="text" disabled="" >
                    <input type="button" class="botonesHabilitarInput" name="" value="Editar Nombre" onclick="activarInputNombre()"><br><br>
                    <input class="tamanioCajaModificarDatos" name="nuevoApellido" value="<?php echo($_SESSION['apellido']) ?>" id="cambioApellido" type="text" disabled="">
                    <input type="button" class="botonesHabilitarInput" name="" value="Editar Apellido" onclick="activarInputApellido()"><br><br>
                    <input class="tamanioCajaModificarDatos" name="nuevoEmail" value="<?php echo($_SESSION['email']) ?>" id="cambioEmail" type="text" disabled="">
                    <input type="button" class="botonesHabilitarInput" id=habilitarEmail name="" value="Editar Email" onclick="activarInputEmail()"><br><br>
                    <input type="password" class="tamanioCajaModificarDatos" name="nuevaContra" id="cambioContraseña" placeholder="Ingrese su nueva contraseña" type="text" disabled=""><br><br>
                    <input type="password" class="tamanioCajaModificarDatos" name="repetirNuevaContra" id="cambioRepetirContraseña" placeholder="Repita su nueva contraseña" type="text" disabled="">
                    <input type="button" class="botonesHabilitarInput" name="" value="Editar contraseña" onclick="activarInputsContraseña()"><br><br>
                    
                    <p>Contraseña actual:</p><input type="password" name="contraActual" class="tamanioCajaModificarDatos" id="contraseña" type="text"><br><br>
                </div>
                <div id="cambiar-foto" style="float:rigth; margin-rigth:2px;">
                        <img src="<?php $str = $_SESSION['id'];
                                echo ("PHP\mostrarimagen.php?id=$str&img=foto&tab=usuarios"); ?>" id="img" class="foto-perfil" height="210" width="195">
                        <div class="ingresarNuevaFoto">
                            <p id="textoFoto">Ingrese su nueva foto de perfil:</p>
                            <input type="file" id="foto" name="foto" onchange=mostrar() accept="image/*">
                        </div>
                </div>
                <input class="boton" type="submit" name="confirmarCambio" id="boton-confirmarCambio" value="Confirmar cambio">
                </form>
            </div>
        </div>
 
        <footer>Gonzalo Rocha- Matias Paz Francoz</footer>
</body>

</html>