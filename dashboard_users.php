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

require_once("template.php");
require_once("template_dashboard.php");

writeHTML("Dashboard: Usuarios");

openBody();

openDashboard("Usuarios");


$query = <<<EOD
SELECT users.id_user,users.username,clients.name,clients.email
FROM clients
LEFT JOIN users ON clients.id_client=users.id_client
EOD;

$result = mysqli_query($conn, $query);

$users = "";

if ($result){
	if (mysqli_num_rows($result) > 0){
		while ($user = $result->fetch_assoc()){
			$users .= <<<EOD
	<tr>
		<td>{$user["id_user"]}</td>
		<td>{$user["username"]}</td>
		<td>{$user["name"]}</td>
		<td>{$user["email"]}</td>
		<td><a href="dashboard_user_edit.php?id_user={$user["id_user"]}">edit</a></td>
	</tr>
EOD;
		}
	}
}

echo <<<EOD
<table>
	<tr>
		<th>id</th>
		<th>user</th>
		<th>name</th>
		<th>email</th>
		<th></th>
	</tr>
{$users}
</table>
EOD;









closeDashboard();


closeBody();

?>
