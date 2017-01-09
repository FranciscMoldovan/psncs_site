<?php
// Connect to the SQL server
$connection = mysqli_connect("localhost", "root", "root");
// Select the database
$db = mysqli_select_db($connection, "psncs_login");
// Start the session
session_start();
// Store the session
$user_check=$_SESSION['login_user'];
// SQL Query to fetch complete user info
$ses_sql=mysqli_query($connection, "select role, username from login where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
$user_role = $row['role'];
if(!isset($login_session))
{
	mysqli_close($connection); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>
