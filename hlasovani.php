<?php
if(!isset($_SESSION["voting_code"]))
{
	// Somebody tried to load file directly, die in pain!
	die();
}

if(!isset($_SESSION["voting_user"]))
{
	$_SESSION["voting_user"] = $_POST["voting_user"];
}
if(!isset($_SESSION["voting_code"]))
{
	$_SESSION["voting_code"] = $_POST["voting_code"];
}

//Load latest POST to session
if((isset($_POST["voting_user"])) AND ($_POST["voting_user"] != $_SESSION["voting_user"]))
{
	$_SESSION["voting_user"] = $_POST["voting_user"];
}
if((isset($_POST["voting_code"])) AND ($_POST["voting_code"] != $_SESSION["voting_code"]))
{
	$_SESSION["voting_code"] = $_POST["voting_code"];
}

$more = $voting->get_more($_SESSION["voting_code"]);
$question = $_GET["question"];

// Check if somebody voted
if(isset($_GET["vote"]))
{
	echo "Question: " . $question;
	$voting->write_vote($_SESSION["voting_user"], $_SESSION["voting_code"], $question, $_GET["vote"]);
}
$question = $_GET["question"] + 1;

if(time() > $more[3])
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=timeout">';
	die();
}

if ((isset($_SESSION["voting_code"])) AND ($voting->voting_exists($_SESSION["voting_code"]) != 1))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=password">';
	die();
}

$header = $voting->view_voting($_SESSION["voting_code"]);
echo "<h2>" . $header . " - " . $voting->question_header($_SESSION["voting_code"], $question) . "</h2>";
$i = 1;
foreach ($voting->get_possibilities($_SESSION["voting_code"], $question) as $pos)
{
	echo '
	<a href="index.php?stranka=hlasovani&question=' . $question . '&vote=' . $i . '"><div value="' . $pos . '" id="Poll_1">
<span>' . $pos . '</span>
</div></a>';
	$i = $i + 1;
}
?>