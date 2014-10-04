<?php
function register($username, $password, $email)
{
	$password = password_hash($password, PASSWORD_DEFAULT);
	$write = $password . "#" . $email . "#1";
	$file_name = "users/" . $username . ".txt";
	$file = fopen($file_name, "w");
	fwrite($file, $write);
	fclose($file);
	return true;
}

function login($username, $password)
{
	$username = "users/" . $_POST["username_login"] . ".txt";
	$user = fopen($username, "r");
	$user_data = fgets($user);
	$user_password = explode("+++", $user_data);
	fclose($user);
	if (password_verify($_POST['password_login'], $user_password[0]))
  	{
    	// OK
    	$_SESSION["username_login"] = $_POST["username_login"];
    	return true;
  	}
 	else
  	{
    	// Wrong password
    	return false;
  	}
}
?>