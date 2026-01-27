<?php

if	(!isset($_POST["login_user"])
	|| !isset($_POST["login_password"])){

	die("Error 1: Formulario no enviado");
	exit();
}

if (empty($_POST["login_user"])){
	die("Error 2: Campo de login no enviado");
	exit();
}

if	(empty($_POST["login_password"])){
	die("Error 3: Campo de password no enviado");
	exit();
}

$user = addslashes($_POST["login_user"]);

if ($user != $_POST["login_user"]) {
	die("Error 4: User mal formado");
	exit();
}

if (strlen($user) < 2) {
	die("Error 5: User demasiado corto");
}

$user = filter_var($user, FILTER_SANITIZE_SPECIAL_CHARS);
if ($user != $_POST["login_user"]) {
	die("Error 6: User mal formado");
}

$password = addslashes($_POST["login_password"]);

if ($password != $_POST["login_password"]){
	die("Error 7: Password mal formulado ");
}

if (strlen($password) < 4){
	die("Error 8: Password demasiado corto");
}

$password = md5($password);

$conn = mysqli_connect('localhost', 'admin_db', 'enti', 'pizzeria_musso');
if (!$conn){
	die("Error 9: No se pudo conectar con la base de datos");
}

$query = <<<EOD
SELECT
	id_user
FROM
	users
WHERE
	username='($user)'
	AND password='{$password}';
EOD;

echo $query;

$result = mysqli_query($conn, $query);
if (!$result){
	die("Error 10: Petición incorrecta");
}

if (mysqli_num_rows($result) != 1){
	die ("Error 11: Nombre de usuario o password incorrecto");
}

echo "logueado";

?>
