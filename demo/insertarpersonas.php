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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["oculto"])) {

        // Verificar si la fecha está bloqueada
        $fecha_seleccionada = $_POST['txtFecha'];
        $sentencia_bloqueada = $bd->prepare("SELECT * FROM fechas_bloqueadas WHERE fecha_bloqueada = ?;");
        $sentencia_bloqueada->execute([$fecha_seleccionada]);

        if ($sentencia_bloqueada->rowCount() > 0) {
            echo "La fecha seleccionada está bloqueada. No se puede agregar la cita.";
        } else {

        }
    }
}

date_default_timezone_set('America/Santiago');
$fecha_actual = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Insertar Cita</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <center>
            <figure class="text-center">
                <blockquote class="blockquote">
                    <h2>Ingresa una cita!</h2>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <h5>¡Bienvenida
                        <?php echo $_SESSION['nombre'] ?>!
                    </h5>
                </figcaption>
            </figure>
            <form method="POST" action="insertar.php">
                <table class="table table-hover">
                    <tr>
                        <td>Nombre: </td>
                        <td><input type="text" name="txtNombre"></td>
                    </tr>
                    <tr>
                        <td>Apellido paterno: </td>
                        <td><input type="text" name="txtPaterno"></td>
                    </tr>
                    <tr>
                        <td>Apellido materno: </td>
                        <td><input type="text" name="txtMaterno"></td>
                    </tr>
                    <tr>
                        <td>Comentario: </td>
                        <td><input type="text" name="txtComentario"></td>
                    </tr>
                    <tr>
                        <td>Email de la persona citada: </td>
                        <td><input type="email" name="txtEmail"></td>
                    </tr>
                    <tr>
                        <td>Telefono de la persona citada: </td>
                        <td><input type="text" name="txtFono"></td>
                    </tr>
                    <tr>
                        <td>Fecha de la cita: </td>
                        <td> <label for="txtFecha"></label>
                            <input type="date" name="txtFecha" min="<?php echo $fecha_actual; ?>">
                        </td>
                    </tr>
                    <input type="hidden" name="oculto" value="1">
                    <tr>
                        <td><input class="btn btn-danger" type="reset"></td>
                        <td><input class="btn btn-success" type="submit" value="Ingresar Cita"></td>
                    </tr>
                </table>
            </form>
            <br>
            <div class="link-container">
                <a class="btn btn-primary" href="index.php" role="button">Volver a la lista <i
                        class="bi bi-person-lines-fill"></i></a>
            </div>
        </center>
    </div>
</body>

</html>