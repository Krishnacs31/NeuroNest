<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google" content="notranslate">
    <title>Neuronest </title>
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
    <div class="container">
        <div class="left-section">
            <img src="logo.png" style="width:25%; border-radius:10px; margin-bottom:10px;">
			<h1>NeuroNest</h1>
            <p>Nurturing young minds with personalized learning</p>
        </div>
        <div class="right-section">
            <h2>Sign Up To Continue</h2>
            <form method="post">
                <label for="username">Name</label>
                <input type="text" name="name" id="username" placeholder="Enter Name" required>
				
				<label for="username">Email</label>
                <input type="text" name="email"  id="username" placeholder="Enter Email" required>
				
				<label for="username">Phone</label>
                <input type="text" name="phone" pattern="[0-9]{10}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required  id="username" placeholder="Enter Phone">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>

                <button type="submit" name="submit">Sign In</button>

                <center>
					<p class="signup">Already have an account? <a href="login.php">Sign In</a></p><br>
					<p><a href="tregister.php">Trainer registration</a></p>
				</center>
            </form>
        </div>
    </div>
</body>
</html>



<?php
include('../connection.php');
if(isset($_POST['submit'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$phone=$_POST['phone'];

	$sql5="INSERT INTO parent(`name`,`email`, `phone`,`password`) 
	VALUES ('$name','$email','$phone','$password')";
	$res = mysqli_query($con, $sql5);

	if($res) {
	echo '<script>alert("Successfully Registered!")
	  window.location="login.php";
	  </script>';
	} else {

	echo "<script>alert('Failed to register. Please enter correct details.'); window.location='index.php'</script>";
	}
}
?>