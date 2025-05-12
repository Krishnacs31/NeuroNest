<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuronest </title>
	<meta name="google" content="notranslate">
    <link rel="stylesheet" href="styles.css">
	<style>
		.bg-img {
    background-image: url(cognitivebotics_login_bg.svg);
    background-repeat: no-repeat;
    background-size: cover;
		}
	</style>
</head>
<body class="bg-img">
    <div class="container ">
        <div class="left-section">
            <img src="logo.png" style="width:25%; border-radius:10px; margin-bottom:10px;">
			<h1>NeuroNest</h1>
            <p>Nurturing young minds with personalized learning</p>
        </div>
        <div class="right-section">
            <?php
			error_reporting(0);
			if($_REQUEST['st']=="fail")
			{
				echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
				<center><b>Incorrect Username or Password!<b></center>
			</div>";
			}
			?>
			
			<h2>Sign In To Continue</h2>
            <form method="post" action="log.php">
                <label for="username">Username</label>
                <input type="text"  name="user" id="username" placeholder="Enter Username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
				
				<label for="password">User Type</label>
                <select name="type" required>
					<option>-- select --</option>
					<option value="admin">Admin</option>
					<option value="parent">Parent</option>
					<option value="trainer">Trainer</option>
				</select>
                
                <div class="options">
                    <!-- <a href="#">Forgot Password?</a> -->
                </div>

                <button type="submit" name="submit">Sign In</button>

                <center><p class="signup">Don't have an account yet? <a href="register.php">Sign Up</a></p></center>
            </form>
        </div>
    </div>
</body>
</html>
