<?php
if (isset($_GET["edit_question"]))
{
	echo '<a href="index.php?voting_edit=' . $_GET["voting_edit"] . '">Zpět na úpravy hlasování</a><br/>';
	echo '<h3>Úpravy hlasování č. ' . $_GET["voting_edit"] . ', otázka: ' . $voting->question_header($_GET["voting_edit"], $_GET["edit_question"]) . '</h3>
	<form method="POST">
	<input class="moznost" type="textfield" name="question_name_edit" size="20" placeholder="Nový název otázky">
	<div class="mezera"></div>
	<br>
	<input id="new_poll" type="submit" value="Uložit otázku" name="JPW">
	</form>
	';
	$i = 1;
	foreach ($voting->get_possibilities($_GET["voting_edit"], $_GET["edit_question"]) as $possibility)
	{
		echo $possibility . ' - <a href="index.php?voting_edit=' . $_GET["voting_edit"] . '&edit_question=' . $_GET["edit_question"] . '&remove_possibility=' . $i . '">Odstranit</a><br/>';
		$i = $i + 1;
	}
}
else
{
	echo '<a href="index.php">Zpět na přehled všech hlasování</a><br/>';
	echo '<h3>Úpravy hlasování č. ' . $_GET["voting_edit"] . '</h3>';
	echo '<script type="text/javascript">
	var counter=5;
	function pridejInput() {
		document.getElementById(\'odpovedi\').innerHTML += "<input class=\"moznost\" type=\"textfield\" name=\"possibility_"+counter+"\" size=\"20\" placeholder=\"Možnost "+counter+"\">";
		document.getElementById(\'pocet\').value=counter++;
	}
	</script>
	<form method="POST">
	<input class="kod" type="textfield" name="question_name" size="20" placeholder="Název otázky">
	<div id="odpovedi">
	<input class="moznost" type="textfield" name="possibility_1" size="20" placeholder="Možnost 1">
	<input class="moznost" type="textfield" name="possibility_2" size="20" placeholder="Možnost 2">
	<input class="moznost" type="textfield" name="possibility_3" size="20" placeholder="Možnost 3">
	<input class="moznost" type="textfield" name="possibility_4" size="20" placeholder="Možnost 4">
	<input type="hidden" id="pocet" name="pocet" value="0">
	</div>
	<input class="moznost" type="textfield" name="possibility_right" size="20" placeholder="Číslo správné odpovědi">
	<div class="mezera"></div>
	<a id="pridat" href="" onClick="pridejInput();return false;">Přidat  </a>
	|
	<a id="odebrat" href="" onClick="pridejInput();return false;">  Odebrat</a>
	<br>
	<input id="new_poll" type="submit" value="Uložit otázku" name="JPW">
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
			echo '<h2>' . $voting->question_header($_GET["voting_edit"], $i) . '</h2>
			<a href="index.php?voting_edit=' . $_GET["voting_edit"] . '&remove_question=' . $i . '">Odstranit otázku</a>
			<a href="index.php?voting_edit=' . $_GET["voting_edit"] . '&edit_question=' . $i . '">Upravit otázku</a><br/>
			';
			echo "Možnosti: ";
			foreach ($voting->get_possibilities($_GET["voting_edit"], $i) as $possibility)
			{
				echo $possibility . "; ";
			}
		}
		}
}
?>