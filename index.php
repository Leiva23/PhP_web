<?php

session_start();

require_once("template.php");

writeHTML();

openBody();

$conn = mysqli_connect('localhost', 'admin_db', 'enti', 'pizzeria_musso');
if (!$conn){
	die("Error 1: No se pudo conectar con la base de datos");
}


$query= <<<EOD
SELECT
	clients.name
FROM
	users
LEFT JOIN clients
	ON users.id_client=clients.id_client
WHERE
	users.id_user={$_SESSION["id_user"]};
EOD;

$result = mysqli_connect($conn, $query);
if (!$result){
	die('Error 2: Peticion incorrecta');
}

if (mysqli_num_rows($result) > 1){
	die('Error 3: Nombre de usuario o password incorrectos');
}

$data = $result->fetch_assoc();

echo "<p><maqrquee>Hola ".$data["name"]."</marquee></p>";

echo $query;

closeBody();

?>
