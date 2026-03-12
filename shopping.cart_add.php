
<?php

session_start();

require_once("func.session_check.php");
require_once("template.php");
require_once("conf.database.php");
writeHTML();

openBody();

$id_pizza = intval($_POST["id_pizza"]);

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
     die("Error 1: No se pudo conectar con la base de datos");
}

if (!isset($_SESSION["carrito"])){
	$_SESSION["carrito"] = array();
}

$_SESSION["carrito"][] = $id_pizza;

header("Location: shopping_cart.php")

?>
