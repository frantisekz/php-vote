<h1>Vítejte v administraci systému php-vote!</h1>
<a href="../"><strong>Přejít na web</strong></a>

<?php

if (isset($_POST["username_register"]))
{
	register($_POST["username_register"], $_POST["username_password"], $_POST["username_mail"], $_POST["username_level"]);
}
?>

<h2>Vytvořit uživatele</h2>

<form method="POST">
	<input class="kod" type="textfield" name="username_register" size="20" placeholder="Uživatelské jméno">
	<input class="kod" type="textfield" name="username_password" size="20" placeholder="Heslo uživatele">
	<input class="kod" type="textfield" name="username_mail" size="20" placeholder="E-mail uživatele">
	<input class="kod" type="textfield" name="username_level" size="20" placeholder="Úroveň uživatele">
	<div class="mezera"></div>
    <input class="vstoupit" type="submit" value="Vytvořit účet" name="JPW">
</form>