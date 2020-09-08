
$(document).ready(function(){
    $(".busca").keyup(function(){ //se crea la funcioin keyup
        var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
        var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php
        if(texto==''){//si no tiene ningun valor la caja de texto no realiza ninguna accion
            //ninguna acción
            $("#display").hide();
        }else{
          //pero si tiene valor entonces
          $.ajax({//metodo ajax
            type: "POST",//aqui puede  ser get o post
            url: "PHP/busqueda.php",//la url adonde se va a mandar la cadena a buscar
            data: dataString,
            cache: false,
            success: function(html){//funcion que se activa al recibir un dato
              $("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
              }
            });
          }
        return false;    
        });
      });
 function activarInputNombre(){
     if(document.getElementById("cambioNombre").disabled == false){
        document.getElementById("cambioNombre").disabled = true;
     }
     else{
       document.getElementById("cambioNombre").disabled = false;
     }
  };
 function activarInputApellido(){
  if(document.getElementById("cambioApellido").disabled == false){
    document.getElementById("cambioApellido").disabled = true;
 }
 else{
   document.getElementById("cambioApellido").disabled = false;
 }
 }
 function activarInputEmail(){
  if(document.getElementById("cambioEmail").disabled == false){
    document.getElementById("cambioEmail").disabled = true;
 }
 else{
   document.getElementById("cambioEmail").disabled = false;
 }
 }
 function activarInputsContraseña(){
  if(document.getElementById("cambioContraseña").disabled == false){
    document.getElementById("cambioContraseña").disabled = true;
    document.getElementById("cambioRepetirContraseña").disabled = true;
 }
 else{
   document.getElementById("cambioContraseña").disabled = false;
   document.getElementById("cambioRepetirContraseña").disabled = false
 }
}
function mostrar(){
  var archivo = document.getElementById("foto").files[0];
  var reader = new FileReader();
  if (foto) {
    reader.readAsDataURL(archivo );
    reader.onloadend = function () {
      document.getElementById("img").src = reader.result;
    }
    fotoCargada = true;
  }
}


