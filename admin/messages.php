<?php
if (!isset($_SESSION['pass']))
{
	die("Unauthorized access!!!");
}
?>

<h2>Messages:</h2>
<div class="msg_wrap">
<?php
$file = file("msg.txt");
$i = 0;
foreach ($file as $line) 
{
	$element=explode("+++",$line); 
	echo "<table>
	<tr>
	<td><span class=\"glyphicon glyphicon-arrow-left\"></span></td><td>
	E-mail: </td><td>" . wordwrap($element[0], 80, " ",1) . "</td></tr>
	<tr><td>
	<a href=\"#\" onclick=\"msgdelconf(" . $i . ")\" data-target=\"#msgdel\" data-toggle=\"modal\"><span class=\"glyphicon glyphicon-trash\"></span></td></a>";
	echo "<td>Message: </td><td>" . wordwrap($element[1], 80, " ",1);
	echo "</td></tr></table>" . date("j.m.Y - H:i:s", $element[2]) . "<hr>";
	$i++;
}
unset($i);
?>
</div>