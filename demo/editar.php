<?php
session_start();
if (!isset($_GET['id'])) {
	header('Location: index.php');
}

if (!isset($_SESSION['nombre'])) {
	header('Location: login.php');
} elseif (isset($_SESSION['nombre'])) {
	include 'model/conexion.php';
	$id = $_GET['id'];
	$sentencia = $bd->prepare("SELECT * FROM cita WHERE id_cita = ?;");
	$sentencia->execute([$id]);
	$persona = $sentencia->fetch(PDO::FETCH_OBJ);
} else {
	echo "Error en el sistema";
}

date_default_timezone_set('America/Santiago');
$fecha_actual = date("Y-m-d");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Cita</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<center>
			<figure class="text-center">
				<blockquote class="blockquote">
					<h2>Edita una cita!</h2>
				</blockquote>
				<figcaption class="blockquote-footer">
					<h5>Bienvenida
						<?php echo $_SESSION['nombre'] ?>
					</h5>
				</figcaption>
			</figure>
			<form method="POST" action="editarProceso.php">
				<table class="table table-hover">
					<tr>
						<td>Nombre: </td>
						<td><input type="text" name="txt2Nombre" value="<?php echo $persona->nombre; ?>"></td>
					</tr>
					<tr>
						<td>Apellido paterno: </td>
						<td><input type="text" name="txt2Paterno" value="<?php echo $persona->ap_paterno; ?>"></td>
					</tr>
					<tr>
						<td>Apellido materno: </td>
						<td><input type="text" name="txt2Materno" value="<?php echo $persona->ap_materno; ?>"></td>
					</tr>
					<tr>
						<td>Comentario: </td>
						<td><input type="text" name="txt2Comentario" value="<?php echo $persona->comentario; ?>"></td>
					</tr>
					<tr>
						<td>Email de la persona citada: </td>
						<td><input type="email" name="txt2Email" value="<?php echo $persona->email_cita; ?>"></td>
					</tr>
					<tr>
						<td>Telefono de la persona citada: </td>
						<td><input type="text" name="txt2Fono" value="<?php echo $persona->fono; ?>"></td>
					</tr>
					<td>Fecha de la cita: </td>
                        <td> <label for="txt2Fecha"></label>
                            <input type="date" name="txt2Fecha" min="<?php echo $fecha_actual; ?>">
                        </td>
					<tr>
						<input type="hidden" name="oculto">
						<input type="hidden" name="id2" value="<?php echo $persona->id_cita; ?>">
						<td colspan="2"><input class="btn btn-success" type="submit" value="Editar Cita"></td>
					</tr>
				</table>
				<div class="link-container">
					<a class="btn btn-primary" href="index.php" role="button">Volver a la lista <i
							class="bi bi-person-lines-fill"></i></a>
				</div>
			</form>
		</center>
	</div>
</body>

</html>