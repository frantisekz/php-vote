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
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color($voters);
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
			$percent = ($right * 100) / $count;
		}
		else
		{
			$percent = 0;
		}
		$height = round(($percent * 2));
		if ($height == 0)
		{
			$height = 1;
		}
		echo '<li class="bar' . $p . '" style="height: ' . $height . 'px;background-color:' . $palette[$p] . '">' . $percent . '%</li>';
		$p = $p + 1;
}
echo'</ul>';



echo'<ul class="label">';
	$p = 0;
	foreach ($voters as $voter)
	{
		$count = $voting->count_answered_right($code, $voter);
		$right = $right + $count;
		$palette[] = random_color($voters);
		echo '<li class="user" style="color:' . $palette[$p] . ';"><span class="question">' . $voter . '</span>';
		$p = $p + 1;
}




echo'</ul>';
echo'<ul class="y-axis"><li>100%</li><li>75%</li><li>50%</li><li>25%</li><li>0%</li></ul>
<p class="centered">Číslo počítače</p>';
	?>
	</div>
  </fieldset>
</div>