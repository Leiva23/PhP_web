<?php

session_start();

require_once("conf.database.php");
require_once("func.dashboard_role_check.php");
require_once("func.session_check.php");

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
     die("Error 20: No se pudo conectar con la base de datos");
}

$id_user_sesion = session_check($conn);
/*
if ($id_user_sesion === false) {
    header("Location: login.php");
    exit();
}
*/

if (!$id_user){
	header("Location: login.php";
	exit();
}

if (!dashbaord_role_check($conn, $id_user){
	header("Location: login.php");
	exit();
}
/*
if (!isset($_POST["id_user_edit"])){
    die("Error 1: Formulario no enviado");
}

$id_user_edit = intval($_POST["id_user_edit"]);

if ($id_user_edit !== $id_user_sesion) {
    header("Location: login.php");
    exit();
}
*/

// Comprobaciones de existencia
if (// !isset($_POST["update_username"])
//  || !isset($_POST["update_password"])
     !isset($_POST["update_name"])
     || !isset($_POST["update_address"])
     || !isset($_POST["update_email"])
     || !isset($_POST["update_phone"])
     || !isset($_POST["update_birth"])){
     die("Error 1: Formulario no enviado");
}

if (empty($_POST["id_user_edit"])){
     die("Error 2a: ID de usuario incorrecto");
}

if ($id_user_edit <= 0){
     die("Error 2b: ID de usuario incorrecto");
}

/*
// Comprobaciones de campos vacíos
if (empty($_POST["update_username"])){
     die("Error 2: Campo de nombre de usuario no enviado");
}

if (empty($_POST["update_password"])){
     die("Error 3: Campo de contraseña no enviado");
}
*/

if (empty($_POST["update_name"])){
     die("Error 4: Campo de nombre no enviado");
}

if (empty($_POST["update_address"])){
     die("Error 5: Campo de dirección no enviado");
}

if (empty($_POST["update_email"])){
     die("Error 6: Campo de e-mail no enviado");
}

if (empty($_POST["update_phone"])){
     die("Error 7: Campo de teléfono no enviado");
}

if (empty($_POST["update_birth"])){
     die("Error 8: Campo de fecha de nacimiento no enviado");
}

/*
// Usuario
$user_clean = strip_tags(trim($_POST["update_username"]));
$user = addslashes($user_clean);

if ($user != $user_clean) {
     die("Error 9: Nombre de usuario mal formado");
}

if (strlen($user) < 2 || strlen($user) > 16 ) {
     die("Error 10: Longitud de usuario incorrecta");
}

// Contraseña
$password = $_POST["update_password"];
$password_esc = addslashes($password);

if ($password_esc != $password) {
     die("Error 11: Contraseña mal formada");
}

if (strlen($password) < 4 || strlen($password) > 32 ) {
     die("Error 12: Longitud de constraseña incorrecta");
}

$password_db = md5($password_esc);
*/

// Nombre
$name_clean = strip_tags(trim($_POST["update_name"]));
$name = addslashes($name_clean);

if ($name != $name_clean) {
     die("Error 13: Nombre mal formado");
}

if (strlen($name) < 2 || strlen($name) > 24) {
     die("Error 14: Longitud de nombre incorrecta");
}

// Dirección
$address_clean = strip_tags(trim($_POST["update_address"]));
$address = addslashes($address_clean);

if ($address != $address_clean) {
     die("Error 15: Dirección mal formada");
}

if (strlen($address) > 64) {
     die ("Error 16: Dirección demasiado larga");
}

// E-mail
$email_clean = strip_tags(trim($_POST["update_email"]));
$email = filter_var($email_clean, FILTER_VALIDATE_EMAIL);

if (!$email) {
     die("Error 17: Formato de e-mail no válido");
}

if (strlen($_POST["update_email"]) > 48) {
     die("Error 18: E-mail demasiado largo");
}

// Phone
$phone_clean = strip_tags(trim($_POST["update_phone"]));
$phone = addslashes($phone_clean);

if (strlen($phone) > 16) {
     die("Error 19: Teléfono demasiado largo");
}

// Nacimiento
$birth = addslashes($_POST["update_birth"]);


// Añadimos en la tabla clients
$query_clients = <<<EOD
UPDATE clients
SET
     name='{$name}',
     address='{$address}',
     phone='{$phone}',
     email='{$email}',
     birthdate='{$birth}'
WHERE
     id_client=(SELECT id_client
                FROM users
                WHERE id_user={$id_user_edit});
EOD;

$result = mysqli_query($conn, $query_clients);
if (!$result) {
     die("Error: no se ha podido actualiar el usuario");
}

//header("Location: dashboard_user_edit.php?id_user=".$id_user_edit);
header("Location: dashboard_users.php?id_user=".$id_user_edit);
exit();


?>
