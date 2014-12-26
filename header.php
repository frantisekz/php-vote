<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="icon" type="img/ico" href="img/favicon.ico">
<title>Hlasovací systém</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/jquery.textfill.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>
<script src="js/Chart.js"></script>
</head>
<body>
	<header>
	<?php if ($user->logged_in())
	echo "<h4>" . $user->get_cur_username() . "</h4>";
	?>
	<h1><a href="index.php">Hlasovací<strong>systém</strong></a></h1>

<fieldset class="prihlasovani" style="">
<?php

if (isset($_SESSION["user_username"]))
{

	?>
<form action="./admin" class="logged" style="margin-left:40px">
<button class="tlacitko">Správa</button>
</form>
<form method="post" class="logged">
<input class="tlacitko" name="username_logout" type="submit" value="Odhlásit se" />
	</form>
<?php
}
else
{
	?>
<form method="post">
 <input class="okno" type="text" name="username_login" size="20" placeholder="Jméno" autocomplete="off">
   <input class="okno" type="password" name="password_login" size="20" placeholder="Heslo">
<input class="tlacitko" type="submit" value="Přihlásit se" />
		</form>
		<?php
}
		?>
	</fieldset>
<ul id="header">
   <li <?php if ($actual == "index"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" onclick="location.href = 'index.php';">
	   	<img src="img/index.png" style="height:17px;width:17px" alt="uvod">
	<a  class="odkaz1" href="index.php">Domů</a>
	</li>
   <li <?php if ($actual == "navod"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" onclick="location.href = 'index.php?stranka=navod';">
		   	<img src="img/navod.png" style="height:17px;width:17px" alt="navod">
	<a class="odkaz1" href="index.php?stranka=navod">Návod</a>
	</li>
</ul>
	<div class="clear"></div>
	</header>
