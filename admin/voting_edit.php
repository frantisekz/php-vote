<?php
if (isset($_GET["edit_question"]))
{
	echo '<h3>Úpravy hlasování č. ' . $_GET["voting_edit"] . ', otázka: ' . $voting-

>question_header($_GET["voting_edit"], $_GET["edit_question"]) . '</h3>
	<form method="POST">
	<strong>Název otázky: </strong><input class="moznost" type="textfield" 

name="question_name_edit" size="20" value="' . $voting->question_header($_GET["voting_edit"], 

$_GET["edit_question"]) . '" placeholder="Nový název otázky">
	<div class="mezera"></div>
	<br>
	<input id="new_poll" type="submit" value="Uložit otázku" name="JPW">
	<a class="btn btn-default btn-lg" href="index.php?voting_edit=' . $_GET["voting_edit"] 

. '" role="button">Zpět</a>
	</form>

	<form method="POST">
	<input class="moznost" type="textfield" name="possibility_new" size="20" 

placeholder="Možnost">
	<input id="new_poll" type="submit" value="Přidat možnost" name="JPW">
	</form>

	<form method="POST">
	';
	$i = 1;
	foreach ($voting->get_possibilities($_GET["voting_edit"], $_GET["edit_question"]) as 

$possibility)
	{
		echo '<strong>Možnost ' . $i . '</strong><input class="moznost" 

type="textfield" name="edit_possibility_' . $i . '" placeholder="' . $possibility . '" 

size="20"> <input class="submit_question" type="submit" value="Upravit">';
		echo '<a href="index.php?voting_edit=' . $_GET["voting_edit"] . 

'&edit_question=' . $_GET["edit_question"] . '&remove_possibility=' . $i . 

'">Odstranit</a><br/>';
		$i = $i + 1;
	}
	echo '</form>';
}
else
{
	echo '<h3>Úpravy hlasování č. ' . $_GET["voting_edit"] . '</h3>';
	echo '
	<div class="alert alert-info" role="alert">
		Nepotřebné možnosti ponechejte prázdné, později můžete další přidat přes 

tlačítko <strong>Upravit otázku</strong><br/>

	</div>
	<form method="POST">
	<input class="kod" type="textfield" name="question_name" size="20" placeholder="Název 

otázky">
	<div id="odpovedi">
		<strong>Možnost 1: </strong><input class="moznost" type="textfield" 

name="possibility_1" size="20" placeholder="Možnost 1">
		<strong>Možnost 2: </strong><input class="moznost" type="textfield" 

name="possibility_2" size="20" placeholder="Možnost 2"><br/>
		<strong>Možnost 3: </strong><input class="moznost" type="textfield" 

name="possibility_3" size="20" placeholder="Možnost 3">
		<strong>Možnost 4: </strong><input class="moznost" type="textfield" 

name="possibility_4" size="20" placeholder="Možnost 4"><br/>
		<strong>Možnost 5: </strong><input class="moznost" type="textfield" 

name="possibility_5" size="20" placeholder="Možnost 5">
		<strong>Možnost 6: </strong><input class="moznost" type="textfield" 

name="possibility_6" size="20" placeholder="Možnost 6"><br/>
		<strong>Možnost 7: </strong><input class="moznost" type="textfield" 

name="possibility_7" size="20" placeholder="Možnost 7">
		<strong>Možnost 8: </strong><input class="moznost" type="textfield" 

name="possibility_8" size="20" placeholder="Možnost 8"><br/>
	</div>
	<strong>Číslo správné odpovědi: </strong>
	<select name="possibility_right">
		<option value="1">Možnost 1</option>
		<option value="2">Možnost 2</option>
		<option value="3">Možnost 3</option>
		<option value="4">Možnost 4</option>
		<option value="5">Možnost 5</option>
		<option value="6">Možnost 6</option>
		<option value="7">Možnost 7</option>
		<option value="8">Možnost 8</option>
	</select>
	<div class="mezera"></div>
	<br>
	<input class="submit_question" type="submit" value="Uložit otázku">
	<a class="btn btn-default btn-lg" href="index.php" role="button">Zpět</a>
	</form>
	<hr>
	<h3>Existující otázky:</h3>
	';
	$i = 0;

	foreach ($voting->get_questions($_GET["voting_edit"]) as $qid)
	{
		$i = $i + 1;
		if ($voting->question_exists($_GET["voting_edit"], $i))
		{
			echo '<h2>' . $voting->question_header($_GET["voting_edit"], $i) . 

'</h2>
			<a id="delete" href="index.php?voting_edit=' . $_GET["voting_edit"] . 

'&remove_question=' . $i . '">Odstranit otázku</a>
|
			<a id="edit" href="index.php?voting_edit=' . $_GET["voting_edit"] . 

'&edit_question=' . $i . '">Upravit otázku</a><br/>
			';
			echo "Možnosti: ";
			$p = 0;
			foreach ($voting->get_possibilities($_GET["voting_edit"], $i) as 

$possibility)
			{
				$p = $p + 1;
				if ($p == $voting->question_right($_GET["voting_edit"], $qid))
				{
					echo '<strong>' . $possibility . "</strong>; ";
				}
				else
				{
					echo $possibility . "; ";
				}
			}
		}
		}
}
?>