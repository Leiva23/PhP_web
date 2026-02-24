<?php

session_start();

require_once("func.session_check.php");
require_once("template.php");
require_once("conf.database.php");

writeHTML();

openBody();

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
	die("Error 1: No se pudo conectar con la base de datos");
}


$id_user = session_check($conn);
if ($id_user) {
	$query = <<<EOD
SELECT
	clients.name
FROM
	users
LEFT JOIN clients
	ON users.id_client=clients.id_client
WHERE
	users.id_user={$id_user};
EOD;

	$result = mysqli_query($conn, $query);
	if (!$result){
		die('Error 2: Petición incorrecta');
	}

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 1){
		die('Error 3: No hombre no'); 
	}
	if ($num_rows == 1){
		$data = $result->fetch_assoc();

		echo "<p><marquee>Hola ".$data["name"]."</marquee></p>";
	}
}

closeBody();

?>
