<?php
if (!isset($_POST['oculto'])) {
	exit();
}

include 'model/conexion.php';
$paterno = $_POST['txtPaterno'];
$materno = $_POST['txtMaterno'];
$nombre = $_POST['txtNombre'];
$comentario = $_POST['txtComentario'];
$email_cita = $_POST['txtEmail'];
$fono = $_POST['txtFono'];
$fecha = $_POST['txtFecha'];

 // Verificar si la fecha está bloqueada
 $sentencia = $bd->prepare("SELECT COUNT(*) AS count FROM fechas_bloqueadas WHERE fecha_bloqueda = ?;");
 $sentencia->execute([$fecha]);
 $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
 $fecha_bloqueada = ($resultado->count > 0);

 if ($fecha_bloqueada) {
	 // La fecha está bloqueada, mostrar mensaje de error
	 echo "Error: La fecha seleccionada está bloqueada y no se puede agendar una cita en esa fecha.";
	 echo "<a href='index.php'> Vuelve al Listado de Citas</a>";
	 
 } else {
	 // Insertar la cita en la base de datos
	 $sentencia = $bd->prepare("INSERT INTO cita(ap_paterno,ap_materno,nombre,comentario,email_cita,fono,fecha) VALUES (?,?,?,?,?,?,?);");
	 $resultado = $sentencia->execute([$paterno, $materno, $nombre, $comentario, $email_cita, $fono, $fecha]);

	 if ($resultado === TRUE) {
		 // Redireccionar a la página index.php si la inserción fue exitosa
		 header('Location: index.php');
		 exit();
	 } else {
		 // Mostrar un mensaje de error si hubo un problema con la inserción
		 echo "Error al agendar la cita.";
	 }
 }
?>