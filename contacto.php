<?php
	$nombre = $_POST['nombre'];
	$asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];
	$mail="xxxxxxxxxxxxx@xxxx.xxx.xx";

$message="
Nombre: .$nombre
Asunto: .$asunto
Mensaje: .$mensaje
";

	 // enviar el mail
$success = mail($mail, "
Nombre: .$nombre
Asunto: .$asunto
Mensaje: .$mensaje
");

// redireccionamiento
echo "<script language=\"JavaScript\">";
if ($success) {
echo "alert('Se ha enviado el mensaje correctamente');location.href='http://institucioneducativasantacruz.000webhostapp.com/admisiones.html'</script>";
} else {
echo "alert('No se ha conseguido enviar el mensaje');location.href='http://institucioneducativasantacruz.000webhostapp.com/admisiones.html'</script>";
}
echo "</script>";

 ?>
