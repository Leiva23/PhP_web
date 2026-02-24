<?php

function writeHTML ($title="Pizzería Musso")
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
     $login_link = '<a href="login.php">Login</a>';
     $num_carrito = 0;

     if (session_status() === PHP_SESSION_ACTIVE){
         if (isset($_SESSION["id_user"])){
             $login_link = '<a href="logout.php">Logout</a>';
         }
         
         // si existe el array en la sesion contamos las casillas
         if (isset($_SESSION["carrito"])){
             $num_carrito = count($_SESSION["carrito"]);
         }
     }

     echo <<<EOD
<body>
<header>
     <hgroup>
         <h1>Pizzería Musso</h1>
         <p>La Pizzería más Italiana de la WWII</p>
     </hgroup>
     <nav>
         <menu>
             <li><a href="index.php">Portada</a></li>
             <li><a href="pizzas.php">Pizzas</a></li> 
             <li><a href="shopping_cart.php"> 🍕 {$num_carrito})</a></li> 
			 <li><a href="top5.php">Top 5</a></li>
             <li>{$login_link}</li>
         </menu>
     </nav>
</header>

<main>
EOD;

}

function closeBody ()
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
