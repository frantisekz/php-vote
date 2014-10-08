<?php
if (!isset($_SESSION['pass']))
{
	die("Unauthorized access!!!");
}
?>

<h2>Welcome back ;)</h2>

<?php
$fp = fopen("count.txt", "r");
$count = fgets($fp, 200);
fclose($fp);
echo "Website visited: " . $count . " times.<br/>";
?>