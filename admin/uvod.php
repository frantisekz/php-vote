<h1>Vítejte v administraci systému php-vote!</h1>
<a href="../"><strong>Přejít na web</strong></a>

<h1>Správa hlasování</h1>

<table id="list">
<tr>
	<th class="long">Jméno</th>
	<th class="long">Datum vytvoření</th>
	<th class="long">Identifikační kód</th>
	<th class="short">Editace</th>
	<th class="short">Výsledky</th>
	<th class="short">Odstranit</th>
</tr>

<?php 
foreach ($voting->view_votings() as $b)
	{
		$more = $voting->get_more($b);
		echo "
		<tr>
		<td>" . $more[0] . "</td>
		<td>" . $today = date("d.m.Y H:i:s", $more[2]) . "</td>
		<td>" . $b . "</td>
		<td><a href=\"index.php?voting_edit=" . $b . "\"><img src=\"../img/edit.png\" class=\"icons\"></a></td>
		<td><a href=\"index.php?voting_result=" . $b . "\"><img src=\"../img/result.png\" class=\"icons\"></a></td>
		<td><a href=\"index.php?voting_remove=" . $b . "\"><img src=\"../img/erase.png\" class=\"icons\"></a></td>
	</tr>";
	} 
?>
</table>
<div style="height:10px;">
	
</div>

<h2>Vytvořit hlasování</h2>
<form method="POST">
	<input class="kod" type="textfield" name="voting_name" size="20" placeholder="Název hlasování">
	<div class="mezera"></div>
	<input class="kod" type="textfield" name="possibility_1" size="20" placeholder="Možnost 1">
	<input class="kod" type="textfield" name="possibility_2" size="20" placeholder="Možnost 2">
	<input class="kod" type="textfield" name="possibility_3" size="20" placeholder="Možnost 3">
	<input class="kod" type="textfield" name="possibility_4" size="20" placeholder="Možnost 4">
	<script type="text/javascript"> 
  var counter=1;
  function pridejInput() { 
    document.getElementById('odpovedi').innerHTML += "<input type='text' name='blabla"+counter+"' /><br>";
    document.getElementById('pocet').value=counter++;
  } 
</script> 
<?
if(isset($_POST['poslal'])){
  echo $_POST['pocet']."<br>";
  for($i=1; $i<=$_POST['pocet']; $i++){
    echo "-> ".$_POST['blabla'.$i]."<br>";
  } 
}
?>
<form action="" method="post"> 
  <div id="odpovedi">
  <input type="hidden" id="pocet" name="pocet" value="0">
  </div> 
  <a href="" onClick="pridejInput();return false;">Pridat odpoved</a> <br>
  <input type="submit" value="Posli" name="poslal">
</form> 
	<div class="mezera"></div>
	<input id="new_poll" type="submit" value="Vytvořit nové hlasování" name="JPW">
</form>