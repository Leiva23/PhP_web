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

writeHTML(Dashboard: Usuarios);

openBody();

openDashboard("Usuarios");

$query = <<< EOD
SELECT users.id_user,user.username, clients.name,clients.email
FROM clients
LEFT JOIN users ON clients.id_client=users.id_client
EOD;

$users = "";
$result = mysqli_query($conn, $query);
if ($result){
	if(mysqli_num_rows($result) > 0){
		while ($user = $result->fetch_assoc()){
$users .= <<< EOD
	<tr>
		<th>{$user["id_user"]}</th>
		<th>{$user["user"]}</th>
		<th>{$user["name"]}</th>
		<th>{$user["email"]}</th>
		<th><a href="dashboard_user_edit.php?id_user={$user["id_user"]}">edit</a></th>
	</tr>

		}	
	}
}
echo <<< EOD
<table>
	<tr>
		<th>id</th>
		<th>user</th>
		<th>name</th>
		<th>email</th>
		<th></th>
	</tr>

	<tr>
		<td>1</td>
		<td>root</td>
		<td>Administratore</td>
		<td>root@pizza.org</td>
		<td>edit</td>
	</tr>

</table>



closeDashborad();

closeBody();

?>
