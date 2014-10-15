<h1>Vítejte v administraci systému php-vote!</h1>
<a href="../"><strong>Přejít na web</strong></a>

<?php

if (isset($_POST["username_register"]))
{
	register($_POST["username_register"], $_POST["username_password"], $_POST["username_mail"], $_POST["username_level"]);
}
?>

<hr/>
<h2>Vytvořit uživatele</h2>

<form method="POST">
	<input class="kod" type="textfield" name="username_register" size="20" placeholder="Uživatelské jméno">
	<br/><br/>
	<input class="kod" type="password" name="username_password" size="20" placeholder="Heslo uživatele">
	<br/><br/>
	<input class="kod" type="textfield" name="username_mail" size="20" placeholder="E-mail uživatele">
	<br/><br/>
	<select class="level" name="username_level" size="1"> 
		<option value="1" selected>1 - user</option>
<option value="2">2 - moderator</option>
<option value="3">3 - admin</option>
</select>
	<div class="mezera"></div>
    <input class="registrovat" type="submit" value="Vytvořit účet" name="JPW">
</form>
<hr/>