<?php

session_start();

require_once("func.session_check.php");
require_once("template.php");
require_once("conf.database.php");

writeHTML();

openBody();

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$conn){
     die("Error 1: No se pudo conectar con la base de datos");
}

$id_user = session_check($conn);

$query = <<<EOD
SELECT *
FROM pizzas
ORDER BY price ASC
EOD;

$result = mysqli_query($conn, $query);

if (!$result){
     echo "<p>No se ha podido obtener el listado de pizzas</p>";
     closeBody();
     exit();
}

echo <<<EOD
<section id="pizza_list">
<h2>Listado de Pizzas</h2>
EOD;

while ($pizza = $result->fetch_assoc()){
     
     
     echo <<<EOD
<article>
     <h3>{$pizza["pizza"]}</h3>
     <p><img src="imgs/pizza_{$pizza["id_pizza"]}.jpg" style="height:300px" /></p>
     <p>{$pizza["description"]}</p>
     <p>{$pizza["price"]} €</p>
     <form action="pizzas_check.php" method="POST">
        <input type="hidden" name="id_pizza" value="{$pizza["id_pizza"]}" />
        <button type="submit">🍕 Comprar</button>
     </form>
</article>

EOD;
}
echo "</section>";

closeBody();

?>
