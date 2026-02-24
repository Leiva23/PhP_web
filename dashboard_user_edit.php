<?php

session_start();

require_once("func.session_check.php");
require_once("conf.database.php");

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
	die("Error 1: No se pudo conectar con la base de datos");
}


$id_user = session_check($conn);

if (!$id_user){
	header("Location: login.php");
	exit();
}

$query = <<<EOD
SELECT role FROM users WHERE id_user={$id_user}
EOD;

$result = mysqli_query($conn, $query);
if (!$result){
	die("Error: Problemas al conectar con la base de datos");
}

if (mysqli_num_rows($result) != 1){
	header("Location: index.php");
	exit();
}

$role = $result->fetch_assoc();

if ($role["role"] != 1){
	header("Location: index.php");
	exit();
}

if (!isset($_GET["id_user"])){
	header("Location: dashboard_users.php");
	exit();
}

$id_user_edit = intval($_GET["id_user"]);

if ($id_user_edit <= 0){
	header("Location: dashboard_users.php");
	exit();
}



require_once("template.php");
require_once("template_dashboard.php");

writeHTML();

openBody();

openDashboard("Edición de usuario/cliente");


$query = <<<EOD
SELECT *
FROM clients
LEFT JOIN users
	ON clients.id_client=users.id_client
WHERE users.id_user={$id_user_edit}
EOD;

$result = mysqli_query($conn, $query);
if (!$result){
	echo "<p>Error al obtener el usuario con id ".$id_user_edit."</p>";

	closeDashboard();

	closeBody();
	exit();
}

if (mysqli_num_rows($result) != 1){
	echo "<p>Identificador de usuario (".$id_user_edit.") erróneo.</p>";

	closeDashboard();

	closeBody();
	exit();

}

$user_edit = $result->fetch_assoc();

echo <<<EOD
<form method="POST" action="dashboard_user_edit_check.php">
	<input type="hidden" name="id_user_edit" value="{$id_user_edit}" />

	<h3>Datos de usuario</h3>
	<p><label for="update-user">Usuario:</label>
	<input type="text" name="update_user" id="update-user" value="{$user_edit["username"]}" disabled /></p>

	<p><label for="update-password">Contraseña:</label>
	<input type="password" name="update_password" id="update-password" autocomplete="false" /></p>

	<p><label for="update-repassword">Comprobación de contraseña:</label>
	<input type="password" name="update_repassword" id="update-repassword" autocomplete="off" /></p>

	<h3>Datos de cliente</h3>

	<p><label for="update-name">Nombre:</label>
	<input type="text" name="update_name" id="update-name" value="{$user_edit["name"]}" required /></p>

	<p><label for="update-address">Dirección:</label>
	<input type="text" name="update_address" id="update-address" value="{$user_edit["address"]}" required /></p>

	<p><label for="update-phone">Teléfono:</label>
	<input type="text" name="update_phone" id="update-phone" value="{$user_edit["phone"]}" required /></p>

	<p><label for="update-email">e-mail:</label>
	<input type="email" name="update_email" id="update-email" value="{$user_edit["email"]}" required /></p>

	<p><label for="update-date">Fecha de nacimiento:</label>
	<input type="date" name="update_birth" id="update-date" value="{$user_edit["birthdate"]}" required /></p>
	<p><input type="submit" value="Actualizar" /></p>

</form>
EOD;





closeDashboard();

closeBody();

?>
