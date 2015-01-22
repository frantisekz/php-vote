<hr/>
<h1>Vítejte v administraci systému php-vote!</h1>

<h1>Správa hlasování</h1>

<?php
if ((!isset($_GET["voting_edit"])) AND (!isset($_GET["voting_result"])) AND (!isset($_GET["voting_remove"])) AND (!isset($_GET["voting_lock"])))
{
	echo '
	<table id="list">
	<tr>
	<th class="long">Jméno</th>
	<th class="long">Počet otázek</th>
	<th class="long">Datum vytvoření</th>
	<th class="long">Identifikační kód</th>
	<th class="short">Přidat/Upravit ot.</th>
	<th class="short">Výsledky</th>
	<th class="short">Odstranit</th>
	<th class="short">Uzavřít</th>
	</tr>';
	if ($voting->view_votings($user->get_cur_username(), 0)!=0)
	{
  	foreach ($voting->view_votings($user->get_cur_username(), 0) as $b)
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
			<td><a href="index.php?voting_lock=' . $b . '"><img src="../img/locked.png" class="icons"></a></td>
		</tr>';
	}
  }

}
	echo '</table>';
?>
<div style="height:10px;">

</div>


<?php
if (isset($_GET["voting_edit"]))
{
include("voting_edit.php");
}

elseif(isset($_GET["voting_result"]))
{
include("voting_result.php");
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
?>
<hr/>
