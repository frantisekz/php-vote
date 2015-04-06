<?php
if (!isset($_SESSION["voting_code"]))
{
	echo '<div class="alert alert-danger" role="alert">
	<strong>Do hlasování se už nelze vrátit!</strong>
	</div>';
}
else
{
?>
<div class="clear"></div>
<div class="body">
	<h2>Děkujeme za váš hlas</h2>
	<br/>
	Poté, co Vás vyučující vyzve k ukončení hlasování pokračujte <a href="index.php?page=graph&voting_result=<?php echo $_SESSION["voting_code"]; ?>"><strong>zde</strong></a>.<br/>
	<div class="alert alert-info" role="alert">
	Jestliže budete chtít graf zobrazit později, tak si zapište kód Vašeho hlasování, Váš osobní kód pro toto hlasování a využijte příslušnou možnost v horní nabídce.<br/>
	<strong>Váš kód:</strong> <?php echo $_SESSION["voting_user"]; ?><br/>
	<strong>Kód hlasování:</strong> <?php echo $_SESSION["voting_code"]; ?><br/>
	</div>
</div>
<?php
}
if (function_exists('clear_session'))
{
	clear_session();
}
?>
