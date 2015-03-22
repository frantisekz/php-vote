<script src="js/jquery.textfill.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<?php
bootstrap(1);
echo '<div class="voting">';
if ((!isset($_POST["voting_code"])) AND (!isset($_SESSION["voting_code"])))
{
	// Somebody tried to load file directly, die in pain!
	die();
}
if (!isset($_SESSION["question"]))
{
	$_SESSION["question"] = 1;
}
if (!isset($_SESSION["voting_user"]))
{
	if ((isset($_COOKIE["computer_id"])) AND (is_numeric($_COOKIE["computer_id"])))
	{
		$_SESSION["voting_user"] = $_COOKIE["computer_id"];
	}
	elseif (isset($_POST["voting_user"]))
	{
		$_SESSION["voting_user"] = $_POST["voting_user"];
	}
}
if (!isset($_SESSION["voting_code"]))
{
	$_SESSION["voting_code"] = $_POST["voting_code"];
}
$more = $voting->get_more($_SESSION["voting_code"]);
// Check if somebody voted
if (isset($_GET["vote"]))
{
	$voting->write_vote($_SESSION["voting_user"], $_SESSION["voting_code"], $_SESSION["question"] , $_GET["vote"]);
	if ($_SESSION["question"] == $voting->question_count($_SESSION["voting_code"]))
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=finish">';
		die();
	}
	$_SESSION["question"] = $_SESSION["question"] + 1;
}
if ((isset($_SESSION["voting_code"])) AND ($voting->voting_exists($_SESSION["voting_code"]) != 1))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=password">';
	die();
}
if ($more[3] == 0)
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=timeout">';
	die();
}
$header = $voting->view_voting($_SESSION["voting_code"]);
if (!isset($_SESSION["decrease"]))
{
	$_SESSION["decrease"] = 0;
}
// Check if question exists
while (!$voting->question_exists($_SESSION["voting_code"], $_SESSION["question"]))
{
	$_SESSION["question"] = $_SESSION["question"] + 1;
	$_SESSION["decrease"] = $_SESSION["decrease"] + 1;
}
echo "	<div class='mezera'></div>";
echo "<h10>" . $header . " - " . $voting->question_header($_SESSION["voting_code"], $_SESSION["question"]) . "</h10>";
echo "<p>" . ($_SESSION["question"] - $_SESSION["decrease"]) . "/" . $voting->question_count($_SESSION["voting_code"]) . "</p>";
echo "<br>";
$i = 1;
	echo '<div class="hlasovani">';
	foreach ($voting->get_possibilities($_SESSION["voting_code"], $_SESSION["question"]) as $pos)
	{
		echo '
		<a href="index.php?page=voting&vote=' . $i . '"><div value="' . $pos . '" id="Poll_'.$i.'">
	<span>' . $pos . '</span>
	</div></a>';
	$i=$i+1;
	}
echo '</div>';
echo '</div>';
echo '<div style="text-align:center">';
echo '    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
      Zobrazit graf
    </button>';
echo '</div>';
echo '<div>
<!-- Modal -->
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:900px;">
      <div class="modal-content" style="width:900px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Průběžný graf správných odpovědí</h4>
        </div>
        <div class="modal-body">
          <div id="result">';
            $count = 0;
            $p = 0;
            $voters = $voting->voters($_SESSION["voting_code"]);
           echo '<h1>Graf počtu správných hlasů</h1>
            <fieldset class="graph">';
                	$p = 0;
	foreach ($voters as $voter)
                {
					$count = $voting->count_answered_right($_SESSION["voting_code"], $voter);
					$right = $right + $count;
					$palette[] = random_color();
                }
	echo  '
<div class="bargraph" style= "width: 700px;">';
echo'<ul class="bars">';
                $p = 0;
                foreach ($voters as $voter)
                {
					$count = $voting->count_answered($_SESSION["voting_code"], $voter);
                	$right = $voting->count_answered_right($_SESSION["voting_code"], $voter);
       				if ($count != 0)
					{
						$percent = ($right * 100) / $count;
					}
					else
					{
						$percent = 0;
					}
echo '<li class="bar'.$p.'" style="height: ' . round(($percent * 2)) . 'px;background-color:' . $palette[$p] . '">' . $percent . '%</li>';
		$p = $p + 1;	
}
echo'</ul>';



echo'<ul class="label" style="left:-10px">';
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
';
echo '</div>';
?>