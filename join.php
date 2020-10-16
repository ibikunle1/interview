<?php
include('connect.php');

session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='user'){	
	$userid = $_SESSION['userid'];
}
else{
	echo '<script>alert("Access denied");window.location.assign("index.php");</script>';
}
	$select = "SELECT * FROM user";
	$all = mysqli_query($con, $select);

$select = "SELECT * FROM user where email = '$userid' ";
$query = mysqli_query($con, $select);
$get = mysqli_fetch_array($query);
$status = $get['status'];

?>
<?php
//User cliced on join
if(isset($_POST['submit'])){	
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$mobile = mysqli_real_escape_string($con,$_POST['mobile']);
	$address = mysqli_real_escape_string($con,$_POST['address']);		
	$password = $mobile;
	
	$flag = 0;
	
	if($name!='' && $email!='' && $mobile!='' && $address!=''){
		//User filled all the fields.
		if(email_check($email)){
					//Insert into User profile
		$query = mysqli_query($con,"insert into user(`name`,`email`,`password`,`mobile`, `role`, `status`, `address`) values('$name','$email','$password','$mobile', 'user', 'pending', '$address')");
		echo '<script>alert("New user Created");window.location.assign("home.php");</script>';
		}
		else{
			//check email
			echo '<script>alert("This user id already availble.");</script>';
		}
	}
	else{
		//check all fields are fill
		echo '<script>alert("Please fill all the fields.");</script>';
	}
	
}
?><!--/join user-->
<?php 
//functions
function email_check($email){
	global $con;
	
	$query =mysqli_query($con,"select * from user where email='$email'");
	if(mysqli_num_rows($query)>0){
		return false;
	}
	else{
		return true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skyware Test - Join </title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- plugin CSS -->
    <link href="vendor/plugin/plugin.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet">

    <!-- Fonts Awesome -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>                
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-message">						
						<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
						</li>
						<li>
							<a href="join.php"><i class="fa fa-adjust fa-fw"></i>Join User</a>
						</li>
						<?php
                        if($status == 'active'){
                            echo 
                        "<li>
                            <a href='tree.php'><i class='fa fa-adjust fa-hub'></i>Tree</a>
                        </li>";
                        }
                        ?>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
        <!-- //Navigation -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Join</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-md-offset-4 col-lg-4">
                    	<form method="post">
							<div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>                                                    
                            <div class="form-group">
                        	<input type="submit" name="submit" class="btn btn-primary" value="Join">
                        	</div>
                        </form>
                    </div>
                </div><!--/.row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- //page-wrapper -->

    </div>
    <!-- //wrapper -->

	<!-- jQuery -->
	<script src="vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Js -->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Plugin Js -->
	<script src="vendor/plugin/plugin.min.js"></script>

	<!-- Custom Js -->
	<script src="dist/js/style.js"></script>>

</body>

</html>
