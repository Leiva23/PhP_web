<?php

// Comprobaciones de existencia
if (!isset($_POST["register_username"])
        || !isset($_POST["register_password"])
        || !isset($_POST["register_name"])
        || !isset($_POST["register_address"])
        || !isset($_POST["register_email"])
        || !isset($_POST["register_phone"])
        || !isset($_POST["register_birth"])){
        die("Error 1: Formulario no enviado");
}

// Comprobaciones de campos vacíos
if (empty($_POST["register_username"])){
        die("Error 2: Campo de nombre de usuario no enviado");
}

if (empty($_POST["register_password"])){
        die("Error 3: Campo de contraseña no enviado");
}

if (empty($_POST["register_name"])){
        die("Error 4: Campo de nombre no enviado");
}

if (empty($_POST["register_address"])){
        die("Error 5: Campo de dirección no enviado");
}

if (empty($_POST["register_email"])){
        die("Error 6: Campo de e-mail no enviado");
}

if (empty($_POST["register_phone"])){
        die("Error 7: Campo de teléfono no enviado");
}

if (empty($_POST["register_birth"])){
        die("Error 8: Campo de fecha de nacimiento no enviado");
}

// Usuario
$user_clean = strip_tags(trim($_POST["register_username"]));
$user = addslashes($user_clean);

if ($user != $user_clean) {
        die("Error 9: Nombre de usuario mal formado");
}

if (strlen($user) < 2 || strlen($user) > 16 ) {
        die("Error 10: Longitud de usuario incorrecta");
}

// Contraseña
$password = $_POST["register_password"];
$password_esc = addslashes($password);

if ($password_esc != $password) {
        die("Error 11: Contraseña mal formada");
}

if (strlen($password) < 4 || strlen($password) > 32 ) {
        die("Error 12: Longitud de constraseña incorrecta");
}

$password_db = md5($password_esc);

// Nombre
$name_clean = strip_tags(trim($_POST["register_name"]));
$name = addslashes($name_clean);

if ($name != $name_clean) {
        die("Error 13: Nombre mal formado");
}

if (strlen($name) < 2 || strlen($name) > 24) {
        die("Error 14: Longitud de nombre incorrecta");
}

// Dirección
$address_clean = strip_tags(trim($_POST["register_address"]));
$address = addslashes($address_clean);

if ($address != $address_clean) {
        die("Error 15: Dirección mal formada");
}

if (strlen($address) > 64) {
        die ("Error 16: Dirección demasiado larga");
}

// E-mail
$email_clean = strip_tags(trim($_POST["register_email"]));
$email = filter_var($email_clean, FILTER_VALIDATE_EMAIL);

if (!$email) {
        die("Error 17: Formato de e-mail no válido");
}

if (strlen($_POST["register_email"]) > 48) {
        die("Error 18: E-mail demasiado largo");
}

// Phone
$phone_clean = strip_tags(trim($_POST["register_phone"]));
$phone = addslashes($phone_clean);

if (strlen($phone) > 16) {
        die("Error 19: Teléfono demasiado largo");
}

// Nacimiento
$birth = $_POST["register_birth"];

// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'admin_db', 'enti', 'pizzeria_musso');
if (!$conn){
        die("Error 20: No se pudo conectar con la base de datos");
}

// Añadimos en la tabla clients
$query_clients = <<<EOD
INSERT INTO clients (name, address, phone, email, birthdate)
VALUES ('{$name}', '{$address}', '{$phone}', '{$email}', '{$birth}');
EOD;

if (mysqli_query($conn, $query_clients)) {

        // Capturamos la id generada
        $id_client = mysqli_insert_id($conn);

        // Insertamos en la tabla users usando la id capturada
        $query_users = <<<EOD
INSERT INTO users (username, password, id_client)
VALUES ('{$user}', '{$password_db}', {$id_client});
EOD;

        if (mysqli_query($conn, $query_users)) {
                echo "¡Registro completado con éxito!";
        } else {
                die("Error 21: No se pudo crear el acceso de usuario");
        }
} else {
        die("Error 22: No se pudo registrar la información del cliente");
}

mysqli_close($conn);

?>
