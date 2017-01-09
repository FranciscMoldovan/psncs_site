<?php
// Start the new session
session_start(); 
// Variable for error
$error=''; 
// Check for the submit
if (isset($_POST['submit'])) 
{	
	// Check textfields for contents
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{	// Failure of check
		$error = "Username or Password is invalid";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// perform a connection to the SQL server
		$connection = mysqli_connect("localhost", "root", "root") or die;
		// Un-qoute quoted string
		$username = stripslashes($username);
		$password = stripslashes($password);
		// Get rid of special characters
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);
		// Select the database
		$db = mysqli_select_db($connection, "psncs_login");
		// SQL query to look for user to be logged in
		$query = mysqli_query($connection, "select * from login where password='$password' AND username='$username'");
		
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			log_data($username);
			// Initialise session
			$_SESSION['login_user']=$username;
			// Redirect to the user page
			header("location: profile.php");
		}
	else 
	{
		$error = "Username or Password is invalid";
	}
		mysqli_close($connection); // Closing Connection
	}
}

?>
