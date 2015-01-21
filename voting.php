<?php
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

if (isset($more[3]))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=timeout">';
	die();
}

$header = $voting->view_voting($_SESSION["voting_code"]);
echo "	<div class='mezera'></div>";
echo "<h10>" . $header . " - " . $voting->question_header($_SESSION["voting_code"], $_SESSION["question"]) . "</h10>";
echo "<br>";
echo "<p>" . $_SESSION["question"] . "/" . $voting->question_count($_SESSION["voting_code"]) . "</p>";
echo "<br>";
$i = 1;
foreach ($voting->get_possibilities($_SESSION["voting_code"], $_SESSION["question"]) as $pos)
{
	echo '<div class="hlasovani">';
	echo '
	<a href="index.php?page=voting&vote=' . $i . '"><div value="' . $pos . '" id="Poll_'.$i.'">
<span>' . $pos . '</span>
</div></a>';
$i=$i+1;
 echo '</div>';
}
echo '</div>';
?>
