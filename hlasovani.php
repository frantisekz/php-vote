<?php
if (isset($_POST["voting_code"]))
{
	if ($voting->voting_exists($_POST["voting_code"]) == 1)
	{
		// OK
	}
	else
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?stranka=kod">';
		// Header won't work here, 
		die(); // And this is ugly, AJAX should be better in this case
	}
}
else
{
	// Somebody tried to load file directly, die in pain!
	die();
}

$header = $voting->view_voting($_POST["voting_code"]);
echo "<h2>" . $header . "</h2>"
?>

<h2>Zeměpis - 1</h2>
<fieldset id="Poll">
	<legend>Kolik zemí je v EU?</legend>	
	<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">

<div value="1" id="Poll_1">
<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in ipsum sed massa varius volutpat. Nam gravida, velit at iaculis vestibulum, diam lectus scelerisque mauris.</span>
</div>
		
<div value="2" id="Poll_2" >
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dignissim.</span>
</div>
<div class="mezera"></div>
			
<div value="3" id="Poll_3" >
	<span>		3</span>
</div>

<div value="4" id="Poll_4" >
	<span>		4</span>
</div>		
		
	</form>
	</fieldset>
	</div>
<div id="diskuze">
Diskuze k Zeměpis - 1
		</div>
<?php
include('footer.php');
?>
</body>