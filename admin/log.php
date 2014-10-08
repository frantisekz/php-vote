<?php
if (!isset($_SESSION['pass']))
{
	die("Unauthorized access!!!");
}
?>

<h2>Log:</h2>
<div class="msg_wrap">
<?php
$file = file("log.txt");
$file = array_reverse($file);
foreach ($file as $line)
{
	$element=explode("+++",$line);
	echo $element[0] . "<br/>" . date("j.m.Y - H:i:s", $element[1]) . "<hr>";
}
?>