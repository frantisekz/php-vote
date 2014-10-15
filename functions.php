<?php

function register($username, $password, $email, $level)
{
	// We specify BCRYPT directly to avoid potential 
	// incompatibilities in the future
	$password = password_hash($password, PASSWORD_BCRYPT);
	$write = $password . "+++" . $email . "+++" . $level;
	// Will be called from inside admin folder, so ../
	$file_name = "../users/" . $username . ".txt";
	$file = fopen($file_name, "w");
	if (fwrite($file, $write))
	{
		return true;
	}
	else
	{
		return false;
	}
	fclose($file);
}

class user
{
	public $username;
	private $password;
	public $email;
	public $level;
	public $in_admin;
	private $user_data;

function __construct($username, $in_admin)
{
	$this->username = $username;
	$this->in_admin = $in_admin;
}

function logged_in()
{
	if (isset($this->username))
	{
		return true;
	}
	else
	{
		return false;
	}
}

private function load_file($username)
{
	if ($this->in_admin == 1)
	{
		$filename = "../users/" . $username . ".txt";
	}
	else
	{
		$filename = "users/" . $username . ".txt";
	}
	$user_file = fopen($filename, "r");
	$user_data = explode("+++", fgets($user_file));
	fclose($user_file);
	$this->user_data = $user_data;
}

function get_cur_username()
{
	return $this->username;
}

private function get_password($username)
{
	$this->load_file($username);
	return $user_data[0];
}

function get_email($username)
{
	$this->load_file($username);
	return $user_data[1];
}

function get_level($username)
{
	$this->load_file($username);
	return $this->user_data[2];
}

function login($username, $password)
{
	$this->load_file($username);
	if (password_verify($password, $this->user_data[0]))
  	{
    	// OK
    	$_SESSION["user_username"] = $username;
    	return true;
  	}
 	else
  	{
    	// Wrong password
    	return false;
  	}
}

function logout($in_admin)
{
	unset($_SESSION["user_username"]);
	unset($_POST["username_logout"]);

	if ($in_admin == 1)
	{
		header("Location: ../index.php");
	}
	else
	{
		header("Location: index.php");
	}
}
}
?>