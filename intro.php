<?php


/*
$variable = 33;

echo $variable;
*/

function mi_funcion ($param1, $param2)
{
	echo "<p>El parámetro 1: ".$param1."</p>";
	echo "<p>El parámetro 2: ".$param2."</p>";
}

function retornando ()
{
	$valor = 1000;

	return $valor;
}

mi_funcion(33, "Anselmito");

$resultado = retornando();

echo $resultado;

echo "<h1>Hola que tal</h1>";

$nombre = "Jacinto";

echo "<p>Hola ".$nombre."</p>";

for ($i = 0; $i < 10; $i++){
	echo "<p>Número: ".$i."</p>\n";
}

$num1 = 3;
$num2 = 15;

if ($num1 > $num2) {
	echo "Cierto";
}
else{
	echo "Falso";
}

?>
