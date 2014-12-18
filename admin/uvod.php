<h1>Vítejte v administraci systému php-vote!</h1>

<h1>Správa hlasování</h1>

<table id="list">
<tr>
	<th class="long">Jméno</th>
	<th class="long">Počet otázek</th>
	<th class="long">Datum vytvoření</th>
	<th class="long">Identifikační kód</th>
	<th class="short">Přidat otázku</th>
	<th class="short">Výsledky</th>
	<th class="short">Odstranit</th>
	<th class="short">Uzavřít</th>
</tr>

<?php
foreach ($voting->view_votings() as $b)
	{
		$more = $voting->get_more($b);
		echo '
		<tr>
		<td>' . $more[0] . '</td>
		<td>' . $voting->question_count($b) . '</td>
		<td>' . $today = date("d.m.Y H:i:s", $more[2]) . '</td>
		<td>' . $b . '</td>
		<td><a href="index.php?voting_edit=' . $b . '"><img src="../img/edit.png" class="icons"></a></td>
		<td><a href="index.php?voting_result=' . $b . '"><img src="../img/result.png" class="icons"></a></td>
		<td><a href="index.php?voting_remove=' . $b . '"><img src="../img/erase.png" class="icons"></a></td>
		<td><a href="index.php?voting_lock=' . $b . '"><img src="../img/lock.png" class="icons"></a></td>
	</tr>';
	}
?>
</table>
<div style="height:10px;">

</div>


<?php
if (isset($_GET["voting_edit"]))
{
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
	echo "<h2>" . $voting->question_header($_GET["voting_edit"], $i) . "</h2>";
	echo "Možnosti: ";
	foreach ($voting->get_possibilities($_GET["voting_edit"], $i) as $possibility)
	{
		echo $possibility . "; ";
	}
	}
}

elseif(isset($_GET["voting_result"]))
{
	$q = 0;
	$p = 0;
	foreach ($voting->get_questions($_GET["voting_result"]) as $qid)
	{
		$q = $q + 1;
		echo "Otázka č. " . $q . ":<br/>";
		foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
		{
			$p = $p + 1;
			echo "Možnost č. " . $p . ":<br/>";
			foreach ($voting->get_result($_GET["voting_result"], $q, $p) as $echo)
			{
				echo $echo . ", ";
			}
			echo "<br/>";
		}
		$p = 0;
		echo "<hr>";
	}
  /* echo '
<div id="result">
			<h1>Celkem hlasů: 34</h1>
			<fieldset class="graph">
		<legend><a>Otázka 1</a>
			|
			<a>Otázka 2</a>
			|
			<a>Otázka 3</a>
			|
			<a>Otázka 4</a>
			|
			<a>Otázka 5</a>
		</legend>
<ul id="legenda">
	<li style="color:#F7464A;width:200px;"><span class="question">Odpověď 1</span>
	<li style="color:#46BFBD"><span class="question">Odpověď 2</span>
	<li style="color:#FDB45C"><span class="question">Odpověď 3</span>
	<li style="color:#2c6acf"><span class="question">Odpověď 4</span>
</ul>
		<div id="canvas-holder">
			<canvas id="chart-area" width="800" height="800"/>
		</div>

		</fieldset>
</div>';*/
}

elseif ($_GET["voting_lock"])
{
	$voting->voting_lock($_GET["voting_lock"]);
}

else
{
	echo '<h2>Vytvořit hlasování</h2>
<form method="POST">
	<input class="kod" type="textfield" name="voting_name" size="20" placeholder="Název hlasování">
	<div class="mezera"></div>
	<input id="new_poll" type="submit" value="Vytvořit nové hlasování" name="JPW">
</form>';
}
