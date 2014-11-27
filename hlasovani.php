<?php
if(!isset($_POST["voting_code"]))
{
	// Somebody tried to load file directly, die in pain!
	die();
}

$more = $voting->get_more($_POST["voting_code"]);

if(time() > $more[3])
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=kod">';
	// Header won't work here, 
	die(); // And this is ugly, AJAX should be better in this case
}

if ((isset($_POST["voting_code"])) AND ($voting->voting_exists($_POST["voting_code"]) != 1))
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=kod">';
	// Header won't work here, 
	die(); // And this is ugly, AJAX should be better in this case
}

// Check if somebody voted
if(isset($_GET["vote"]))
{
	$voting->write_vote($_POST["voting_user"], $_POST["voting_code"], $_GET["vote"]);

}

else
{
	$header = $voting->view_voting($_POST["voting_code"]);
	echo "<h2>" . $header . "</h2>";
	$i = 1;
	foreach ($voting->get_possibilities($_POST["voting_code"]) as $pos)
	{
		echo "
		<a href=\"index.php?stranka=hlasovani&vote=" . $pos . "\"><div value=\"" . $pos . "\" id=\"Poll_1\">
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in ipsum sed massa varius volutpat. Nam gravida, velit at iaculis vestibulum, diam lectus scelerisque mauris.</span>
	</div></a>
		";
	}
}
?>