<?php
include('../connect.php');

session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='admin'){
	$userid = $_SESSION['userid'];
}
else{
	echo '<script>alert("Access denied");window.location.assign("../index.php");</script>';
}
	$select = "SELECT * FROM user where status = 'pending'";
    $users = mysqli_query($con, $select);

       
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skyware Test - Join </title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- plugin CSS -->
    <link href="../vendor/plugin/plugin.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">

    <!-- Fonts Awesome -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

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
						<li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
							<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>	
                        <li>
                            <a href='tree.php'><i class='fa fa-adjust fa-hub'></i>Tree</a>
                        </li>						
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
        <!-- //Navigation -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h4>Pending Users</h4>
                <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                    <th> S/N </th>
                    <th> Name</th>
                    <th> status </th>
                    <th>Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $y=0;
                while ($data = mysqli_fetch_array($users)){                     
					$id = $data['id'];
                    echo "<tr><td>" .++$y. "</td><td>" . $data['name'] . "</td><td>" .$data['status'].                     
                    "</td><td><a class='text-info' href='join.php?view=$id'> Activate </a></td></tr>";
                
                    }
                ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
    <!-- //wrapper -->

	<!-- jQuery -->
	<script src="../vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Js -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Plugin Js -->
	<script src="../vendor/plugin/plugin.min.js"></script>

	<!-- Custom Js -->
	<script src="../dist/js/style.js"></script>>

</body>

</html>