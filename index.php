<?php
$actual = "index";
include('header.php');
?>
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
<?php
include('footer.php');
?>