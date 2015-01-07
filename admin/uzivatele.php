<hr/>
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
	foreach ($user->view_users() as $b)
	{
		$b = chop($b,".txt");
		echo '
		<tr>
		<td>' . $b . '</td>
		<td>E-mail</td>
		<td>Úroveň</td>
		<td>Počet hlasování</td>
		<td>Datum vytvoření</td>
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
