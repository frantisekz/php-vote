<div class="clear"></div>
<div class="body">
<h2>Vítejte!</h2>
<p>
Pro vstup do hlasovací místnosti zadejte prosím kód, který Vám sdělil Váš vyučující:
</p>
<div class="mezera"></div>
<div class="vstoupit-div">
<form method="POST" action="index.php?page=voting">
<?php

// Ensure SESSION is clear before entering voting, otherwise bad things may happen
clear_session();
if (!isset($_COOKIE["computer_id"]))
{
  echo '<strong>Identifikační číslo počítače není nastaveno, kontaktujte správce a nebo jej vyplňte ručně!</strong>
  <br>
  <input class="kod" type="text" name="voting_user" size="20" placeholder="Číslo PC">';
}
?>
	    <input class="kod" type="text" name="voting_code" size="20" placeholder="Kód k hlasování" autocomplete="off">
<div class="mezera"></div>
    <input class="vstoupit" type="submit" value="Vstoupit do hlasování" name="JPW">
</form>
	</div>
	<div class="mezera"></div>
        </div>
	<div style="height: 30px;"></div>
<img src="img/logo_GK.png" alt="logo" id="logo">
