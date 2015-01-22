<?php
echo '<a href="index.php">Zpět na přehled všech hlasování</a><br/>';
echo '<h3>Výsledky hlasování č. ' . $_GET["voting_result"] . '</h3>';
echo '
<div id="result">';
$count = 0;
$p = 0;
$questions = $voting->get_questions($_GET["voting_result"]);
$voters = $voting->voters($_GET["voting_result"]);

foreach ($questions as $qid)
{
	foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
	{
		$count = $count + sizeof($voting->get_result($_GET["voting_result"], $qid, $p));
		$p = $p + 1;
	}
}
$right = 0;
$count = 0;
foreach ($voters as $voter)
{
	$count = $voting->count_answered_right($_GET["voting_result"], $voter);
	$right = $right + $count;
}

echo '<h1>Správných hlasů: ' . $right . '</h1>
<fieldset class="graph">
	<ul id="legenda">';
		$p = 0;
		foreach ($voters as $voter)
		{
			$palette[] = random_color();
			echo '<li style="color:' . $palette[$p] . ';"><span class="question">' . $voter . '</span>';
			$p = $p + 1;
		}
		echo  '
	</ul>
	<div class="chart">';
		$p = 0;
		foreach ($voters as $voter)
		{
			$count = $voting->count_answered_right($_GET["voting_result"], $voter);
			echo '<div style="width: ' . ($count * 10) . 'px;background-color:' . $palette[$p] . '">' . $count . '</div>';
			$p = $p + 1;
		}
		echo '
		</div>
	</fieldset>
</div>
';

$q = 0;
$p = 0;
foreach ($questions as $qid)
{
	$q = $q + 1;
	echo '<h1>Otázka: ' . $qid . '</h1> ';
	foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
	{
		$p = $p + 1;
echo "<h11>";
			echo $pid . '<br/>';
echo "</h11>";
echo "<h12>Pro tuto možnost hlasovali: </h12>";
		foreach ($voting->get_result($_GET["voting_result"], $q, $p) as $echo)
		{
			echo $echo . ", ";
		}
		echo "<br/><br/>";
	}
	echo '
	<!-- Modal -->
	<div class="modal fade" id="myModal' . $qid . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Graf k otázce: ' . $voting->question_header($_GET["voting_result"], $qid) . '</h4>
				</div>
				<div class="modal-body">
				<div id="result">';
					$count = 0;
					$p = 0;
					foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
					{
						$count = $count + sizeof($voting->get_result($_GET["voting_result"], $qid, $p));
						$p = $p + 1;
					}
					echo '<h1>Celkem hlasů: ' . $count . '</h1>
					<fieldset class="graph">
						<ul id="legenda">';
							$p = 0;
							foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
							{
								$palette[] = random_color();
								echo '<li style="color:' . $palette[$p] . ';"><span class="question">' . $pid . '</span>';
								$p = $p + 1;
							}
							echo  '
						</ul>
						<div class="chart">';
							$p = 0;
							foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
							{
								$size = sizeof($voting->get_result($_GET["voting_result"], $qid, $p));
								echo '<div style="width: ' . ($size * 10) . 'px;background-color:' . $palette[$p] . '">' . $size . '</div>';
								$p = $p + 1;
							}
							echo '
						</div>
					</fieldset>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal' . $qid . '">
	Zobrazit graf
	</button>
	';
	echo "<hr>";
}
?>