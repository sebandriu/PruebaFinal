<?php
session_start();
if (isset($_SESSION['nombre'])) {
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Iniciar sesión</title>
	<meta charset="utf-8">
	<style>
		/* Luego tengo que sacar estos css del body y tirarlos al style.css */
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}

		.container {
			width: 400px;
			padding: 40px;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		h1,h2,h3,h4,h5 {
			text-align: center;
			color: #333;
		}

		label {
			display: block;
			margin-bottom: 10px;
			color: #555;
		}

		input[type="text"],
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type="submit"] {
			width: 100%;
			padding: 12px;
			background-color: #4CAF50;
			border: none;
			color: #fff;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}

		.error-message {
			color: #f44336;
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1>Inicia sesión</h1>
		<h3>Tu gestor de citas preferido</h3>
		<form method="POST" action="loginProceso.php">
			<label for="txtUsu">Usuario</label>
			<input type="text" name="txtUsu" id="txtUsu" placeholder="Ingresa tu usuario">
			<br>
			<br>
			<label for="txtMail">Correo</label>
			<input type="email" name="txtMail" id="txtMail" placeholder="Ingresa tu email">
			<br>
			<br>
			<label for="txtPass">Contraseña</label>
			<input type="password" name="txtPass" id="txtPass" placeholder="Ingresa tu contraseña">
			<br>
			<br>
			<input type="submit" value="Iniciar sesión">
		</form>
	</div>
</body>

</html>