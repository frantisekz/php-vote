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
	$user_file = "users/" . $username . ".txt";
	$user = fopen($user_file, "r");
	$user_data = fgets($user);
	$user_password = explode("+++", $user_data);
	fclose($user);
	if (password_verify($password, $user_password[0]))
  	{
    	// OK
    	$_SESSION["username_login"] = $username;
    	$_SESSION["user_level"] = $user_password[2];
    	return true;
  	}
 	else
  	{
    	// Wrong password
    	return false;
  	}
}

function logout()
{
	unset($_SESSION["username_login"]);
	unset($_SESSION["user_level"]);
	unset($_POST["username_logout"]);
}
?>