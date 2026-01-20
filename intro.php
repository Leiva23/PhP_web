<?php

echo "<h1>Hola que tal</h1>";

/*
$variable = 33;

echo $variable;
*/

function mi_funcion ($param1, $param2)
{
	echo "<p>El parametro 1: ".$param1."</p>";
	echo "<p>El parametro 2: ".$param2."</p>";
}

function retornando()
{
	$valor = 1000;
	return $valor;
}

mi_funcion("Marcos", "Pablo");

$resultado = retornando();

echo $resultado;

$nombre = "Jacinto";

echo "<p>hola ".$nombre."</p>";

for ($i = 0; $i < 10; $i++) {
	echo "<p>Número: ".$i."</p>";	
}

$num1 = 33;
$num2 = 15;

if ($num1 > $num2) {
	echo "Cierto";
}
else {
	echo "Falso";
}


?>
