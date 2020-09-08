<?php
  include('PHP/auth.php');
  include('PHP/BD.php');
  $auth=new auth();
  if(isset($_POST['registrar'])){ 
    $email=$_POST['email'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $usuario=$_POST['usuario'];
    $contrasenia=$_POST['contrasenia'];
    $repetircontrasenia=$_POST['repetircontrasenia'];
    $foto = $_FILES['foto']['tmp_name'];
    $tipo = $_FILES['foto']['type'];
    if($foto != null){
        $data=file_get_contents($foto);
        $data=mysqli_escape_string($conn,$data);
        $aux=$auth->usuarioRegistrar($email, $nombre, $apellido, $usuario, $contrasenia, $repetircontrasenia, $data, $tipo, $conn);
            if ($aux){
                header('Location: Inicio.php');
            }
        }
    }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="CSS/Registro.css">
    <script type="text/javascript" src="JS/Funciones.js"></script>
    <script type="text/javascript" src="JS/JQuery.js"></script>
</head>

<body>
<div id="caja-registro">
        <div class="registro">
            <h1 style="text-align: center;">Crear Usuario</h1><br>
            <script type="text/javascript">
                function chequearcampo(){
                    if ($("#email-reg").val() != "" && $("#nombre-reg").val() != "" && $("#apellido-reg").val() != "" && $("#usuario-reg").val() != "" && $("#contraseña-reg").val() != "" && $("#repetir-contraseña-reg").val() != ""){
                        document.getElementById("boton-registrar").disabled = false;
                    }else{
                        document.getElementById("boton-registrar").disabled = true;
                    }
                };
            </script>
            <form enctype="multipart/form-data"  method="post"  >
                <label for="email-reg">Email:</label><br>
                <input type="text" name="email" id="email-reg" class="campo" placeholder="Email" onkeypress=chequearcampo()><br><br>
                <label for="nombre-reg">Nombre:</label><br>
                <input type="text" name="nombre" id="nombre-reg" class="campo" placeholder="Nombre" onkeypress=chequearcampo()><br><br>
                <label for="apellido-reg">Apellido:</label><br>
                <input type="text" name="apellido" id="apellido-reg" class="campo" placeholder="Apellido" onkeypress=chequearcampo()><br><br>
                <p>Foto de perfil</p><br>
                <input type="file" id="foto" name="foto" accept="image/*" onchange=mostrar() ><br><br>
                <img src="" width="150px" height="150px" id="img" alt=""><br>
                <label for="usuario-reg">Usuario: </label><br>
                <input type="text" name="usuario" id="usuario-reg" class="campo" placeholder="Min. 6 caracteres" onkeypress=chequearcampo() >
                <p style="font-size: 12px;">*Solo caracteres Alfanuméricos</p><br><br>
                <label for="contraseña-reg">Contraseña: </label><br>
                <input type="password" name="contrasenia" id="contraseña-reg" class="campo" placeholder="Min. 6 caracteres" onkeypress=chequearcampo() >
                <p style="font-size: 12px;">*Por lo menos una letra mayúscula, minúscula y númer/simbolo.</p><br><br>
                <label for="repetir-contraseña-reg"> Repetir contraseña: </label><br>
                <input type="password" name="repetircontrasenia" id="repetir-contraseña-reg" class="campo" onkeypress=chequearcampo()><br>
                <p style="font-size: 60%;">
                    Al hacer clic en "Registrarte", aceptas nuestras Condiciones, la 
                    Política de datos y la Política de cookies. Es posible que te 
                    enviemos notificaciones por SMS, que puedes desactivarlas 
                    cuando quieras.</p><br> 
                <?php
                if ($auth->getError() != null){
                    foreach ($auth->getError() as $value){
                        echo ("<div class='alerta' >
                        ". $value . "
                      </div>");
                        }
                     }
                ?>
                <div id="boton-registro">
                    <button type="submit" id="boton-registrar" name="registrar" disabled="true"  onclick=validar()>Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <footer>Gonzalo Rocha- Matias Paz Francoz</footer>
</body>

</html>