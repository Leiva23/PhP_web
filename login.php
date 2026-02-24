<?php

require_once("template.php");

writeHTML("Login");

openBody();

echo <<<EOD
<form method="POST" action="login_check.php">
	<h2>Login</h2>
	<p><label for="login-user">Usuario:</label>
	<input type="text" name="login_user" id="login-user"/></p>

	<p><label for="login-password">Contraseña:</label>
	<input type="password" name="login_password" id="login-password"/></p>

	<p><input type="submit" value="Indentificar" /></p>
</form>


<form method="POST" action="register_check.php">
	<h2>Registro</h2>
	<p><label for="register-user">Usuario:</label>
	<input type="text" name="register_user" id="register-user" required /></p>

	<p><label for="register-password">Contraseña:</label>
	<input type="password" name="register_password" id="register-password"/></p>

	<p><label for="register-repassword">Comprobación de contraseña:</label>
	<input type="password" name="register_repassword" id="register-repassword"/></p>

	<p><label for="register-email">e-mail :</label>
	<input type="email" name="register_email" id="register-email"/></p>

	<p><label for="register-date">Fecha de nacimiento:</label>
	<input type="date" name="register_date" id="register-date"/></p>


	<p><input type="submit" value="Registrar" /></p>


</form>

EOD;






closeBody();

?>
