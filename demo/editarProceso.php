<?php 
	if (!isset($_POST['oculto'])) {
		header('Location: index.php');
	}

	include 'model/conexion.php';
	$id2 = $_POST['id2'];
	$paterno2 = $_POST['txt2Paterno'];
	$materno2 = $_POST['txt2Materno'];
	$nombre2 = $_POST['txt2Nombre'];
	$comentario2 = $_POST['txt2Comentario'];
	$email_cita2 = $_POST['txt2Email'];
	$fono2 = $_POST['txt2Fono'];
	$fecha2 = $_POST['txt2Fecha'];

	$sentencia = $bd->prepare("UPDATE cita SET ap_paterno = ?, ap_materno = ?, nombre = ?, comentario = ?, email_cita = ?, fono = ?, fecha = ? WHERE id_cita = ?;");
	$resultado = $sentencia->execute([$paterno2,$materno2,$nombre2,$comentario2,$email_cita2,$fono2,$fecha2, $id2]);

	if ($resultado === TRUE) {
		header('Location: index.php');
	}else{
		echo "Error";
	}
?>