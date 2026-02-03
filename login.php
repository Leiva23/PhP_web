<?php
require_once("template.php");
writeHTML("Login y Registro");
openBody();

echo <<<EOD
<form method="POST" action="login_check.php">
	<h2>Login</h2>
	<p><label for="login-user">Usuario:</label>
	<input type="text" name="login_user" id="login-user"/></p>

	<p><label for="login-password">Contraseña:</label>
	<input type="password" name="login_password" id="login-password"/></p>

	<p><input type="submit" value="Identificar" /></p>
</form>

<hr />

<form method="POST" action="register_check.php">
	<h2>Registro de Nuevo Cliente</h2>
	<p><label for="reg-username">Nombre de Usuario:</label>
	<input type="text" name="reg_username" id="reg-username" required/></p>

	<p><label for="reg-password">Contraseña:</label>
	<input type="password" name="reg_password" id="reg-password" required/></p>

	<p><label for="reg-name">Nombre Real:</label>
	<input type="text" name="reg_name" id="reg-name" required/></p>

	<p><label for="reg-address">Dirección:</label>
	<input type="text" name="reg_address" id="reg-address" required/></p>

	<p><label for="reg-email">E-mail:</label>
	<input type="email" name="reg_email" id="reg-email" required/></p>

	<p><label for="reg-phone">Teléfono:</label>
	<input type="text" name="reg_phone" id="reg-phone" required/></p>

	<p><label for="reg-birthdate">Fecha de Nacimiento:</label>
	<input type="date" name="reg_birthdate" id="reg-birthdate" required/></p>

	<p><input type="submit" value="Registrarse" /></p>
</form>
EOD;

closeBody();
?>
