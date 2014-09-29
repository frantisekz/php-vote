<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
  </style>	
	<header>
	
	<h1><a href="uvod.php">Hlasovací<strong>systém</strong></a></h1>

<fieldset class="prihlasovani" style="">
<form method="post">
 <input class="okno" type="text" name="jmeno" size="20" placeholder="Jméno">
   <input class="okno" type="password" name="heslo" size="20" placeholder="Heslo">  
<input class="tlacitko" type="submit"value="Přihlásit se" />
		</form>	
	</fieldset>
<div class="odkaz">

<a <?php if ($actual == "index"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" href="index.php">Domů</a>
<a <?php if ($actual == "navod"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" href="navod.php">Návod</a>
<a <?php if ($actual == "vysledky"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy" href="vysledky.php">Výsledky</a>
	<div class="clear"></div>
	</header>
