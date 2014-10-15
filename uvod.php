<div class="clear">
<div class="body">
<h2>Vítejte!</h2>
<p>
Pro vstup do hlasovací místnosti zadejte prosím kód, který Vám sdělil Váš vyučující:
</p>
<div class="mezera"></div>
<div class="vstoupit-div">
<form method="POST" action="hlasovani.php">
	<input class="kod" type="password" name="kod-hlasovani" size="20" placeholder="Kód k hlasování">
	<div class="mezera"></div>
    <input class="vstoupit" type="submit" value="Vstoupit do hlasování" name="JPW">
</form>
<?php

if (isset($_SESSION["user_username"]))
{
	?>
<a href="./admin"><button class="vstoupit">Správa</button></a>

<?php

}

?>
<!--<script>
window.open("hlasovani.php", "_blank", "width=400,height=500")
</script>-->
	</div>	
	<div class="mezera"></div>
        </div>
	<div style="height: 30px;"></div>
<img src="img/logo_GK.png" id="logo">