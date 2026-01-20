<?php


function writeHTML	($title="Pizzeria Musso")
{
	echo <<<EOD
<!doctype html>
<html>
<head>	
	<title>{$title}</title>	
</head>
EOD;
}

function openBody ()
{
	echo <<<EOD
<!-- Abrimos Body -->
<body>
<header>
	<hgroup>
		<h1>Pizzeria Muso</h1>
		<p>La Pizzeria más Italiana de la WWII</p>
	</hgroup>
	<nav>
		<menu>
			<li><a href="index.php">Portada</a></li>
			<li><a href="pizzas.php">Pizzas</a></li>
			<li><a href="top.php">Top 5</a></li>
			<li><a href="login.php">Login</a></li>
		</menu>
	</nav>
</header>

<main>
EOD;
}

function closeBody	()
{
	echo <<<EOD
</main>

<footer>
<p>Copyright (c) Musso Linni</p>
</footer>

</body>
</html>
EOD;
}

?>
