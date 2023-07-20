<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_bloqueada = $_POST['txtFechaBloqueada'];

    include 'model/conexion.php';

    // Verificar si la fecha ya existe en la tabla
    $sentencia = $bd->prepare("SELECT COUNT(*) AS count FROM fechas_bloqueadas WHERE fecha_bloqueda = ?;");
    $sentencia->execute([$fecha_bloqueada]);
    $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
    $fecha_ya_existe = ($resultado->count > 0);

    if ($fecha_ya_existe) {
        // La fecha ya está bloqueada, mostrar mensaje de error
        echo "Error: La fecha ya está bloqueada.";
    } else {
        // Insertar la fecha en la tabla de fechas bloqueadas
        $sentencia = $bd->prepare("INSERT INTO fechas_bloqueadas (fecha_bloqueda) VALUES (?);");
        $resultado = $sentencia->execute([$fecha_bloqueada]);

        if ($resultado === TRUE) {
            // Redireccionar a la página index.php si la inserción fue exitosa
            header('Location: index.php');
            exit();
        } else {
            // Mostrar un mensaje de error si hubo un problema con la inserción
            echo "Error al bloquear la fecha.";
        }
    }
}
?>
