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

// Set SESSION to count questions
if (!isset($_SESSION["question"]))
{
	$_SESSION["question"] = 1;
}

// Set SESSION variable to hold username
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

// Set SESSION variable to hold voting code
if (!isset($_SESSION["voting_code"]))
{
	$_SESSION["voting_code"] = $_POST["voting_code"];
}

// Load voting info file, just in case something gonna need this
$more = $voting->get_more($_SESSION["voting_code"]);

// Check if somebody actually voted
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

// Whoops, bad code
if ((isset($_SESSION["voting_code"])) AND ($voting->voting_exists($_SESSION["voting_code"]) != 1))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=password">';
	die();
}

// Whoops, too late
if ($more[3] == 0)
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=timeout">';
	die();
}

// Check just for the first question and only once in one SESSION if user voted already
if ($voting->answered($_SESSION["voting_code"], 1, $_SESSION["voting_user"]) != true)
{
	// So, user didn't voted here yet, let him go
	$_SESSION["user_passed"] = 1;
}
if($voting->answered($_SESSION["voting_code"], 1, $_SESSION["voting_user"]) == true)
{
	if (!isset($_SESSION["user_passed"]))
	{
		// User voted already here, kick him out
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=voted">';
	}
}

$header = $voting->view_voting($_SESSION["voting_code"]);
if (!isset($_SESSION["decrease"]))
{
	$_SESSION["decrease"] = 0;
}
// Check if question exists so we don't need to renumber questions
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
?>