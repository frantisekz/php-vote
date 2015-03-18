<hr/>
<?php

if (!isset($_SESSION["welcome"]))
{
	echo '<h1>Vítejte v administraci systému php-vote!</h1>';
	$_SESSION["welcome"] = 1;
}

echo '<h1>Správa hlasování</h1>';
if ((!isset($_GET["voting_edit"])) AND (!isset($_GET["voting_result"])) AND (!isset($_GET["voting_remove"])) AND (!isset($_GET["voting_lock"])))
{
	echo '
	<table id="list">
	<tr>
	<th class="long">Název</th>
	<th class="long">Počet otázek</th>
	<th class="long">Datum vytvoření</th>
	<th class="long">Identifikační kód</th>
	<th class="short">Upravit otázku</th>
	<th class="short">Výsledky</th>
	<th class="short">Odstranit</th>
	<th class="short">Uzamčení</th>
	</tr>';
	if ($voting->view_votings($user->get_cur_username(), 0)!=0)
	{
	$qid = 0;
  	foreach ($voting->view_votings($user->get_cur_username(), 0) as $b)
	{
	    $qid = $qid + 1;
			$more = $voting->get_more($b);
			echo '
			<tr>
			<td>' . $more[0] . ' <br/>['; if ($more[3] == 0) {echo "Uzamčeno";} else {echo "Otevřeno";} echo ']</td>
			<td>' . $voting->question_count($b) . '</td>
			<td>' . $today = date("d.m.Y H:i:s", $more[2]) . '</td>
			<td>' . $b . '</td>
			<td><a href="index.php?voting_edit=' . $b . '"><img src="../img/edit.png" class="icons"></a></td>
			<td><a href="index.php?voting_result=' . $b . '"><img src="../img/result.png" class="icons"></a></td>
			<td><a href="#" data-toggle="modal" data-target="#delete' . $qid . '"><img src="../img/erase.png" class="icons"></a></td>
			<td><a href="index.php?voting_'; if ($more[3] == 0) {echo "un";} echo 'lock=' . $b . '"><img src="../img/'; if ($more[3] == 0) {echo "un";} echo 'locked.png" class="icons"></a></td>
		</tr>';
		
	}
  }

}
	echo '</table>';
	$qid = 0;
	foreach ($voting->view_votings($user->get_cur_username(), 0) as $b)
	{
	$qid = $qid + 1;
echo	'	<!-- Modal -->
	<div class="modal fade" id="delete' . $qid . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Přejete si opravdu odstranit toto hlasování?</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
				  <a href="index.php?voting_remove=' . $b . '"><button type="button" class="btn btn-danger" >Ano</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Button trigger modal --> ';
	}
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
