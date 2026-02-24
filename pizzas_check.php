<?php
session_start();
require_once("conf.database.php");

if (!isset($_POST["id_pizza"])) {
    header("Location: pizzas.php");
    exit();
}

$id_pizza = intval($_POST["id_pizza"]);

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
    die("Error crítico de conexión");
}

// comprobacion de que la pizza existe en la DB
$query = "SELECT id_pizza FROM pizzas WHERE id_pizza = {$id_pizza}";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 1) {
    die("Error: Esa pizza no existe en el menú.");
}

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}

$_SESSION["carrito"][] = $id_pizza;

header("Location: pizzas.php");
exit();
?>
