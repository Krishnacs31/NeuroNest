<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google" content="notranslate">
    <title>NeuroBloom </title>
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
            <h2>Trainer Registration</h2>
            <form method="post" enctype="multipart/form-data" class="tform">
				<div class="form-group">
					<input type="text" name="name" placeholder="Enter Name" required>
					<input type="email" name="email" placeholder="Enter Email" required>
				</div>

				<div class="form-group">
					<input type="text" name="phone" pattern="[0-9]{10}" title="Enter a 10-digit phone number" required placeholder="Enter Phone">
					<input type="password" name="password" placeholder="Enter Password" required>
				</div>

				<div class="form-group">
					<input type="text" name="specialization" placeholder="Enter Specialization" required>
					<input type="number" name="experience_years" min="0" placeholder="Experience (Years)" required>
				</div>

				<div class="form-group">
					<input type="file" name="photo" accept="image/*" required>
					<input type="number" name="amount" min="0" placeholder="Fee Amount" required>
				</div>
				
				<div class="form-group">
					<input type="file" name="doc"  required>
				</div>

				<button type="submit" name="submit">Register as Trainer</button>

				<center><p class="signup">Already have an account? <a href="login.php">Sign In</a></p></center>
			</form>
        </div>
    </div>
</body>
</html>



<?php
include('../connection.php');

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password']; // Secure password hashing
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
    $experience_years = mysqli_real_escape_string($con, $_POST['experience_years']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $status = 'pending';

    // File Upload
    $target_dir = "../trainer/uploads/";
    $img = basename($_FILES['photo']['name']);
    $doc = basename($_FILES['doc']['name']);
    $target_path = $target_dir . $img;
    $target_path1 = $target_dir . $doc;
    
    // Check if both files were uploaded successfully
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path) && move_uploaded_file($_FILES['doc']['tmp_name'], $target_path1)) {
        
        // Insert into database
        $sql5 = "INSERT INTO trainer (name, email, password, phone, specialization, experience_years, photo, document, amount, status) 
                 VALUES ('$name', '$email', '$password', '$phone', '$specialization', '$experience_years', '$img', '$doc', '$amount', '$status')";
        
        $res = mysqli_query($con, $sql5);

        if($res) {
            echo '<script>
                alert("Successfully Registered!");
                window.location="login.php";
            </script>';
        } else {
            echo '<script>
                alert("Failed to register. Please enter correct details.");
                window.location="register.php";
            </script>';
        }
    } else {
        echo '<script>alert("Error uploading files. Please try again!");</script>';
    }
}
?>