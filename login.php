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
EOD;

// Formulario de registro
echo <<<EOD
<form method="POST" action="register_check.php">
        <h2>Regístrate en Pizzería Muso</h2>

        <p><label for="register-username">Nombre de usuario:</label>
        <input type="text" name="register_username" id="register-username"/></p>

        <p><label for="register-password">Contraseña:</label>
        <input type="password" name="register_password" id="register-password"/></p>

        <p><label for="register-repassword">Comprobación de contraseña:</label>
        <input type="password" name="register_repassword" id="register-repassword"/></p>

        <p><label for="register-name">Nombre:</label>
        <input type="text" name="register_name" id="register-name"/></p>

        <p><label for="register-address">Dirección:</label>
        <input type="text" name="register_address" id="register-address"/></p>

        <p><label for="register-email">E-mail:</label>
        <input type="email" name="register_email" id="register-email"/></p>

        <p><label for="register-phone">Teléfono:</label>
        <input type="tel" name="register_phone" id="register-phone"/></p>

        <p><label for="register-birth">Fecha de nacimiento:</label>
        <input type="date" name="register_birth" id="register-birth"/></p>

        <p><input type="submit" value="Crear cuenta" /></p>
</form>
EOD;

closeBody();

?>
