<?php
// comprobacion de campos enviados
$required_fields = ["reg_username", "reg_password", "reg_name", "reg_address", "reg_email", "reg_phone", "reg_birthdate"];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        die("Error 1: Campo " . $field . " no enviado o vacio");
    }
}


// sanitizacion de simbolos en el username
$user = addslashes($_POST["reg_username"]);
if ($user != $_POST["reg_username"] || strlen($user) < 2) {
    die("Error 2: Usuario mal formado o demasiado corto");
}
$user = filter_var($user, FILTER_SANITIZE_SPECIAL_CHARS);

// sanitizacion del password
$password = addslashes($_POST["reg_password"]);
if (strlen($password) < 4) {
    die("Error 3: Password demasiado corto");
}
$hashed_password = md5($password);

// validacion email valido
$email = filter_var($_POST["reg_email"], FILTER_VALIDATE_EMAIL);
if (!$email) {
    die("Error 4: Email no valido");
}

// sanitizacion datos
$name = addslashes($_POST["reg_name"]);
$address = addslashes($_POST["reg_address"]);
$phone = addslashes($_POST["reg_phone"]);
$birthdate = $_POST["reg_birthdate"]; 


$conn = mysqli_connect('localhost', 'admin_db', 'enti', 'pizzeria_musso');
if (!$conn){
	die("Error 6: No se pudo conectar con la base de datos");
}

// variable con el insert de datos del registro en la DB
$query_client = "INSERT INTO clients (name, address, phone, email, birthdate) 
                 VALUES ('$name', '$address', '$phone', '$email', '$birthdate')";

// pasamos el insert a la BD
$result_client = mysqli_query($conn, $query_client);

if (!$result_client) {
    die("Error 7: No se pudo crear el perfil del cliente");
}

// obtener la nuva id
$id_client = mysqli_insert_id($conn);

// insertar en la tabla users
$query_user = "INSERT INTO users (username, password, id_client) 
               VALUES ('$user', '$hashed_password', '$id_client')";

$result_user = mysqli_query($conn, $query_user);

if (!$result_user) {
    die("Error 8: No se pudo crear el usuario");
}

echo "Registro completado";
?>
