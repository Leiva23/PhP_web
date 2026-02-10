<?php

session_start();

require_once("func.session_check.php");
require_once("conf.database.php");

writeHTML();

openBody();

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn) {
        die("Error 1: No se pudo conectar con la base de datos");
}

$id_user = session_check($conn);

if(!$id_user){
	header("Location: login.php");
	exit();
}

if ($id_user) {
	$query = <<< EOD
SELECT role FROM users WHERE users.id_user={$id_user};
EOD;
	
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Error: Problemas al conectar con la base de datos");
	}

	if (mysqli_num_rows($result)!= 1) {
	header("Location: index.php");
	exit();
	}

	if ($result["role"] != 1){
	header("Location: index.php");
	exit();
	}
	
}

require_once("template.php");
require_once("template_dashboard.php");

writeHTML();

openBody();

openDashboard("Dashboard");

closeDashborad();

closeBody();

?>
