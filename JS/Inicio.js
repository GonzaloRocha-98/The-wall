
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
function me_gusta(id_mensaje)
{   if($("#"+id_mensaje).val() == "MeGusta"){
        var parametro = 'id_mensaje=' + id_mensaje;
        $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'PHP/Dar_MeGusta.php',//aqui va tu direccion donde esta tu funcion php
            data: parametro,//aqui tus datos
            success:function(){
                $("#"+id_mensaje).val("Quitar Me Gusta");//lo que devuelve tu archivo mifuncion.php
           },
           error:function(data){
            alert("error")//lo que devuelve si falla tu archivo mifuncion.php
           }
         });
        }
    else{
        if($("#"+id_mensaje).val()== "Quitar Me Gusta"){
            var parametro = 'id_mensaje=' + id_mensaje;
            $.ajax({
                type:'POST', //aqui puede ser igual get
                url: 'PHP/Quitar_MeGusta.php',//aqui va tu direccion donde esta tu funcion php
                data: parametro,//aqui tus datos
                success:function(){
                    $("#"+id_mensaje).val("MeGusta");//lo que devuelve tu archivo mifuncion.php
               },
               error:function(data){
                alert("error")//lo que devuelve si falla tu archivo mifuncion.php
               }
            });
        }
     }
};
function borrar(mensaje_id)
{
    var parametro = 'mensaje_id=' + mensaje_id;
    $.ajax({
        type:'POST', //aqui puede ser igual get
        url: 'PHP/BorrarPublicacion.php',//aqui va tu direccion donde esta tu funcion php
        data: parametro,//aqui tus datos
        success:function(){
            location.reload();
       },
        error:function(data){
        alert("error")//lo que devuelve si falla tu archivo mifuncion.php
       }
    });
};

function chequearPost (){
    if(($("#post").val() != "") || ($("#foto").val() != 0)){
        document.getElementById("enviar").disabled = false;
    }else{
        document.getElementById("enviar").disabled = true;
    }};

function display($aux){
    document.getElementById($aux).style.display = "none";
};