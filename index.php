<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
  </style>	
<body>
	<header>
<div class="hlavicka">	
	<h1><a href="uvod.php">Hlasovací<strong>systém</strong></a></h1>

<fieldset class="prihlasovani" style="">
<form method=\"post\">
 <input class="okno" type="text" name="jmeno" size="20" placeholder=Jméno>
   <input class="okno" type="password" name="heslo" size="20" placeholder=Heslo>  
<input class="tlacitko" type="submit"value="Přihlásit" />
		</form>	
	</fieldset>
<div class="odkaz">

<a style="border-bottom: 7px solid whitesmoke;color:whitesmoke" class="odkazy" href="uvod.php">Domů</a>
<a style="border-bottom: 0" class="odkazy" href="navod.php">Návod</a>
<a style="border-bottom: 0" class="odkazy" href="vysledky.php">Výsledky</a>
<a style="border-bottom: 0" class="odkazy" href="info.php">Info</a>
	</div>
</div>
	<div class="clear"></div>
	</header>
<div class="body">
	<h2>Vítejte!</h2>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nibh risus, viverra vel rhoncus ut, posuere sed arcu. 
Etiam quis mattis mi. Ut sodales dui ac aliquet egestas. 
</p>
<div class="vstoupit-div">
<input class="kod" type="password" name="kod-hlasovani" size="20" placeholder="Kód k hlasování">
	<div class="mezera"></div>
<form method="POST" action="hlasovani.php">
    <input class="vstoupit" type="submit" value="Vstoupit do hlasování" name="JPW">
</form>
<!--<script>
window.open("hlasovani.php", "_blank", "width=400,height=500")
</script>-->
	</div>
	</div>
<footer>
<div class="konec">
	<b>Gymnázium Karviná 2014</b>
	</div>
	</footer>
	</body>
</html>