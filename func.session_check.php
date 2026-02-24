<?php

function session_check ($conn)
{
	if (session_status() !== PHP_SESSION_ACTIVE) {
		return false;
	}
    
	if (!isset($_SESSION["id_user"])) {
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
	users.id_user={$id_user}
	AND users.status='active';
EOD;

	$result = mysqli_query($conn, $query);
	if (!$result){
		die('Error 2: Petición incorrecta');
	}
	
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 1){
		die('Error 3: No hombre no'); 
	}
	
	if ($num_rows < 1) {
		return false;
	}

	$data = $result->fetch_assoc();

	return $data["id_user"];
}

?>
