<?php
include 'model/conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Bloquear Fechas</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Bloquear Fechas</h2>
    <form method="POST" action="bloquearFechasProceso.php">
      <label for="txtFecha">Fecha a bloquear:</label>
      <input type="date" name="txtFecha" required>
      <br>
      <br>
      <input class="btn btn-primary" type="submit" value="Bloquear Fecha">
    </form>
  </div>
</body>
</html>
