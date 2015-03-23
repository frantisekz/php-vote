<hr/>
<h2>Nastavení čísla PC</h2>
<form method="POST">
  <input class="kod" type="text" name="computer_id" size="20" placeholder="Číslo PC">
	<div class="mezera"></div>
  <input id="pc_submit" type="submit" value="Nastavit" name="JPW">
</form>
<?php
if (isset($_COOKIE["computer_id"]))
{
  echo '<strong>Identifikační číslo počítače je nastaveno: ' . $_COOKIE["computer_id"] . '</strong><br/>
  <a href="index.php?sub=settings&unset_cookie">Vymazat číslo PC</a>';
}

else
{
  echo '<strong>Identifikační číslo počítače není nastaveno!</strong>';
}
?>
<hr/>
