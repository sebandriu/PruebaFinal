<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'model/conexion.php';

    // Eliminar la fecha bloqueada de la base de datos
    $sentencia = $bd->prepare("DELETE FROM fechas_bloqueadas WHERE id = ?;");
    $resultado = $sentencia->execute([$id]);

    if ($resultado === TRUE) {
        // Redireccionar a la página listaFechasBloqueadas.php si la eliminación fue exitosa
        header('Location: listaFechasBloqueadas.php');
        exit();
    } else {
        echo "Error al eliminar la fecha bloqueada.";
    }
}
?>