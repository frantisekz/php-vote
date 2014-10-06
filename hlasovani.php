<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" lang="cs" />
<meta name="author" content="" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/jquery.textfill.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>

<header>

	<h1><a href="index.php">Hlasovací<strong>systém</strong></a></h1>
	<h4>Uživatel 1234<h4>


	<div class="clear"></div>
	</header>

<body>
<div class="body">
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