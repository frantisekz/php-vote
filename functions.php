<?php
// TODO
// Add support for themes
$theme = "default";
date_default_timezone_set('Europe/Prague');

function random_color($array)
{
	$array[] = 1;
    $indexColor = round( 255 / sizeof( $array ) );
    $iterator = 1;

    $arrayOfRGB = array();

    foreach( $array as $item)
    {   
        $arrayOfRGB[] = "rgb(" . round(( $indexColor * $iterator * 0.25 )) . "," . round(( $indexColor * $iterator * 0.5 )) . ", " . round(( $indexColor * $iterator )) . " )";
        $iterator++;
    }  

    return $arrayOfRGB;
}

function jquery($line)
{
	// Includes jQuery js file
	if ($line == 1)
	{
		echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		';
	}
	if ($line == 2)
	{
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		';
	}
}

function bootstrap($line)
{
	if ($line == 1){
	echo '<link rel="stylesheet" href="themes/default/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	';
}
	if ($line == 2)
	{
	echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		';
	}
}

function register($username, $password, $email, $level, $in_admin)
{
	if ((!is_safe($username)) OR (!is_safe($password)) OR (!is_safe($email)) OR (!is_numeric($level)))
	{
		return false;
	}
	// We specify BCRYPT directly to avoid potential
	// incompatibilities in the future
	$password = password_hash($password, PASSWORD_BCRYPT);
	$write = $password . "+++" . $email . "+++" . $level . "+++" . time();
	if ($in_admin == 0)
	{
		$file_name = "users/" . $username . ".txt";
	}
	else
	{
		// Will be called from inside admin folder, so ../
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

function is_safe($input)
{
	$i = 0;
	$p = 0;
	$arr = str_split($input);
	if (($arr[0] == "+") OR ($arr[sizeof($arr) - 1] == "+"))
	{
		return false;
	}
	foreach ($arr as $char)
	{
		if ($char == "+")
		{
			$p = $p + 1;
		}
		elseif (!($p >= 3))
		{
			$p = 0;
		}
		if ($p >= 3)
		{
			break;
		}
	}
	if ($p >= 3)
		{
			return false;
		}
	else
		{
			return true;
		}
}

function set_cookie($value)
{
	if (!is_numeric($value))
	{
		return false;
	}
	if (setcookie("computer_id", $value, 2147483647, "/"))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function unset_cookie()
{
	if (setcookie("computer_id", "", time()-3600, "/"))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function clear_session()
{
	if (isset($_SESSION["voting_code"]))
	{
		unset($_SESSION["voting_code"]);
	}
	if (isset($_SESSION["voting_user"]))
	{
		unset($_SESSION["voting_user"]);
	}
	if (isset($_SESSION["question"]))
	{
		unset($_SESSION["question"]);
	}
	if (isset($_SESSION["decrease"]))
	{
		unset($_SESSION["decrease"]);
	}
	if (isset($_SESSION["user_passed"]))
	{
		unset($_SESSION["user_passed"]);
	}
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

function get_result($id, $question, $possibility)
{
	if ((!is_numeric($id)) OR (!is_numeric($question)) OR (!is_numeric($possibility)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $id . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $id . "/" . $question;
	}
	if (file_exists($file_name))
	{
		$file_contents = file($file_name);
	}
	else
	{
		return false;
	}
	$explode = explode("+++", $file_contents[$possibility]);
	$voters = array_diff($explode, array($explode[0]));
	return $voters;
}

function view_votings($username, $all)
{
	if ((!is_safe($username)) OR (!is_numeric($all)))
	{
		return false;
	}
	if (($username == "admin") AND ($all == 1))
	{
		if ($this->in_admin == 1)
		{
			$votings = array_diff(scandir("../voting/"), array('..', '.', '.htaccess'));
		}
		else
		{
			$votings = array_diff(scandir("voting/"), array('..', '.', '.htaccess'));
		}
	}
	else
	{
		if ($this->in_admin == 1)
		{
			$votings_dir = array_diff(scandir("../voting/"), array('..', '.', '.htaccess'));
		}
		else
		{
			$votings_dir = array_diff(scandir("voting/"), array('..', '.', '.htaccess'));
		}
		foreach ($votings_dir as $voting)
		{
			$more = $this->get_more($voting);
			if ($more[1] == $username)
			{
				$votings[] = $voting;
			}
		}
	}
	if (isset($votings))
	{
		return $votings;
	}
	else
	{
		return false;
	}
}

function voting_exists($code)
{
	if (!is_numeric($code))
	{
		return false;
	}
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
	if (!is_numeric($code))
	{
		return false;
	}
	// Single voting
	$dirname = "voting/" . $code;
	$more = $this->get_more($code);
	// Voting name = $more[0]
	return $more[0];
}

function get_possibilities($id, $question)
{
	if ((!is_numeric($id)) OR (!is_numeric($question)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $id . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $id . "/" . $question;
	}
	if (file_exists($file_name))
	{
		$file_contents = file($file_name);
	}
	else
	{
		return false;
	}
	$votings = array();
	foreach ($file_contents as $line)
	{
		$explode = explode("+++", $line);
		$votings[] = $explode[0];
	}
	$votings = array_diff($votings, array($votings[0]));
	return $votings;
}

function get_questions($id)
{
	if (!is_numeric($id))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$dirname = "../voting/" . $id . "/";
	}
	else
	{
		$dirname = "voting/" . $id . "/";
	}
	$questions = array_diff(scandir($dirname), array(".", "..", "info.txt"));
	return $questions;
}

function get_more($id)
{
	if (!is_numeric($id))
	{
		return false;
	}
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

function question_exists($voting, $question)
{
	if ((!is_numeric($voting)) OR (!is_numeric($question)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $voting . "/" . $question;
	}
	if (file_exists($filename))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function question_header($voting, $question)
{
	if ((!is_numeric($voting)) OR (!is_numeric($question)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $voting . "/" . $question;
	}
	if (file_exists($filename))
	{
		$file = fopen($filename, "r");
	}
	else
	{
		return false;
	}
	$file_data = explode("+++", fgets($file));
	fclose($file);
	return $file_data[0];
}

function question_right($voting, $question)
{
	if ((!is_numeric($voting)) OR (!is_numeric($question)))
	{
		return false;
	}
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
	return $file_data[1];
}

function answered_right($voting, $question, $voter)
{
	if ((!is_numeric($voting)) OR (!is_numeric($question)) OR (!is_numeric($voter)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $voting . "/" . $question;
	}
	$file_contents = file($filename);
	$i = 0;
	foreach ($file_contents as $line)
	{
		if ($i != 0)
		{
			$explode = explode("+++", $line);
			if ((in_array($voter, $explode)) AND ($this->question_right($voting, $question) == $i))
			{
				return true;
			}
		}
		$i = $i + 1;
	}
	return false;
}

function answered($voting, $question, $voter)
{
	if ((!is_numeric($voting)) OR (!is_numeric($question)) OR (!is_numeric($voter)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $voting . "/" . $question;
	}
	$file_contents = file($filename);
	$i = 0;
	foreach ($file_contents as $line)
	{
		if ($i != 0)
		{
			$explode = explode("+++", $line);
			if (in_array($voter, $explode))
			{
				return true;
			}
		}
		$i = $i + 1;
	}
	return false;
}

function count_answered_right($voting, $voter)
{
	if ((!is_numeric($voting)) OR (!is_numeric($voter)))
	{
		return false;
	}
	$questions = $this->get_questions($voting);
	$right = 0;
	foreach ($questions as $question)
	{
		if ($this->answered_right($voting, $question, $voter))
		{
			$right = $right + 1;
		}
	}
	return $right;
}

function count_answered($voting, $voter)
{
	if ((!is_numeric($voting)) OR (!is_numeric($voter)))
	{
		return false;
	}
	$questions = $this->get_questions($voting);
	$answered = 0;
	foreach ($questions as $question)
	{
		if ($this->answered($voting, $question, $voter))
		{
			$answered = $answered + 1;
		}
	}
	return $answered;
}

function voters($voting)
{
	if (!is_numeric($voting))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $voting . "/1";
	}
	else
	{
		$filename = "voting/" . $voting . "/1";
	}
	$file_contents = file($filename);
	$ln = 0;
	foreach ($file_contents as $line)
	{
		if ($ln != 0)
		{
			$explode = explode("+++", $line);
			$i = 0;
			foreach ($explode as $exploded)
			{
				if ($i == 0)
				{
					// Skip first
				}
				else
				{
					settype($exploded, "integer");
					$voters[] = $exploded;
				}
				$i = $i + 1;
			}
		}
		$ln = $ln + 1;
	}
	if (!empty($voters))
	{
		$unique = array_unique($voters, SORT_NUMERIC);
	}
	return $unique;
}

function voting_lock($code)
{
	if (!is_numeric($code))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $code . "/info.txt";
	}
	else
	{
		$file_name = "voting/" . $code . "/info.txt";
	}
	$file_contents = file($file_name);
	$to_replace = $file_contents[0];
	$more = $this->get_more($code);
	$replacer = $more[0] . "+++" . $more[1] . "+++" . $more[2] . "+++0";
	$file = str_replace($to_replace, $replacer, $file_contents);
	$file[0] = str_replace("\n", "", $file[0]);
	$file[0] = $file[0] . "\n";
	if(file_put_contents($file_name, $file))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function voting_unlock($code)
{
	if (!is_numeric($code))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $code . "/info.txt";
	}
	else
	{
		$file_name = "voting/" . $code . "/info.txt";
	}	
	$file_contents = file($file_name);
	$to_replace = $file_contents[0];
	$more = $this->get_more($code);
	$replacer = $more[0] . "+++" . $more[1] . "+++" . $more[2] . "+++1";
	$file = str_replace($to_replace, $replacer, $file_contents);
	$file[0] = str_replace("\n", "", $file[0]);
	$file[0] = $file[0] . "\n";
	if(file_put_contents($file_name, $file))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function possibility_count($code, $question)
{
	if ((!is_numeric($code)) AND (!is_numeric($question)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$filename = "../voting/" . $code . "/" . $question;
	}
	else
	{
		$filename = "voting/" . $code . "/" . $question;
	}	
	$file = file($filename);
	return sizeof($file);
}

function create_voting($name)
{
	if(!is_safe($name))
	{
		return false;
	}
	$rand = date("y") . rand(1000, 9999);
	if ($this->in_admin == 1)
	{
		$dirname = "../voting/" . $rand;
	}
	else
	{
		$dirname = "voting/" . $rand;
	}
	while (file_exists($dirname))
	{
		$rand = rand(1000, 9999);
		if ($this->in_admin == 1)
		{
			$dirname = "../voting/" . date("y") . $rand;
		}
		else
		{
			$dirname = "voting/" . date("y") . $rand;
		}
	}
	mkdir($dirname);
	if ($this->in_admin == 1)
	{
		$file_name = $dirname . "/info.txt";
	}
	else
	{
		$file_name = $dirname . "/info.txt";
	}
	$file = fopen($file_name, "w+");
	$write = $name . "+++" . $this->username . "+++" . time() . "+++1";
	fwrite($file, $write);
	fclose($file);
	return $rand;
}

function add_question($code, $header, $possibilities, $possibility_right)
{
	if ((!is_numeric($code)) OR ((!is_safe($header))) OR (!is_numeric($possibility_right)))
	{
		foreach ($possibilities as $possibility)
		{
			if (!is_safe($possibility))
			{
				return false;
			}
		}
		return false;
	}
	if ($this->in_admin == 1)
	{
		$path = "../voting/" . $code . "/";
	}
	else
	{
		$path = "voting/" . $code . "/";
	}
	$i = 1;
	$filename = $path . $i;
	while (file_exists($filename))
	{
		$filename = $path . $i;
		$i = $i + 1;
	}
	$file = fopen($filename, "w+");
	fwrite($file, $header . "+++" . $possibility_right . "\n");
	$i = 1;
	foreach ($possibilities as $possibility)
	{
		if ($possibility[0] != "")
		{
			$write = $possibility . "\n";
			$bad = 0;
			if(fwrite($file, $write)) {}
			else
			{
				$bad = 1;
			}
		}
	}
	fclose($file);
	if ($bad != 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function duplicate_voting($code)
{
	if(!is_numeric($code))
	{
		return false;
	}
	$rand = date("y") . rand(1000, 9999);
	if ($this->in_admin == 1)
	{
		$source = "../voting/" . $code;
		$target = "../voting/" . $rand;
	}
	else
	{
		$source = "voting/" . $code;
		$target = "voting/" . $rand;
	}
	while (file_exists($target))
	{
		$rand = rand(1000, 9999);
		if ($this->in_admin == 1)
		{
			$target = "../voting/" . date("y") . $rand;
		}
		else
		{
			$target = "voting/" . date("y") . $rand;
		}
	}
	mkdir($target);
    $dir = opendir($source); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($source . '/' . $file) ) { 
                recurse_copy($source . '/' . $file,$target . '/' . $file); 
            } 
            else { 
                copy($source . '/' . $file,$target . '/' . $file); 
            } 
        } 
    } 
    closedir($dir);
    // Duplicating done, clean up votings
    $questions = array_diff(scandir($target), array('..', '.', '.htaccess'));
    foreach ($questions as $question)
    {
    	$file = $target . "/" . $question;
    	$file_contents = file($file);
    	$content[] = $file_contents[0];
    	$possibilities = $this->get_possibilities($code, $question);
    	foreach ($possibilities as $possibility)
    	{
    		$content[] = $possibility . "\n";
    	}
    	unlink($file);
    	$content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content);
	    file_put_contents($file, $content);
	    unset($content);
    }
    $info = $target . "/info.txt";
    $file = file($info);
    $explode = explode("+++", $file[0]);
    $to_replace = $explode[2];
	$replacer = time();
	$file = str_replace($to_replace, $replacer, $file);
	if(file_put_contents($info, $file))
	{
		return true;
	}
	else
	{
		return false;
	}

}


function add_possibility($code, $question, $possibility)
{
	if((!is_numeric($code)) OR (!is_numeric($question)) OR (!is_safe($possibility)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$path = "../voting/" . $code . "/";
	}
	else
	{
		$path = "voting/" . $code . "/";
	}
	$filename = $path . $question;
	$file = fopen($filename, "a");
	$write = $possibility . "\n";
	fwrite($file, $write);
}

function question_edit($code, $question, $new_title)
{
	if ((!is_numeric($code)) OR (!is_numeric($question)) OR (!is_safe($new_title)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $code . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $code . "/" . $question;
	}
	$file_contents = file($file_name);
	$to_replace = $file_contents[0];
	$replacer = $new_title;
	$file = str_replace($to_replace, $replacer, $file_contents);
	$file[0] = str_replace("\n", "", $file[0]);
	$file[0] = $file[0] . "\n";
	if(file_put_contents($file_name, $file))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function possibility_right($code, $question, $possibility)
{
	if ((!is_numeric($code)) OR (!is_numeric($question)) OR (!is_numeric($possibility)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $code . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $code . "/" . $question;
	}

	$file_contents = file($file_name);
	$exploded = explode("+++", $file_contents[0]);
	$first = str_replace($exploded[1], $possibility . "\n", $file_contents[0]);
	$to_write = str_replace($file_contents[0], $first, $file_contents);
	unlink($file_name);
	if(file_put_contents($file_name, $to_write))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function possibility_edit($code, $question, $possibility, $new_title)
{
	if ((!is_numeric($code)) OR (!is_numeric($question)) OR (!is_numeric($possibility)) OR (!is_safe($new_title)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$file_name = "../voting/" . $code . "/" . $question;
	}
	else
	{
		$file_name = "voting/" . $code . "/" . $question;
	}

	$file_contents = file($file_name);
	$exploded = explode("+++", $file_contents[$possibility]);
	if (isset($exploded[1]))
	{
		$file = str_replace($exploded[0], $new_title, $file_contents[$possibility]);
	}
	else
	{
		$file = str_replace($exploded[0], $new_title . "\n", $file_contents[$possibility]);
	}
	$file_final = str_replace($file_contents[$possibility], $file, $file_contents);
	if(file_put_contents($file_name, $file_final))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function remove_question($voting_id, $question_id)
{
	if ((!is_numeric($voting_id)) OR (!is_numeric($question_id)))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$write = "../voting/" . $voting_id . "/" . $question_id;
	}
	else
	{
		$write = "voting/" . $voting_id . "/" . $question_id;
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

function remove_possibility($voting_id, $question, $possibility_id)
{
	if ((!is_numeric($voting_id)) OR (!is_numeric($question)) OR (!is_numeric($possibility_id)))
	{
		return false;
	}
	$file_name = "../voting/" . $voting_id . "/" . $question;
	if (file_exists($file_name))
	{
		$file_contents = file($file_name);
		$file_contents = str_replace($file_contents[$possibility_id], '', $file_contents);
		file_put_contents($file_name, $file_contents);
	}
}

function question_count($code)
{
	if (!is_numeric($code))
	{
		return false;
	}
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
	if (!is_numeric($id))
	{
		return false;
	}
	if ($this->in_admin == 1)
	{
		$dir = "../voting/" . $id;
	}
	else
	{
		$dir = "voting/" . $id;
	}
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
	if (rmdir($dir))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function write_vote($user, $code, $question, $possibility)
{
	if ((!is_numeric($user)) OR (!is_numeric($code)) OR (!is_numeric($question)) OR (!is_numeric($possibility)) OR ($possibility <= 0))
	{
		return false;
	}
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
	public $in_admin;
	public $user_data;

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
function view_users()
{
	if ($this->username == "admin")
	{
		$users = array_diff(scandir("../users/"), array('..', '.', '.htaccess'));
	}
	else
	{
		$users = array_diff(scandir("../users/"), array('..', '.', '.htaccess'));
	}
	return $users;
}

function load_file($username)
{
	if (!is_safe($username))
	{
		return false;
	}
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
	return $user_data;
}

function get_cur_username()
{
	return $this->username;
}

function get_password($username)
{
	if (is_safe($username))
	{
		$this->load_file($username);
		return $this->user_data[0];
	}
}

function get_email($username)
{
	if (is_safe($username))
	{
		$this->load_file($username);
		return $this->user_data[1];
	}
}

function get_level($username)
{
	if (is_safe($username))
	{
		$this->load_file($username);
		return $this->user_data[2];
	}
}

function edit_user($old_name, $new_name)
{
   rename ("../users/" . $old_name . ".txt" ,"../users/" . $new_name . ".txt");
}

function re_email($username, $new_email)
{
	if ((!is_safe($username)) OR (!is_safe($new_email)))
	{
		return false;
	}
	$file_name = "../users/" . $username . ".txt";
	if (!file_exists($file_name))
	{
		return false;
	}
	$file_contents = file($file_name);
	$to_replace = $this->get_email($username);
	$file = str_replace($to_replace, $new_email, $file_contents);
	file_put_contents($file_name, $file);
}

function re_password($username, $new_password)
{
	if ((!is_safe($username)) OR (!is_safe($new_password)))
	{
		return false;
	}
	$file_name = "../users/" . $username . ".txt";
	if (!file_exists($file_name))
	{
		return false;
	}
	$file_contents = file($file_name);
	$to_replace = $this->get_password($username);
	$new_password = password_hash($new_password, PASSWORD_BCRYPT);
	$file = str_replace($to_replace, $new_password, $file_contents);
	file_put_contents($file_name, $file);
}

function delete_user($username)
{
	if (!is_safe($username))
	{
		return false;
	}
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
	if ((!is_safe($username)) OR (!is_safe($username)))
	{
		return false;
	}
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

function logout()
{
	unset($_SESSION["user_username"]);
	unset($_POST["username_logout"]);
	unset($_POST["welcome"]);
}
}
?>