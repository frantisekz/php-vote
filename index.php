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
  $user_data = fgets($user);
  $user_password = explode("+++", $user_data);
  fclose($user);
  $post_password = $_POST['password_login'];
  if (password_verify($post_password, $user_password[0]))
  {
    // OK
    echo "<script>alert(\"Login OK!\");</script>";
    $_SESSION["username_login"] = $_POST["username_login"];
    setcookie($_SESSION["username_login"], $_SESSION["username_login"], time()+3600, $pms_domain);
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
<div class="clear">
<div class="body">
<h2>Vítejte!</h2>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac convallis ipsum. Integer non imperdiet tellus. 
Sed ut felis a augue iaculis volutpat nec non purus. Pellentesque quis erat libero. Nullam a orci et tortor placerat varius. Aenean consectetur diam urna, ut scelerisque magna interdum vel. 
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
