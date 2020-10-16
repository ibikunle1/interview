<?php
session_start();
require('connect.php');
$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$query = mysqli_query($con,"select * from user where email='$email' and password='$password'");
if(mysqli_num_rows($query)>0){
	$logged_in_user = mysqli_fetch_array($query);                         
	if($logged_in_user['role'] == 'admin'){
	$_SESSION['userid'] = $email;
	$_SESSION['id'] = session_id();		
	$_SESSION['login_type'] = "admin";
	echo '<script>alert("Login Success.");window.location.assign("admin/index.php");</script>';
	}else{
		$_SESSION['userid'] = $email;
		$_SESSION['id'] = session_id();
		$_SESSION['login_type'] = "user";	
		echo '<script>alert("Login Success.");window.location.assign("home.php");</script>';
	}
}
else{
	echo '<script>alert("Email id or password is wrong.");window.location.assign("index.php");</script>';
}

?>