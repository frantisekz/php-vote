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
	$user = fopen($username_file, "r");
	$user_data = fgets($user);
	$user_password = explode("+++", $user_data);
	fclose($user);
	if (password_verify($password, $user_password[0]))
  	{
    	// OK
    	$_SESSION["username_login"] = $username;
    	return true;
  	}
 	else
  	{
    	// Wrong password
    	return false;
  	}
}
?>