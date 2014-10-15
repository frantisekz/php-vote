<h1>Vítejte v administraci systému php-vote!</h1>
<a href="../"><strong>Přejít na web</strong></a>

<?php

if (isset($_POST["username_register"]))
{
	register($_POST["username_register"], $_POST["username_password"], $_POST["username_mail"], $_POST["username_level"]);
}
?>