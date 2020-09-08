
function chequearcampo(){
    if ($("#usuario").val().length > 5 && $("#contrasenia").val().length > 5){
        document.getElementById("boton-login").disabled = false;
    }else{
        document.getElementById("boton-login").disabled = true;
    }
};
