<?php
session_start();
include_once 'model/conexion.php';
$usuario = $_POST['txtUsu'];
$contrasena = $_POST['txtPass'];
$email = $_POST['txtMail'];
$sentencia = $bd->prepare('SELECT * from t_usuario where nombre_usu = ? and password_usu = ? and email_usu = ?;');
$sentencia->execute([$usuario, $contrasena, $email]);
$datos = $sentencia->fetch(PDO::FETCH_OBJ);

if ($datos === FALSE) {
	header('Location: login.php');
} elseif ($sentencia->rowCount() == 1) {
	$_SESSION['nombre'] = $datos->nombre_usu;
	header('Location: index.php');
}
?>