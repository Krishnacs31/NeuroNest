<?php
session_start();
include('../connection.php');

if (isset($_POST['submit']))
{	
$username=$_POST['user']; 
$password=$_POST['password']; 

	if($_POST['type']=='admin')
	{
		if($username=='admin@gmail.com' && $password=='admin')
		{
			$_SESSION['user']='admin';
			$_SESSION['name']='admin';
			header("location:../dashboard/admin.php");
		}
		else{
			
			 header("location:login.php?st=fail");
			//echo "<script>alert('Incorrect Credentials'); window.location='index.php'</script>";
		}
	}
	
	elseif($_POST['type']=='parent')
	{
		$sel="SELECT * FROM parent WHERE email='$username' and password='$password'";
		echo $sel;
		$result = mysqli_query($con,$sel) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		
		if($rows>0)
		{	  
			$_SESSION['user']='parent';
			$_SESSION['uid']=$row['id'];
			$_SESSION['name']=$row['name'];
			header("location:../dashboard/dashboard.php");
			
		}
		else{
			
			 header("location:login.php?st=fail");
			//echo "<script>alert('Incorrect Credentials'); window.location='index.php'</script>";
		}
	}
	elseif($_POST['type']=='trainer')
	{
		$sel="SELECT * FROM trainer WHERE email='$username' and password='$password' and status='accepted'";
		echo $sel;
		$result = mysqli_query($con,$sel) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		
		if($rows>0)
		{	  
			$_SESSION['user']='trainer';
			$_SESSION['uid']=$row['id'];
			$_SESSION['name']=$row['name'];
			header("location:../dashboard/trainer.php");
			
		}
		else{
			
			 header("location:login.php?st=fail");
			//echo "<script>alert('Incorrect Credentials'); window.location='index.php'</script>";
			
			
			
		}
	}
}
	
?>
 
 



