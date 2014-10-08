<?php
if (!isset($_SESSION['pass']))
{
	die("Unauthorized access!!!");
}

function pms_delete_page($page)
{
	$un = "../pages/" . $page . ".php";
	if(unlink($un))
	{
		$file = fopen("log.txt", "a");
		$write = "<strong>N:</strong>Deleted page " . $page . "+++" . time() . "\n";
		fwrite($file, $write);
		unset($file);
		return true;
	}
	else
	{
		return false;
	}
	unset($un);
}

function pms_new_page($page)
{
	$new = "../pages/" . $page;
	if (file_exists($new))
	{
		echo "<strong>Page exists already!</strong><br/>";
	}
	else
	{
		if(touch($new));
		{
			$file = fopen("log.txt", "a");
			$write = "<strong>N:</strong>Created page " . $new . "+++" . time() . "\n";
			fwrite($file, $write);
			unset($file);
			return true;
		}
		else
		{
			return false;
		}
	}
	unset($new);
}
?>

<h2>Pages:</h2>
<?php
if (isset($_POST['pname']))
{
	$page = $_POST['pname'] . ".php";
	$handle = fopen($page, 'w'); 
}
foreach(pms_get_pages() as $value) 
{
	$value = str_replace(".php", "", $value);
	$value[0] = strtoupper($value[0]);
	echo "<a href=\"index.php?sub=pages&pgdel=" . $value . "\"><span class=\"glyphicon glyphicon glyphicon-remove\"></span></a>" . $value . "<br/>";
}
?>