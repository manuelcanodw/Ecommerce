<?php

require_once ('connection.php');

$_POST = json_decode(file_get_contents('php://input'), true);

// Comprovar el post quefuncione
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];   
$password1 = $_POST['password1'];
$email = $_POST['email'];
$nif = $_POST['nif'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];   
$ciudad = $_POST['ciudad'];


//password encriptado
$password1 = password_hash($password1, PASSWORD_DEFAULT);
// echo strlen($password1);

$select = "SELECT * FROM clientes WHERE email = ?";
$query = $conn->prepare($select);
$query->execute([$email]);
$result = $query->fetch();

//Comprovamos el result q sirve par que solo haya un cliente por email, regresandonos el array completos
echo "<pre>";
var_dump($result);
echo "</pre>";

if ($result) {
    echo "El email ya existe";
    die();
}


//Obtener e id de ciudad
$select = "SELECT id_ciudad FROM ciudades WHERE nombre_ciudad = ?";
$query = $conn->prepare($select);
$query->execute([$ciudad]);
$result = $query->fetch();
//verificamos si 
echo "<pre>";
var_dump($result);
echo "</pre>";

//Insertar la ciudad 
// $insert= "INSERT INTO ciudades (nombre_ciudad) VALUES (?)";
// $query = $conn->prepare($insert);
// $query->execute([$ciudad]);


$insert = "INSERT INTO clientes (nombre_cliente, apellidos_cliente, password, email, nif, telefono, direccion_cliente, id_ciudad) VALUES (?,?,?,?,?,?,?,?)";
$query = $conn->prepare($insert);
$query->execute([$nombre, $apellidos, $password1, $email, $nif, $telefono, $direccion, $ciudad]);

$conn = null;
$insert = null;
$select = null;

header('Location: ecommerce.php');