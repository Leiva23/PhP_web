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

if ($password != $_POST["login_password"]);
	die("Error 7: ");



$password = md5($password);

$query = <<<EOD
SELECT
	id_user
FROM
	users
WHERE
	name='($user)'
	AND password='{$password}';
EOD;

?>
