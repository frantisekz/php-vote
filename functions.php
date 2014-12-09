<?php
function register($username, $password, $email, $level)
{
	// We specify BCRYPT directly to avoid potential 
	// incompatibilities in the future
	$password = password_hash($password, PASSWORD_BCRYPT);
	$write = $password . "+++" . $email . "+++" . $level . "+++" . time();
	// Will be called from inside admin folder, so ../
	if ($username == "test")
	{
		$file_name = "users/" . $username . ".txt";
	}
	else
	{
		$file_name = "../users/" . $username . ".txt";
	}
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

function clear_session()
{
	unset($_SESSION["voting_code"]);
	unset($_SESSION["voting_user"]);
	unset($_SESSION["question"]);
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
		foreach ($votings as $voting)
		{
			if ($this->get_more($voting) == $user->get_cur_username())
			{
				$votings[] = $voting;
			}
		}
	}
	return $votings;
}
  
function voting_exists($code)
{
	$dirname = "voting/" . $code;
	if(file_exists($dirname))
	{
		return true;
	}
	else 
	{
		return false;
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

function get_possibilities($id, $question)
{
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $id . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $id . "/" . $question;
	}
	$file_contents = file($file_name);
	$explode = explode("+++", $file_contents[0]);
	$votings = array_diff($explode, array($explode[0]));
	return $votings;
}

function get_questions($id)
{
	if ($this->in_admin == 1)
	{
		$dirname = "../voting/" . $id . "/";
	}
	else
	{
		$dirname = "voting/" . $id . "/";
	}
	$questions = scandir($dirname);
	return $questions;
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

function question_header($voting, $question)
{
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $voting . "/" . $question;
	}
	$file = fopen($filename, "r");
	$file_data = explode("+++", fgets($file));
	fclose($file);
	return $file_data[0];
}

function create_voting($name)
{
	$dirname = "../voting/" . date("y") . rand(1000, 9999);
	while (file_exists($dirname))
	{
		$dirname = "../voting/" . date("y") . rand(1000, 9999);
	}
	mkdir($dirname);
	$file_name = "../voting/" . $dirname . "/info.txt";
	$file = fopen($file_name, "w+");
	$write = $name . "+++" . $this->username . "+++" . time() . "+++1";
	fwrite($file, $write);
	fclose($file);
}

function add_question($code, $header, $possibilities)
{
	$path = "../voting/" . $code . "/";
	$i = 1;
	$filename = $path . $i;
	while (file_exists($filename))
	{
		$filename = $path . $i;
		$i = $i + 1;
	}
	$file = fopen($filename, "w+");
	fwrite($file, $header);
	$i = 1;
	foreach ($possibilities as $possibility)
	{
		$write = "+++" . $possibility[0];
		fwrite($file, $write);
		$i = $i + 1;
	}
	$write = "\n";
	fwrite($file, $write);
	foreach ($possibilities as $possibility)
	{
		$write = $possibility[0] . "\n";
		fwrite($file, $write);
	}
	fclose($file);
}

function question_count($code)
{
	if ($this->in_admin == 1)
	{
		$path = "../voting/" . $code . "/";
	}
	else
	{
		$path = "voting/" . $code . "/";
	}
	$contents = scandir($path);
	$contents = array_diff($contents, array('info.txt', '.', '..'));
	return sizeof($contents);
}

function delete_voting($id)
{
	$dir = "../voting/" . $id;
	foreach(glob($dir . "/*") as $file) 
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

function write_vote($user, $code, $question, $possibility)
{
	$file_name = "voting/" . $code . "/" . $question;
	if (file_exists($file_name))
	{
		$file_contents = file($file_name);
		$to_replace = $file_contents[$possibility];
		$replacer = $file_contents[$possibility] . "+++" . $user . "\n";
		$file = str_replace($to_replace, $replacer, $file_contents);
		$file[$possibility] = str_replace("\n", "", $file[$possibility]);
		$file[$possibility] = $file[$possibility] . "\n";
		file_put_contents($file_name, $file);
	}
}
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

function delete_user($username)
{
	if ($this->in_admin == 1)
	{
		$write = "../users/" . $username . ".txt";
	}
	else
	{
		$write = "users/" . $username . ".txt";
	}
	if(unlink($write))
	{
		return true;
	}
	else
	{
  		return false;
	}
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