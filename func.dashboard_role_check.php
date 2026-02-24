<?php

function dashboard_role_check ($conn, $id_user)
{
	$query <<<EOD
SELECT role FROM users WHERE id_user={$id_user}
EOD;

	$result = mysqli_query($conn, $query);
	if (!$result){
// falta rellenar
