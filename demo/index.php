<?php
session_start();
if (!isset($_SESSION['nombre'])) {
	header('Location: login.php');
} elseif (isset($_SESSION['nombre'])) {
	include 'model/conexion.php';
	$sentencia = $bd->query("SELECT * FROM cita;");
	$citas = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
	echo "Error en el sistema";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Lista de Citas</title>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
	<br>
	<div class="container">
		<figure class="text-center">
			<blockquote class="blockquote">
				<h2>Lista de Citas</h2>
			</blockquote>
			<figcaption class="blockquote-footer">
				<h5>¡Bienvenida
					<?php echo $_SESSION['nombre'] ?>!
				</h5>
			</figcaption>
		</figure>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Comentario</th>
					<th>Email</th>
					<th>Telefono</th>
					<th>Fecha</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($citas as $dato) {
					?>
					<tr>
						<td>
							<?php echo $dato->nombre; ?>
						</td>
						<td>
							<?php echo $dato->ap_paterno; ?>
						</td>
						<td>
							<?php echo $dato->ap_materno; ?>
						</td>
						<td>
							<?php echo $dato->comentario; ?>
						</td>
						<td>
							<?php echo $dato->email_cita; ?>
						</td>
						<td>
							<?php echo $dato->fono; ?>
						</td>
						<td>
							<?php echo $dato->fecha; ?>
						</td>
						<td><a class="btn btn-warning" href="editar.php?id=<?php echo $dato->id_cita; ?>">Editar <i
									class="bi bi-pencil"></i></a></td>
						<td><a class="btn btn-danger" href="eliminar.php?id=<?php echo $dato->id_cita; ?>">Eliminar <i
									class="bi bi-trash"></i></a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<div class="link-container">
			<a class="btn btn-danger" href="cerrar.php" role="button">Cerrar Sesión <i
					class="bi bi-box-arrow-left"></i></a>
			<a class="btn btn-primary" href="insertarpersonas.php" role="button">Insertar Cita <i
					class="bi bi-person-add"></i></a>
			<br>
			<br>
			<br>
			<h2>¡Selecciona una fecha y bloqueala!</h2>
			<br>
			<form method="POST" action="agregarFechasBloqueadas.php">
				<label for="txtFechaBloqueada">Fecha a Bloquear:</label>
				<input type="date" name="txtFechaBloqueada" required>
				<br>
				<br>
				<input style="color:black" class="btn btn-danger" type="submit" value="Agregar Fecha Bloqueada" >
				<br>
				<br>
				<a class="btn btn-primary" href="listaFechasBloqueadas.php" role="button">Fechas Bloqueadas <i class="bi bi-calendar-minus"></i></a>
			</form>
		</div>
	</div>
	<?php
	// Obtener la fecha actual en formato de fecha con PHP
	$fecha_actual = date("Y-m-d");

	// Filtrar las citas para obtener solo las próximas a la fecha actual
	$citas_proximas = array_filter($citas, function ($cita) use ($fecha_actual) {
		return $cita->fecha >= $fecha_actual;
	});
	?>

	<script>
		window.onload = function () {
			// Obtener el div del popup
			const popup = document.getElementById("popup");

			// Verificar si hay citas próximas
			<?php if (count($citas_proximas) > 0): ?>
				// Mostrar el popup si hay citas próximas
				popup.style.display = "block";
			<?php endif; ?>

			// Agregar un evento al botón "Cerrar" del popup para ocultarlo
			const cerrarPopup = document.getElementById("cerrarPopup");
			cerrarPopup.addEventListener("click", function () {
				popup.style.display = "none";
			});
		};
	</script>

	<div id="popup"
		style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #A7C5F9; border: 1px solid black; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
		<h2>Citas próximas</h2>
		<?php foreach ($citas_proximas as $cita): ?>
			<?php
			// Obtener la fecha de la cita
			$fecha_cita = new DateTime($cita->fecha);
			$fecha_formato = $fecha_cita->format('d/m/Y'); // Formato: DD/MM/YYYY 
		
			// Calcular la diferencia de días entre la fecha actual y la fecha de la cita
			$diferencia_dias = $fecha_cita->diff(new DateTime())->days;

			// Asignar un estilo CSS basado en la diferencia de días
			$color = 'black';
			if ($diferencia_dias <= 3) {
				$color = 'red';
			} elseif ($diferencia_dias <= 6) {
				$color = 'yellow';
			} else {
				$color = 'green';
			}
			?>
			<center>
				<p style="color: <?php echo $color; ?>"><?php echo $cita->nombre; ?> - <?php echo $fecha_formato; ?></p>
			</center>
		<?php endforeach; ?>
		<button id="cerrarPopup"
			style="margin-top: 10px; padding: 8px 16px; background-color: #4CAF50; border: none; color: #fff; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.3s ease;">Cerrar</button>
	</div>


</body>

</html>