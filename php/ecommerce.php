<?php
session_start();
require_once('connection.php');

var_dump($_SESSION);


if (!isset($_SESSION['nombre_cliente'])) {
    header('location: ../index.php');
}

echo "hola ".$_SESSION['nombre_cliente']." ".$_SESSION['apellido_cliente'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Cerrar sesion</a>
</body>
</html>