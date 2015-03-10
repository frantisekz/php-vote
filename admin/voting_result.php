<?php
echo '<a class="btn btn-default btn-lg" href="index.php" role="button">Zpět</a>
<h3>Výsledky hlasování č. ' . $_GET["voting_result"] . '</h3>
<div id="result">';
$count = 0;
$p = 0;
$right = 0;
$questions = $voting->get_questions($_GET["voting_result"]);
$voters = $voting->voters($_GET["voting_result"]);
foreach ($voters as $voter)
{
	$count = $voting->count_answered_right($_GET["voting_result"], $voter);
	$right = $right + $count;
}
$q = 0;
$p = 0;
foreach ($questions as $qid)
{
	$q = $q + 1;
	if ($voting->question_exists($_GET["voting_result"], $q))
	{
		echo '<h1>Otázka: ' . $voting->question_header($_GET["voting_result"], $qid). '</h1> ';
	foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
	{
		$p = $p + 1;
		echo '<h11';
		if ($p == $voting->question_right($_GET["voting_result"], $qid))
		{
			echo ' class="green"';
		}
		echo '>';
		echo $pid . '<br/>';
		echo "</h11>";
		echo "<h12>Pro tuto možnost hlasovali: </h12>";
		foreach ($voting->get_result($_GET["voting_result"], $q, $p) as $echo)
		{
			echo $echo . ", ";
		}
		echo "<br/><br/>";
	}
	$p = 0;
	echo '
	<!-- Modal -->
	<div class="modal fade" id="myModal' . $qid . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:900px;">
      <div class="modal-content" style="width:900px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Graf k otázce: ' . $voting->question_header($_GET["voting_result"], $qid) . '</h4>
				</div>
				<div class="modal-body">
				<div id="result">';
					$count = 0;
					foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
					{
						$p = $p + 1;
						$count = $count + sizeof($voting->get_result($_GET["voting_result"], $qid, $p));
					}
					$p = 0;
					echo '<h1>Celkem hlasů: ' . $count . '</h1>
					<fieldset class="graph">';
							foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
							{
								$palette[] = random_color();
							}
							echo  '
<div class="bargraph2" style= "width: 700px;">';
echo'<ul class="bars">';
foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
{
	$p = $p + 1;
	$size = sizeof($voting->get_result($_GET["voting_result"], $q, $p));
	if ($size == 0)
	{
		$height = 10;
	}
	else
	{
		$height = $size * 14;
	}
	echo '<li class="bar' . ($p - 1) . '" style="height: ' . $height . 'px;background-color:' . $palette[$p] . '">' . $size . '</li>';
}
$p = 0;
echo '</ul>';
echo'<ul class="label2" style="left:-10px">';
foreach ($voting->get_possibilities($_GET["voting_result"], $qid) as $pid)
	{
		$p = $p + 1;
		$palette[] = random_color();
		echo '<li class="user" style="color:' . $palette[$p] . ';"><span class="question">' . $pid . '</span>';
}
$p = 0;
echo'</ul>
<p class="centered">Odpovědi</p>

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
}
?>