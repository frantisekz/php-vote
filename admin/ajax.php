<?php
// AJAX Functions
if (isset($_REQUEST['id_helper']))
{
	$_SESSION['id'] = $_REQUEST['id_helper'];	
}
if (isset($_REQUEST['page_helper']))
{
	$_SESSION['page'] = $_REQUEST['page_helper'];	
}

// Messages
if (isset($_GET['delete_msg']))
{
	$file = file("msg.txt");
	$i = 0;
	foreach ($file as $line) 
	{
		$element=explode("+++",$line); 
		$msgs[$i] = $element[0] . "+++" . $element[1] . "+++" . $element[2];
		$i++;
	}
	$file = str_replace($msgs[$_SESSION['id']], "", $file);
	file_put_contents("msg.txt", $file);
	unset($file);
	$file = fopen("log.txt", "a");
	$write = "<strong>N:</strong>Deleted message " . $msgs[$_SESSION['id']] . "+++" . time() . "\n";
	fwrite($fp, $write);
	unset($file);
	unset($_SESSION['id']);
}
// Config
?>