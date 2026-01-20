<?php

$array = [1, "papafrita", true];

echo $array[1];

echo "Array associativo\n";

$array_assoc = [
	"uno" => 1,
	"dos" => 2
];


$array_assoc["clave"] = "valor";
$array_assoc["otra_clave"] = 33;

echo $array_assoc["dos"];

print_r($array_assoc);
?>
