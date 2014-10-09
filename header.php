<body>
	<title>Hlasovací systém</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="img/ico" href="img/favicon.ico">
<style type="text/css">
  </style>	
	<header>
	
	<h1><a href="index.php">Hlasovací<strong>systém</strong></a></h1>

<fieldset class="prihlasovani" style="">
<?php

if (isset($_SESSION["username_login"]))
{

	?>
<form action="./admin" class="logged" style="margin-left:150px">
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
 <input class="okno" type="text" name="username_login" size="20" placeholder="Jméno">
   <input class="okno" type="password" name="password_login" size="20" placeholder="Heslo">  
<input class="tlacitko" type="submit"value="Přihlásit se" />
		</form>	
		<?php
}
		?>
	</fieldset>
<ul>
   <li <?php if ($actual == "index"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" onclick="location.href = 'index.php';">
	   	<img src="img/index.png" style="height:17px;width:17px" href="index.php">
	<a  class="odkaz1" href="index.php">Domů</a>
	</li>
   <li <?php if ($actual == "navod"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" onclick="location.href = 'navod.php';">
		   	<img src="img/navod.png" style="height:17px;width:17px">
	<a class="odkaz1" href="index.php?stranka=navod">Návod</a>
	</li>   
	<li <?php if ($actual == "vysledky"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" onclick="location.href = 'vysledky.php';">
		   	<img src="img/vysledky.png" style="height:17px;width:17px" href="vysledky.php">
	<a class="odkaz1" href="index.php?stranka=vysledky">Výsledky</a>
   </li>
</ul>
		</div>
	<div class="clear"></div>
	</header>