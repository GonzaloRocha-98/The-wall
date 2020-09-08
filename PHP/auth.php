<?php
include('BD.php');

class auth
{
  
  private $error = array();

  private function setError($e){
    $this->error[] = $e;
  }

  public function getError(){
    return $this->error;
  }
  
  public function verificar_email($email){
    if ( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
      return true;
    }
    else{
      $this->setError('Verificar el email');
      return false;
    }
  }
  
  public function verificar_nombre($nombre){
    if (!empty($nombre) && ctype_alpha(str_replace(' ', '', $nombre))){
      return true;
    }
    else{
      $this->setError('Verifica el nombre');
      return false;
    }
  }
  public function verificar_apellido($apellido){
    if (!empty($apellido) && preg_match('/^[a-z\s]*$/i', $apellido)){
      return true;
    }
    else{
      $this->setError('Verificar apellido');
      return false;
    }
  }

  public function verificar_usuario($usuario){
    if(!empty($usuario) && strlen($usuario)>5 && ctype_alnum($usuario)){
      return true;
    }
    else{
      $this->setError('Verificar usuario');
      return false;
    }
  }
  public function verificar_contrasenia($psw, $repeatpsw){
      $uppercase = preg_match('@[A-Z]@', $psw);
      $lowercase = preg_match('@[a-z]@', $psw);
      $specialChars = preg_match('@[^\w]@', $psw);
      $number = preg_match('@[0-9]@', $psw);
      if($lowercase && $uppercase && ($number || $specialChars) && strlen($psw)>5 && ($psw==$repeatpsw)) {
        return true;
      }
      else{
        $this->setError('Contraseña Incorrecta');
        return false;
      }
    }

  public function usuarioRegistrar($email, $nombre, $apellido, $usuario, $contrasenia, $repetircontrasenia, $data, $tipo, $conn){
    if($this->verificar_email($email) && $this->verificar_nombre($nombre) && $this->verificar_apellido($apellido) &&  $this->verificar_usuario($usuario) && $this->verificar_contrasenia($contrasenia, $repetircontrasenia)) {
      $query=mysqli_query($conn,"SELECT nombreusuario FROM usuarios WHERE nombreusuario='$usuario'");
      $nume_rows=mysqli_num_rows($query);
      if($nume_rows==1){
        $this->setError("El nombre de usuario no esta disponible");
        return false;
      }
      else {
        $query=mysqli_query($conn,"INSERT INTO usuarios(id,apellido,nombre,email,nombreusuario,contrasenia,foto_contenido,foto_tipo) 
        VALUES ('','$apellido','$nombre','$email','$usuario','$contrasenia', '$data', '$tipo')");
        return true;
      }
    }
    else{   
      return false;
    }
  }
  public function usuarioCambiarDatos($nombre, $apellido, $email, $nuevaContrasenia, $repetircontrasenia, $foto, $tipo, $id ,$conn){
    $update="UPDATE usuarios SET ";
    if($nombre != ""){
      if($this->verificar_nombre($nombre)){
        $update.= "nombre= '$nombre'";
        }
        else{
          $this->setError("Nombre no válido");
        }
      };
    if($apellido != ""){
      if($this->verificar_apellido($apellido)){
        $update.=", apellido= '$apellido'";
        }
        else{
          $this->setError("Apellido no válido");
        }
      };
    if($email != ""){
      if($this->verificar_email($email)){
        $update.=", email='$email'";
        }
        else{
          $this->setError("Email no válido");
        }
      };
    if($nuevaContrasenia != ""){
      if($this->verificar_contrasenia($nuevaContrasenia, $repetircontrasenia)){
        $update.= ", contrasenia='$nuevaContrasenia'";
        }
        else{
          $this->setError("Contraseña no válida");
        }
      };
    if($foto != null){
      $data=file_get_contents($foto);
      $data=mysqli_escape_string($conn,$data);
      $update.=", foto_contenido = '$data', foto_tipo = '$tipo'";
      };
    $update.= " WHERE id =".$id;
    $query=mysqli_query($conn,$update);
    if($query){
      $_SESSION['nombre']=$nombre;
      $_SESSION['apellido']=$apellido;
      $_SESSION['email']=$email;
      return true;
    }
    else{
      return false;
    }
  }

  public function inicioSesion($usuario, $contrasenia, $conn){
        $user=$usuario;
        $password=$contrasenia;
        $test=false;
        try{
        $result=mysqli_query($conn,"SELECT * from usuarios WHERE nombreusuario='$user' AND contrasenia='$password'");
        while($columna=mysqli_fetch_array($result,MYSQLI_ASSOC)){
          session_start();
          $_SESSION['nombre']=$columna['nombre'];
          $_SESSION['apellido'] = $columna['apellido'];
          $_SESSION['email'] = $columna['email'];
          $_SESSION['nombreusuario'] = $columna['nombreusuario'];
          $_SESSION['id']=$columna['id'];
          $test=true;
        }
        if($test==false){
          throw new Exception ("Verifique sus Datos");
        }
      }catch(Throwable $e){
        $this->setError($e->getMessage());
      }
    }
  
  public function validarPasw($contra,$id,$conn){
    $sql=mysqli_query($conn, "SELECT `contrasenia`FROM `usuarios` WHERE id='$id'");
    $columna=mysqli_fetch_array($sql,MYSQLI_ASSOC);
    $psw=$columna['contrasenia'];
    if($this->verificar_contrasenia($contra,$psw)){
      return true;
    }else{
     return false;
    }
   }
}
?>