<?php
include('session.php');
include('profile_users.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Your Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="profile">
		<b id="welcome">Welcome : <i><?php echo $login_session; ?></i>
			<br/>[ROLE=<i><?php if ($user_role=='admin') echo 'ADMIN';
								else if ($user_role=='user') echo 'USER'?></i>]
		</b>
		<b id="logout"><a href="logout.php">Log Out</a></b>
		</div>
		<div>
		<h2>Insert comments:</h2>
			</br>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<textarea rows="4" cols="80" name="comment">
				</textarea>
				<input type = "submit" value = "Add Comment!"/>
			</form>
		</div>
		<div>
			</br>
			<h2>All comments:</h2>
			<?php foreach ($comments_array as $a_comment):?>
				<li><?php echo $a_comment; ?></li>
			<?php endforeach; ?>
		</div>
		<div>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<input type="text" name="ping">
				</input>
				<input type = "submit" value = "PING!"/>
			</form>
		<div>
		<div>
			<?php echo $out_ping; ?>
		</div>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<input type="text" name="open">
				</input>
				<input type = "submit" value = "OPEN!"/>
			</form>
			<div>
				<?php echo $out_open_file; ?>
		</div>
	</body>
</html>








