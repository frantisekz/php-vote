<?php
error_reporting(3);
session_start();
include('functions.php');

// Work around missing functions in old php
if (phpversion() < 5.5)
{
	require_once ('passwordLib.php');
}

if (isset($_POST["username_login"]))
{
  
	login($_POST["username_login"], $_POST["password_login"], 0);
}

if (isset($_POST["username_logout"]))
{
	logout();
}

if (isset($_GET["stranka"]))
{
	$actual = $_GET["stranka"];
}
else
{
	$actual = "index";
}

include('header.php');

if (isset($_GET["stranka"]))
{
	$inc = $_GET["stranka"] . ".php";
	include($inc);
}
else
{
	include("uvod.php");
}

include('footer.php');
?>
</body>