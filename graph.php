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

  	<?php
	$p = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color();
	}
	echo  '
<div class="bargraph" style= "width: 700px;">';
echo'<ul class="bars">';
	$p = 0;
	$count = 0;
	foreach ($voters as $voter)
	{
		$right = $voting->count_answered_right($code, $voter);
		$count = $voting->count_answered($code, $voter);
		if ($count != 0)
		{
			$percent = ($count * 100) / $right;
		}
		else
		{
			$percent = 0;
		}

		echo '<li class="bar' . $p . '" style="height: ' . round(($percent * 2)) . 'px;background-color:' . $palette[$p] . '">' . $count . '</li>';
		$p = $p + 1;	
}
echo'</ul>';



echo'<ul class="label">';
	$p = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color();
		echo '<li class="user" style="color:' . $palette[$p] . ';"><span class="question">' . $voter . '</span>';
		$p = $p + 1;
}




echo'</ul>';
echo'<ul class="y-axis"><li>20</li><li>15</li><li>10</li><li>5</li><li>0</li></ul>
<p class="centered">Číslo počítače</p>';
	?>
	</div>
  </fieldset>
</div>