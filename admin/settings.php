<?php
if (!isset($_SESSION['pass']))
{
	die("Unauthorized access!!!");
}
?>

<h2>Settings:</h2>
<table>
<?php
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Page author: " . $pms_pageauthor . "</td></tr>";
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Page title: " . $pms_pagetitle . "</td></tr>";
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Page domain: " . $pms_domain . "</td></tr>";
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Google+ url is set to: "; if($pms_google_plus == "0"){echo "Disabled<br/>";} else {echo "<a href=\"" . $pms_google_plus . "\">" . $pms_google_plus . "</a></td></tr>";}
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Facebook url is set to: "; if($pms_facebook == "0"){echo "Disabled<br/>";} else {echo "<a href=\"" . $pms_facebook . "\">" . $pms_facebook . "</a></td></tr>";}
echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
<td>Twitter url is set to: "; if($pms_twitter == "0"){echo "Disabled</td></tr>";} else {echo "<a href=\"" . $pms_twitter . "\">" . $pms_twitter . "</a></td></tr>";}
if ($pms_robots == 1)
{
		echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
	<td>Robots are allowed to access this page!</td></tr>";
} 
else
{
	echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td><td>Robots are not allowed to access this page!</td></tr>";
}
if ($pms_debug_enabled == 1)
	{
		echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td>
	<td>Debug mode is on!</td></tr>";
} 
else
	{
		echo "<tr><td><td><span class=\"glyphicon gglyphicon glyphicon-cog\"></span></td><td>Debug mode is off!</td></tr>";
	}
echo "</table>";
?>