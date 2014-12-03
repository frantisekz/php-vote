<?php
if(!isset($_POST["voting_code"]))
{
	// Somebody tried to load file directly, die in pain!
	die();
}

$more = $voting->get_more($_SESSION["voting_code"]);
$question = $_GET["question"];
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

if(time() > $more[3])
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=timeout">';
	// Header won't work here, 
	die(); // And this is ugly, AJAX should be better in this case
}

if ((isset($_SESSION["voting_code"])) AND ($voting->voting_exists($_SESSION["voting_code"]) != 1))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=password">';
	// Header won't work here, 
	die(); // And this is ugly, AJAX should be better in this case
}

// Check if somebody voted
if(isset($_GET["vote"]))
{
	$voting->write_vote($_SESSION["voting_user"], $_SESSION["voting_code"], $question, $_GET["vote"]);
}

else
{
	$header = $voting->view_voting($_SESSION["voting_code"]);
	echo "<h2>" . $header . "</h2>";
	$i = 1;
	foreach ($voting->get_possibilities($_SESSION["voting_code"], $question) as $pos)
	{
		echo '
		<a href="index.php?stranka=hlasovani&question=1&vote=' . $i . '"><div value="' . $pos . '" id="Poll_1">
	<span>' . $pos . '</span>
	</div></a>';
		$i = $i + 1;
	}
}
?>