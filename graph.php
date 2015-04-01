<div id="result">
<?php
if (!isset($_POST["voting_code"]))
{
	$code = $_GET["voting_result"];
}
elseif(isset($_POST["voting_code"]))
{
	$code = $_POST["voting_code"];
}
else
{
	die();
}

if ($voting->voting_exists($code)!= 1)
{
	echo "<strong>Chybný kód!!!</strong>";
	die();
}
$voters = $voting->voters($code);
?>

<h1>Graf počtu správných hlasů</h1> - <strong>Hlasování číslo <?php echo $code ?></strong>
<fieldset class="graph">

  	<?php
  	$count = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color($voters);

		$right = $voting->count_answered_right($code, $voter);
		$count = $voting->count_answered($code, $voter);
		if ($count != 0)
		{
			$percent = ($right * 100) / $count;
		}
		else
		{
			$percent = 0;
		}
		// Recreate array with voters as key and their percents
		settype($percent, "int");
		$combined[$voter] = $percent;
	}
	// Sort array  from low to high
	arsort($combined);
	echo '<div class="bargraph" style= "width: 700px;">';
	echo'<ul class="bars">';

	$p = 0;
	foreach ($combined as $percent)
	{
		/*$right = $voting->count_answered_right($code, $voter);
		$count = $voting->count_answered($code, $voter);
		if ($count != 0)
		{
			$percent = ($right * 100) / $count;
		}
		else
		{
			$percent = 0;
		}*/

		$height = round(($percent * 2));
		if ($height == 0)
		{
			$height = 10;
		}
		echo '<li class="bar' . $p . '" style="height: ' . $height . 'px;background-color:' . $palette[0][$p] . ';">' . round($percent) . '%</li>';
		$p = $p + 1;
}
echo'</ul>';



echo'<ul class="label">';
	$p = 0;
	foreach(array_keys($combined) as $key) 
	{
		echo '<li class="user" style="color:' . $palette[$p] . ';"><span class="question">' . $key . '</span>';
		$p = $p + 1;
}

echo'</ul>';
echo'<ul class="y-axis"><li>100%</li><li>75%</li><li>50%</li><li>25%</li><li>0%</li></ul>
<p class="centered">Číslo počítače</p>';
	?>
	</div>
  </fieldset>
</div>