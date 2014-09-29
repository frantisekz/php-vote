<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
  </style>	
	<header>
	
	<h1><a href="index.php">Hlasovací<strong>systém</strong></a></h1>

<fieldset class="prihlasovani" style="">
<form method="post">
 <input class="okno" type="text" name="jmeno" size="20" placeholder="Jméno">
   <input class="okno" type="password" name="heslo" size="20" placeholder="Heslo">  
<input class="tlacitko" type="submit"value="Přihlásit se" />
		</form>	
	</fieldset>
<ul>

   <li <?php if ($actual == "index"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy">
	   	<img src="img/index.png" style="height:20px;width:20px" href="index.php">
	<a  class="odkaz1" href="index.php">Domů</a>
	</li>

   <li <?php if ($actual == "navod"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy">
		   	<img src="img/navod.png" style="height:20px;width:20px">
	<a class="odkaz1" href="navod.php">Návod</a>
	</li>   
	<li <?php if ($actual == "vysledky"){?>id="aktivni" <?php } else { ?> id="neaktivni" <?php } ?> class="odkazy">
		   	<img src="img/vysledky.png" style="height:20px;width:20px" href="vysledky.php">
	<a class="odkaz1" href="vysledky.php">Výsledky</a>
   </li>
</ul>
	<div class="clear"></div>
	</header>
