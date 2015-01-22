﻿<hr/>
<h2>Existující uživatelé</h2>
<table id="list">
	<tr>
		<th class="long">Uživatelské jméno</th>
		<th class="long">E-mail</th>
		<th class="long">Úroveň</th>
		<th class="short">Počet hlasování</th>
		<th class="short">Datum vytvoření</th>
		<th class="short">Odstranit</th>
	</tr>

	<?php
	$levels = array(2 => "Učitel", 3=> "Správce");
	foreach ($user->view_users() as $b)
	{
		$b = $b = substr($b, 0, -4); // returns $b without .txt
		$user_data = $user->load_file($b);
		echo '
		<tr>
		<td>' . $b . '</td>
		<td>' . $user_data[1] . '</td>
		<td>' . $levels[$user_data[2]] . '</td>
		<td>' . sizeof($voting->view_votings($b, 0)) . '</td>
		<td>' . date("d.m.Y H:i:s", $user_data[3]) . '</td>
		<td><a href="index.php?sub=uzivatele&user_remove=' . $b . '"><img src="../img/erase.png" class="icons"></a></td>
		</tr>';
	}
	?>

</table>
<h2>Vytvořit uživatele</h2>
<form method="POST">
	<input class="kod" type="textfield" name="username_register" size="20" placeholder="Uživatelské jméno">
	<br/><br/>
	<input class="kod" type="password" name="username_password" size="20" placeholder="Heslo uživatele">
	<br/><br/>
	<input class="kod" type="textfield" name="username_mail" size="20" placeholder="E-mail uživatele">
	<br/><br/>
	<select class="level" name="username_level" size="1">
<option value="2">Učitel</option>
<option value="3">Správce</option>
</select>
	<div class="mezera"></div>
    <input class="registrovat" type="submit" value="Vytvořit účet" name="JPW">
</form>
<hr/>
<h2>Upravit uživatele</h2>
<form method="POST">
	<input class="kod" type="textfield" name="old_name" size="20" placeholder="Staré uživ. jméno">
	<br/><br/>
		<input class="kod" type="textfield" name="new_name" size="20" placeholder="Nové uživ. jméno">
	<br/><br/>
    <input class="registrovat" type="submit" value="Změnit jméno" name="JPW">
 	<div class="mezera"></div>
</form>
<br>
<form method="POST">
		<input class="kod" type="textfield" name="cokoliv" size="20" placeholder="Uživatelské jméno">
	<br/><br/>
		<input class="kod" type="textfield" name="new_email" size="20" placeholder="Nový e-mail">
	<br/><br/>
    <input class="registrovat" type="submit" value="Změnit email" name="JPW">
</form>
<hr/>
