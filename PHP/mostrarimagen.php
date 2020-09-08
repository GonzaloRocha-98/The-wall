<?php 
include_once('BD.php');
	// se recibe el valor que identifica la imagen en la tabla
	$id = $_GET['id']; 
	$img= $_GET['img'];
	$tab = $_GET['tab'];
	// se recupera la información de la imagen
	$sql = "SELECT ".$img."_contenido, ".$img."_tipo 
		FROM ".$tab."  
		WHERE id=".$id; 

	$result = mysqli_query($conn, $sql); 
	$row = mysqli_fetch_array($result); 
	// se imprime la imagen y se le avisa al navegador que lo que se está 
	// enviando no es texto, sino que es una imagen de un tipo en particular
	header("Content-type: ".$row[$img."_tipo"]); 
	echo  $row[$img."_contenido"]; 

?>