<?php
// Realizar la conexión a la base de datos
include 'model/conexion.php';

// Obtener las fechas bloqueadas desde la base de datos
$sentencia = $bd->prepare("SELECT * FROM fechas_bloqueadas;");
$sentencia->execute();
$fechas_bloqueadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Fechas Bloqueadas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <figure class="text-center">
            <blockquote class="blockquote">
                <h2>Fechas Bloqueadas</h2>
            </blockquote>
            <figcaption class="blockquote-footer">
                <h5>¡Bienvenida Jane!
                </h5>
            </figcaption>
        </figure>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha Bloqueada</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fechas_bloqueadas as $fecha): ?>
                    <tr>
                        <td>
                            <?php echo $fecha->fecha_bloqueda; ?>
                        </td>
                        <td><a class="btn btn-danger"
                                href="eliminarFechaBloqueada.php?id=<?php echo $fecha->id; ?>">Eliminar <i
                                    class="bi bi-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="link-container">
            <a class="btn btn-primary" href="index.php" role="button">Volver a la lista <i
                    class="bi bi-person-lines-fill"></i></a>
        </div>
    </div>
</body>

</html>