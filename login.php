<?php

require_once("template.php");

writeHTML("Login");

openBody();

echo <<<EOD
<form method="POST" action="login_check.php">
	<h2>Login</h2>
	<p><label for="login-user">Usuario:</label>
	<input type="text" name="login_user" id="login-user"/></p>
	
	<p><label for="login-password">Password:</label>
	<input type="text" name="login_password" id="login-password"/></p>
	
	<p><input type="submit" value="Identificar" /></p>
	<p></p>
</form>
EOD;

closeBody();

?>
