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

if (!isset($_GET["id_user"])){
    header("Location: dashboard_users.php");
    exit();
}

$id_user_edit = intval($_GET["id_user"]);

require_once("template.php");

writeHTML();

openBody();

require_once("template_dashboard.php");

writeHTML();

openBody();

openDashboard("Edicion de usuario/cliente");

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

if (mysqli_num_rows($result)) != 1){
	echo "<p>Identificador de usuario (".$id_user_edit.") erroneo.</p>";

	closeDashboard();

	closeBody();	
	exit();
}

$user_data = $result->fetch_assoc();

echo <<<EOD
<form method="POST" action="register_check.php">
	<input type="hidden" name="id_user_edit" value="{$id_user}" />

	<h2>Edicion de usuarios</h2
        <p><label for="update-username">Nombre de usuario:</label> 
        <input type="text" name="update_username" id="update-username" value="{$user_edit["username"]}" disabled /></p>

        <p><label for="update-password">Contraseña:</label>
        <input type="password" name="update_password" id="update-password" value="{$user_edit["password"]}" disabled /></p>

        <p><label for="update-name">Nombre:</label>
        <input type="text" name="update_name" id="update-name" value="{$user_edit["name"]}" disabled /></p>

        <p><label for="update-address">Dirección:</label>
        <input type="text" name="update_address" id="update-address" value="{$user_edit["address"]}" disabled /></p>

        <p><label for="update-email">E-mail:</label>
        <input type="email" name="update_email" id="update-email" value="{$user_edit["email"]}" disabled /></p>

        <p><label for="update-phone">Teléfono:</label>
        <input type="tel" name="update_phone" id="update-phone" value="{$user_edit["phone"]}" disabled /></p>

        <p><label for="register-birth">Fecha de nacimiento:</label>
        <input type="date" name="update_birth" id="update-birth" value="{$user_edit["birthdate"]}" disabled /></p>

        <p><input type="submit" value="Actualizar" /></p>
</form>



closeDashboard();

closeBody();

?>
