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
		$combined[$voter] = $percent;
	}
	// Sort array  from high to low
	arsort($combined);
	echo '<div class="bargraph" style= "width: 700px;">';
	echo'<ul class="bars">';

	$p = 0;
	foreach ($combined as $percent)
	{
		$height = round(($percent * 2));
if ($percent == 0)
{
echo ' <li class="bar' . $p . '" id= "' . ($height + $p) . '" style="height: 0px;background-color:' . $palette[0][$p] . ';"><h4>' . round($percent) . '%</h4></li>';
}	
else{
		echo ' <li class="bar' . $p . '" id= "' . ($height + $p) . '" style="height: 0px;background-color:' . $palette[0][$p] . ';">' . round($percent) . '%</li>';
}
		echo ' <script>
		$(document).ready(function(){
	$("#' . ($height + $p) . '").animate({height: "' . $height . 'px"}, 1500);
	});
</script>';
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

<!--<script>
$(document).ready(function(){
    $("ul").find("#' . $height . '").animate({height: "' . $height . '"}, 1000);
});
</script> -->