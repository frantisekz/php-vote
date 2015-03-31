<?php
error_reporting(3);
if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}

// Work around missing functions in old php
if (phpversion() < 5.5)
{
	require_once ("passwordLib.php");
}

include("functions.php");

if (isset($_POST["username_login"]))
{
	$user = new user($_SESSION["user_username"], 0);
	if($user->login($_POST["username_login"], $_POST["password_login"]))
	{
		header("Location: admin/index.php");
	}
else
	{
	?>
	<script>
	alert("Chybné heslo!");
	</script>
	<?php
}
	$voting = new voting($_SESSION["user_username"], 0);
}
elseif (isset($_SESSION["user_username"]))
{
	$user = new user($_SESSION["user_username"], 0);
	$voting = new voting($_SESSION["user_username"], 0);
}
else
{
	$user = new user("guest", 0);
	$voting = new voting("guest", 0);
}

if (isset($_POST["username_logout"]))
{
	$user->logout();
}
elseif (isset($_GET["page"]))
{
	$actual = $_GET["page"];
}
else
{
	$actual = "index";
}

include("themes/" . $theme . "/template/header.php");

if (isset($_GET["page"]))
{
	if (ctype_alpha($_GET["page"]))
	{
		$inc = $_GET["page"] . ".php";
		include($inc);
	}
}
else
{
	include("home.php");
}

include("themes/" . $theme . "/template/footer.php");
?>
</div>
