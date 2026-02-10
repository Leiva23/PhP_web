<?php

function session_check ($conn)
{
	if (session_status() !== PHP_SESSION_ACTIVE) {
		return false;
	}

	if (!isset ($_SESSION["id_user"]) {
		return false;
	}

	$id_user = intval($_SESSION["id_user"]);
	if ($id_user <= 0){
		return false;
	}

$query = <<<EOD
SELECT
        id_user
FROM
        users
WHERE
        users.id_user = {$_SESSION["id_user"]};
	AND users.status='active';
EOD;

	$result = mysqli_query($conn, $query);
	if (!$result){
		die ('Error 2: Peticion incorrecta');
	}

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 1){
		die('Eror 3: No hombre no');
		return false;
	}
	if ($num_rows > 1){
		return false;
	}	

	$data = $result->fetch_assoc();
	
?>
