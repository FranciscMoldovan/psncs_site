<?php
include ("cfg.php");
$comments_array[]="";
$res = mysqli_query($connection, "SELECT ID_COMMENT, COMMENT FROM comments");
$regex_ping = "/([-\w=+$\|\_.!~\|'()\[\]]+[\w#](\(\))?$)(?=$|[\s',\|\(\).:?\-\[\]>\)])/i";
$err_message_ping="";
$err_message_comment ="";
$err_message_openfile = "";
$PING_CMD = "ping";
$out_ping = "";
$out_open_file = "";
while ($row = mysqli_fetch_array($res, MYSQL_NUM))
{
	$comments_array[] = $row[1];
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST['comment']))
	{
		// Get the contents of the comment
		$comment_contents = mysqli_real_escape_string($connection, $_POST['comment']);
		
		$sql_query = "INSERT INTO comments(COMMENT, USER) VALUES ('$comment_contents', '$login_session')";
		log_data($comment_contents);
		log_data($login_session);
		log_data($connection);
		if (mysqli_query($connection, $sql_query))
		{
			$comments_array[] = $comment_contents;
		}
		else
		{
			$err_message_comment = "Error while trying to add comment";
		}
	}
	if (isset($_POST['ping'])) 
	{
		// Split
		$ping = explode(" ",$_POST['ping']);	
		// Check
		if(isset($ping[0]) && isset($ping[1])) 
		{
			log_data($ping[0]);
			log_data($ping[1]);
		}
		if (isset($ping[0]) && isset($ping[1]) && $PING_CMD == $ping[0] && preg_match($regex_ping, $ping[1]))
		{
			$out_ping = shell_exec($_POST['ping']);
			log_data($out_ping);
		} else 
		{
			$err_message_ping = "Can't execute this command";
		}	
	}
	if (isset($_POST['open'])) 
	{
			$a_file = $_POST['open'];
			if (file_exists($_POST['open'])) 
			{
				$out_open_file = htmlentities(file_get_contents($a_file));
				log_data($out_open_file);
		
				if ($out_open_file == NULL) 
				{
					$err_message_openfile = "File provided not found!";
				}
			} 
			else 
			{
				$err_message_openfile = "Can't open this file!";			
			}
		}
}



function log_data($data) {
   		
		echo '<script>';
		echo 'console.log('. json_encode($data) . ')';
		echo '</script>';
   }
?>
