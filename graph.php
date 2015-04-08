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

if (!isset($code))
{
	echo "<strong>Chybný kód!!!</strong>";
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
		$percent = round($percent);
		$combined[$voter] = $percent;
	}
	// Sort array  from high to low
	arsort($combined);
	
	echo '<div class="bargraph" style= "width: 700px;">';
	echo'<ul class="bars">';

	$p = 0;
	$j = 0;
	for ($i = 100; $i >= 0; $i--)
	{
		$keys = array_keys($combined, $i);
		if (!empty($keys))
		{
			sort($keys);
			$height = $i * 2;
			while ($j < sizeof($keys))
			{
				if ($i == O)
				{
					echo ' <li class="bar' . $p . '" id= "' . ($height + $p) . '" style="height: 0px;background-color:' . $palette[0][$p] . ';"><h4>' . $i . '%</h4></li>';
				}
				else
				{
					echo ' <li class="bar' . $p . '" id= "' . ($height + $p) . '" style="height: 0px;background-color:' . $palette[0][$p] . ';">' . $i . '%</li>';
				}
				echo ' <script>
				$(document).ready(function(){
				$("#' . ($height + $p) . '").animate({height: "' . $height . 'px"}, 1500);
				});
				</script>';
				$j = $j + 1;
				$p = $p + 1;
			}
			$j = 0;
		}
	}
echo'</ul>
<ul class="label">';
	$p = 0;
	for ($i = 100; $i >= 0; $i--)
	{
		$keys = array_keys($combined, $i);
		if (!empty($keys))
		{
			sort($keys);
			while ($p < sizeof($keys))
			{
				echo '<li class="user" style="color:' . $palette[$p] . ';"><span class="question">' . $keys[$p] . '</span>';
				$p = $p + 1;
			}
			$p = 0;
		}
	}
echo'</ul>
<ul class="y-axis"><li>100%</li><li>75%</li><li>50%</li><li>25%</li><li>0%</li></ul>
<p class="centered">Číslo počítače</p>';
	?>
	</div>
  </fieldset>
</div>