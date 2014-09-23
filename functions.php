<?php
function register($username, $password, $email)
{
	$password = password_hash($password, PASSWORD_DEFAULT)."\n";
	$write = $password . "#" . $email . "#1";
	$file_name = "data/" . $username . ".txt";
	$file = fopen($file_name, "w");
	fwrite($file, $write);
	fclose($file);
	return true;
}
?>