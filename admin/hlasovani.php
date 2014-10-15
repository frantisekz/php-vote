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
	<tr>
		<td>Example 1</td>
		<td>14:23   24.3.2014</td>
		<td>abcd1234</td>
		<td><img src="../img/edit.png" class="icons"></td>
		<td><img src="../img/result.png" class="icons"></td>
		<td><img src="../img/erase.png" class="icons"></td>
	</tr>
<tr>
	<td>Example 2</td>
	<td>20:05   24.3.2014</td>
	<td>5467fasd</td>
	<td><img src="../img/edit.png" class="icons"></td>
	<td><img src="../img/result.png" class="icons"></td>
	<td><img src="../img/erase.png" class="icons"></td>
</tr>
</table>
<div style="height:10px;">
	
	</div>
    <input id="new_poll" type="submit" value="Vytvořit nové hlasování" name="JPW">	


<h2>Vytvořit hlasování</h2>
<form method="POST">
	<input class="kod" type="textfield" name="voting_name" size="20" placeholder="Název hlasování">
	<input class="kod" type="textfield" name="possibility_1" size="20" placeholder="Možnost 1">
	<input class="kod" type="textfield" name="possibility_2" size="20" placeholder="Možnost 2">
	<input class="kod" type="textfield" name="possibility_3" size="20" placeholder="Možnost 3">
	<input class="kod" type="textfield" name="possibility_4" size="20" placeholder="Možnost 4">
	<div class="mezera"></div>
    <input class="vstoupit" type="submit" value="Vytvořit účet" name="JPW">
</form>
