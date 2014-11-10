<?php

function register($username, $password, $email, $level)
{
	// We specify BCRYPT directly to avoid potential 
	// incompatibilities in the future
	$password = password_hash($password, PASSWORD_BCRYPT);
	$write = $password . "+++" . $email . "+++" . $level . "+++" . time();
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

class voting
{
	public $username;
	public $possibilities;
	public $in_admin;

function __construct($username, $in_admin)
{
	$this->username = $username;
	$this->in_admin = $in_admin;
}

function view_votings()
{
	if ($this->username == "admin")
	{
		$votings = array_diff(scandir("../voting/"), array('..', '.', '.htaccess'));
	}
	else
	{
		$votings = array_diff(scandir("../voting/"), array('..', '.', '.htaccess'));
		// TODO
		// Check $username for each voting and 
		// show only votings to their owners
	}
	return $votings;
}
  
function voting_exists($code)
{
	$dirname = "voting/" . $code;
	if(file_exists($dirname))
	{
		return 1;
	}
	else 
	{
		return 0;
	}
}
function view_voting($code)
{
	// Single voting
	$dirname = "voting/" . $code;
	$more = $this->get_more($code);
	// Voting name = $more[0]
	// TODO
	// Overkill here, write function which 
	// would return only data that we need
	return $more[0];

}

function get_possibilities($id)
{
	if ($this->in_admin == 1)
	{
		$dir = "../voting/" . $id . "/";
	}
	else
	{
		$dir = "voting/" . $id . "/";
	}
	$votings = array_diff(scandir($dir), array('..', '.', 'info.txt'));
	return $votings;
}

function get_more($id)
{
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $id . "/info.txt";
	}
	else
	{
		$filename = "voting/" . $id . "/info.txt";
	}
	$file = fopen($filename, "r");
	$file_data = explode("+++", fgets($file));
	fclose($file);
	return $file_data;
}

function create_voting($name, $possibilities)
{
	$dirname = "../voting/" . date("y") . rand(1000, 9999);
	while (file_exists($dirname))
	{
		$dirname = "../voting/" . date("y") . rand(1000, 9999);
	}
	mkdir($dirname);
	$file_name = "../voting/" . $dirname . "/info.txt";
	$file = fopen($file_name, "w+");
	$write = $name . "+++" . $this->username . "+++" . time();
	fwrite($file, $write);
	fclose($file);
	foreach ($possibilities as $possibility)
	{
		$to_touch = $dirname . "/" . $i;
		$file_pos = fopen($to_touch, "w+");
		fwrite($file_pos, $possibility);
		fclose($file_pos);
	}
}

function delete_voting($id)
{
	$dir = "../voting/" . $id;
	foreach(glob($dir . '/*') as $file) 
	{
		if(is_dir($file))
		{
			rmdir($file);
		}
		else
		{
			unlink($file);
		}
	}
	rmdir($dir);
}
}

class user
{
	public $username;
	private $password;
	public $email;
	public $level;
	public static $in_admin;
	private $user_data;

function __construct($username, $in_admin)
{
	$this->username = $username;
	$this->in_admin = $in_admin;
}

function logged_in()
{
	if ((isset($this->username)) AND ($this->username != "guest"))
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