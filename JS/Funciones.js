var Abecedario= /[a-zA-Z]/;
var AbecedarioMinus= /[a-z]/;
var AbecedarioMayus= /[A-Z]/;
var AlfaNumerico= /[0-9a-zA-Z]/;
var caracteresEspeciales=/[!"#$%&'()*+,-./:;<=>?@[^_`{|}~]/;
var numeros=/[0-9]/;
var fotoCargada= false;

function prueba(event){
  event.preventDefault();
  alert("hola");
};

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

function validarEmail() {
  emailRegex = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
  let cadena = document.getElementById('email-reg').value;
  if (emailRegex.test(cadena)) {
    return true;
  } else {  
    alert('Email invalido')
    return false;
  }
}

function validarAlfabeticosDos(cadena){
  for(let i=0; i < cadena.length; i++){
    if (!(cadena[i].match(Abecedario)) && !(cadena[i]==" ")){
      return false;
    }
  }
  return true;
}

function validarNyA(){
  if(document.getElementById('nombre-reg').value=="" || !validarAlfabeticosDos(document.getElementById('nombre-reg').value)){
    alert("Nombre no valido,use solo caracteres alfabeticos");
    return false;
  }
  else
    if (document.getElementById('apellido-reg').value=="" || !validarAlfabeticosDos(document.getElementById('apellido-reg').value)) {
      alert("Apellido no valido,use solo caracteres alfabeticos");
      return false
    }
    else
      return true;
}

function validarUser(){
  let cadena=document.getElementById('usuario-reg').value;
	if (cadena != ""){
		if (cadena.length > 5){
			for(let i=0;i< cadena.length;i++){
				if (!cadena[i].match(AlfaNumerico)){
          alert("El nombre de usuario solo puede ser alfanumerico");
					return false;
				}
			}
    }
		else{
      alert("El nombre de usuario debe ser mayor a 5");
			return false;
		}
  }
	return true;
}

function validarPsw(cadena){
  var mayusculas= false;
	var minusculas= false;
	var numeroOSimbolo= false;
  for(let i=0;i < cadena.length; i++){
    if(cadena[i].match(caracteresEspeciales) || cadena[i].match(numeros)){
      numeroOSimbolo= true;
    }
    if(cadena[i].match(AbecedarioMinus)){
      minusculas= true;
    }
    if(cadena[i].match(AbecedarioMayus)){
      mayusculas= true;
    }
  }
  if (mayusculas && minusculas && numeroOSimbolo){
    return true;
  }
  else {
    return false;
  }
}

function pswCoinciden(clave1,clave2){
  if (clave1 == clave2){
    return true;
  }
  else{
    return false;
  }
}

function validarContraseña(){
  let contraseña=document.getElementById('contraseña-reg').value;
  let contraseña2=document.getElementById('repetir-contraseña-reg').value;
  if(contraseña.length<6 || !validarPsw(contraseña) || !pswCoinciden(contraseña, contraseña2)){
    alert('Verifique la contraseña');
    return false;
  }
  else {
    return true;
  }
}

function validarFoto (){
  if(fotoCargada){
    return true;
  } else{
    alert("Falta cargar foto de perfil");
    return false;
  }
}
function validar() {
  if (validarEmail() && validarNyA() && validarUser() && validarContraseña() && validarFoto()) {
    return true;
  } else {
    event.preventDefault();
    return false;
  }
}
