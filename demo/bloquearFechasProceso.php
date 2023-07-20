<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["txtFecha"])) {
        $fecha_bloquear = $_POST["txtFecha"];
        include 'model/conexion.php';
        $sentencia = $bd->prepare("INSERT INTO fechas_bloqueadas (fecha_bloqueada) VALUES (?);");
        $resultado = $sentencia->execute([$fecha_bloquear]);
        if ($resultado === TRUE) {
            header('Location: bloquearFechas.php?mensaje=Bloqueo exitoso');
        } else {
            echo "Error al bloquear la fecha";
        }
    }
}
?>