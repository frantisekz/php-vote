<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="img/ico" href="img/favicon.ico">
	<title>Hlasovací systém</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" lang="cs" />
	<meta name="author" content="" />
	<link rel="stylesheet" media="screen and (min-device-width: 801px)" type="text/css" href="themes/<?php echo $theme; ?>/css/style.css">
	<link rel="stylesheet" media="screen and (max-device-width: 800px)" type="text/css" href="themes/<?php echo $theme; ?>/css/style_mobile.css">
<?php
	jquery(1); 
	?>
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
 <input class="login_window" type="text" name="username_login" size="20" placeholder="Jméno" autocomplete="off">
   <input class="login_window" type="password" name="password_login" size="20" placeholder="Heslo">
<input class="login_button" type="submit" value="Přihlásit se" />
		</form>
		<?php
}
		?>
	</fieldset>
<ul id="buttons">
   <li <?php if ($actual == "index"){?>id="active_button" <?php } else { ?> id="neaktivni" <?php } ?>  onclick="location.href = 'index.php';">
	   	<img style="align:middle" src="img/index.png" alt="uvod">
	<a href="index.php">Domů</a>
	</li>
  
  	</li>
   <li <?php if ($actual == "results"){?>id="active_button" <?php } else { ?> id="neaktivni" <?php } ?>  onclick="location.href = 'index.php?page=results';">
		   	<img src="img/results.png" alt="vysledky">
	<a class="button" href="index.php?page=results">Výsledky</a>
	</li>
  
</ul>
	<div class="clear"></div>
	</header>
