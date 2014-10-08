<html>
<?php
session_start();

if (phpversion() < 5.5)
{
	require_once ('../passwordLib.php');
}

include('../functions.php');

if (isset($_POST['username_login']))
{
  login($_POST['username_login'],$_POST['password_login'],1);
}

if (!isset($_GET['sub']))
{
	$_GET['sub'] = "uvod";
}

if (isset($_POST['username_logout']))
{
	logout(1);
}
?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href="favicon.gif" />
<title>php-vote - Administrace</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" href="styles.css"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<?php
if (!isset($_SESSION["username_login"]))
{
 	?>
<form method="post">
 <input class="okno" type="text" name="username_login" size="20" placeholder="Jméno">
   <input class="okno" type="password" name="password_login" size="20" placeholder="Heslo">  
<input class="tlacitko" type="submit"value="Přihlásit se" />
		</form>	
		<?php
		die("Neautorizovaný přístup!");
}
?>
<body>
<div class="left_menu">
<form method="post">
<input style="margin-top:30px;" class="tlacitko" name="username_logout" type="submit" value="Odhlásit se" />
</form>

<br/>
<hr>
<h3<?php if ($_GET['sub'] == "uvod") echo " id=\"active\" "?>><a href="index.php">Úvod</a></h3>
<h3<?php if ($_GET['sub'] == "hlasovani") echo " id=\"active\" "?>><a href="index.php?sub=hlasovani">Hlasování</a></h3>
<h3<?php if ($_SESSION['user_level'] == 3) {if ($_GET['sub'] == "nastaveni") echo " id=\"active\" "?>><a href="index.php?sub=nastaveni">Nastavení</a><?php } ?></h3>
</div>

<div class="admin">
<?php 
switch ($_GET['sub']){
	case "hlasovani":
		include('hlasovani.php');
		break;
	case "nastaveni":
		include('nastaveni.php');
		break;
	default:
		include('uvod.php');
}

?>
</div>
<!--<div class="bottom_panel"></div>-->
</div>
</body>
</html>