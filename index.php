<body>
<?php
error_reporting(3);
// Work around missing function in old php
if (phpversion() < 5.5)
{
  require_once ('passwordLib.php');
}
$actual = "index";

if (isset($_POST["username_login"]))
{
  $username = "users/" . $_POST["username_login"] . ".txt";
  $user = fopen($username, "r");
  $i = 1;
  while($row = fgets($user)) 
  {
    if ($i == 1)
    $user_password = $row;
    $i++;
  }
  fclose($user);
  if (password_verify($_POST["password_login"], $user_password))
  {
    // OK
    echo "<script>alert(\"Login OK!\");</script>";
    $_SESSION["username_login"] = $_POST["username_login"];
    setcookie($_SESSION["username_login"], $_SESSION["username_login"], time()+3600, $pms_domain);
    header("Location:index.php");
  }
  else
  {
    // Wrong password
    echo "<script>alert(\"Login Failed!\");</script>";
  }
}

if (isset($_POST["username_logout"]))
{
  setcookie($_SESSION["username_login"], "", time()-3600);
  unset($_SESSION["username_login"]);
  unset($_POST["username_logout"]);
  header("Location:index.php");
}

include('header.php');
?>

<div class="body">
<h2>Vítejte!</h2>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nibh risus, viverra vel rhoncus ut, posuere sed arcu. 
Etiam quis mattis mi. Ut sodales dui ac aliquet egestas. 
</p>
<div class="mezera"></div>
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
	<div class="mezera"></div>
        </div>
	<div style="height: 30px;"></div>
<img src="img/logo_GK.png" id="logo">
<?php
include('footer.php');
?>
</body>
