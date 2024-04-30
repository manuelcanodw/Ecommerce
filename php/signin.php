<?php
session_start();

require_once('connection.php');

$email = $_POST['email'];
$password_user = $_POST['password'];

$select = "SELECT * FROM clientes WHERE email = ?";
$query = $conn->prepare($select);
$query->execute([$email]);
$result = $query->fetch();

// var_dump($result);
//por si el loguin no es correcto
if (!$result) {
    echo "Usuario o contraseña incorrectos";
    header('location: index.php');
//     die();
}

//login ha sido correcto y obtenemos los datosdel cliente
$password_hash = $result['password'];
if (password_verify($password_user, $password_hash)) {
    // echo "Usuario o contraseña correctos";
    $_SESSION['nombre_cliente'] = $result['nombre_cliente'];
    $_SESSION['apellido_cliente'] = $result['apellidos_cliente'];
    $_SESSION['id_cliente'] = $result['id_cliente'];
    header('Location: ecommerce.php');
    
} else {
    echo "Usuario o contraseña incorrectos";
}