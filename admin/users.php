<hr/>
<h2>Existující uživatelé</h2>
<table id="list">
	<tr>
		<th class="head">Uživatelské jméno</th>
		<th class="head">E-mail</th>
		<th class="head">Úroveň</th>
		<th class="head">Počet hlasování</th>
		<th class="head">Datum vytvoření</th>
		<th class="head">Upravit</th>
		<th class="head">Odstranit</th>
	</tr>

	<?php
	$levels = array(2 => "Učitel", 3=> "Správce");
	$qid = 0;
	foreach ($user->view_users() as $b)
	{
		$b = $b = substr($b, 0, -4); // returns username without .txt
		$user_data = $user->load_file($b);
		echo '
		<tr>
		<td>' . $b . '</td>
		<td>' . $user_data[1] . '</td>
		<td>' . $levels[$user_data[2]] . '</td>
		<td>' . sizeof($voting->view_votings($b, 0)) . '</td>
		<td>' . date("d.m.Y H:i:s", $user_data[3]) . '</td>
		<td><a href="index.php?sub=users&user_edit=' . $b . '"><img src="../img/edit.png" class="icons"></a></td>		
		<td><a href="#" data-toggle="modal" data-target="#delete_user' . $qid . '"><img src="../img/erase.png" class="icons"></a></td>
		</tr>';
		$qid = $qid + 1;
	}
	?>

</table>
<?php
if(!isset($_GET["user_edit"]))
{
echo '
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
<hr/>';
}

if(isset($_GET["user_edit"]))
{
echo '<h2>Upravit uživatele ' . $_GET["user_edit"] . '</h2>';

if ($_GET["user_edit"] != "admin")
{
echo '<form method="POST">
		<input class="kod" type="textfield" name="new_name" size="20" placeholder="Uživatelské jméno" value="' . $_GET["user_edit"] . '">
    <input class="registrovat" type="submit" value="Změnit jméno" name="JPW">
 	<div class="mezera"></div>
</form>
<br>
<form method="POST">
		<input class="kod" type="textfield" name="new_email" size="20" placeholder="Nový e-mail" value="' . $user->get_email($_GET["user_edit"]) . '">
    <input class="registrovat" type="submit" value="Změnit email" name="JPW">
</form>
<br>
<form method="POST">
		<input class="kod" type="textfield" name="new_password" size="20" placeholder="Nové heslo">
    <input class="registrovat" type="submit" value="Změnit heslo" name="JPW">
</form>';	
}

else
{
	echo '<div class="alert alert-info" role="alert">U účtu správce lze měnit jen heslo a email.</div>
	<form method="POST">
		<input class="kod" type="textfield" name="new_email" size="20" placeholder="Nový e-mail" value="' . $user->get_email($_GET["user_edit"]) . '">
    <input class="registrovat" type="submit" value="Změnit email" name="JPW">
</form>
<br>
<form method="POST">
		<input class="kod" type="textfield" name="new_password" size="20" placeholder="Nové heslo">
    <input class="registrovat" type="submit" value="Změnit heslo" name="JPW">
</form>
';
}

echo '<a class="btn btn-default btn-lg" href="index.php?sub=users" role="button">Zpět</a>';
}

$qid = 0;
foreach ($user->view_users() as $b)
{
		$b = $b = substr($b, 0, -4); // returns username without .txt
		echo '
		<!-- Modal -->
		<div class="modal fade" id="delete_user' . $qid . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Přejete si opravdu odstranit tohoto uživatele?</h4>
					</div>
					<div class="modal-body">
					' . $b . '
					</div>
					<div class="modal-footer">
					  <a href="index.php?sub=users&user_remove=' . $b . '"><button type="button" class="btn btn-danger" >Ano</button></a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Button trigger modal --> ';
		$qid = $qid + 1;
}

?>

