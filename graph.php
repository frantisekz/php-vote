<div id="result">
<?php
if (!isset($_POST["voting_code"]))
{
	$code = $_GET["voting_result"];
}
else
{
	$code = $_POST["voting_code"];
}
$voters = $voting->voters($code);
?>

<h1>Graf počtu správných hlasů</h1> - <strong>Hlasování číslo <?php echo $code ?></strong>
<fieldset class="graph">
  <ul id="legenda">
  	<?php
	$p = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color();
		echo '<li style="color:' . $palette[$p] . ';"><span class="question">' . $voter . '</span>';
		$p = $p + 1;
	}
	echo  '
  </ul>
  <div class="chart">';
	$p = 0;
	$count = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		if ($count != 0)
		{
			$percent = ($count * 100) / $right;
		}
		else
		{
			$percent = 0;
		}
		echo '<div style="width: ' . round(($percent * 4)) . 'px;background-color:' . $palette[$p] . '">' . $count . '</div>';
		$p = $p + 1;
	}
	?>
	</div>
  </fieldset>
</div>