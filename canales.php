<?php

$id_pizza = 0;

if (isset($_GET["id_pizza"])){
	$id_pizza = $_GET["id_pizza"];
}

print_r($_GET);

for ($i = 0; $i < $id_pizza; $i++) {
	echo $i;
}

echo "hola";

echo "hola2";

?>
