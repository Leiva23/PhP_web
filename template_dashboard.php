<?php


function openDashboard ($title)
{
	echo <<<EOD
<aside>
<h2>Dashboard</h2>
<nav>
	<menu>
		<li><a href="dashboard_users.php">Usuario+roles</a></li>
		<li><a href="dashboard_pizzas.php">Pizzas</a></li>
		<li><a href="dashboard_ingredients.php">Ingredientes</a></li>
		<li><a href="dashboard_orders.php">Pedidos</a></li>
		<li><a href="dashboard_comments.php">Comentarios</a></li>
	</menu>
</nav>
</aside>

<section>
<h2>{$title}</h2>
EOD;
}

function closeDashboard()
{
	echo <<<EOD
</section>
EOD;
}


?>
