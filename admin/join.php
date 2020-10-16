<?php
include('../connect.php');

session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='admin'){
	$userid = $_SESSION['userid'];
}
else{
	echo '<script>alert("Access denied");window.location.assign("../index.php");</script>';
}
?>
<?php
if (isset($_GET['view'])){
    $id = ($_GET['view']);
    $select = "SELECT * FROM user where id = '$id'";
    $query = mysqli_query($con, $select);
    $get = mysqli_fetch_array($query);
    $newid = $get['id'];
    $name = $get['name'];
    $email = $get['email'];
    $mobile = $get['mobile'];
    $address = $get['address'];        
}     
$select = "SELECT * FROM user";
$all = mysqli_query($con, $select);

//User clicked on join
if(isset($_POST['submit'])){
	$side='';
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$email = mysqli_real_escape_string($con,$_POST['email']);	
	$under_userid = mysqli_real_escape_string($con,$_POST['under_userid']);
	$side = mysqli_real_escape_string($con,$_POST['side']);	
	
	$flag = 0;
	
	if($name!='' && $email!='' && $under_userid!='' && $side!=''){
		//User filled all the fields.		
			if($under_userid){
				//Under userid is ok
				if(side_check($under_userid,$side)){
					//Side check
					$flag=1;
				}
				else{
					echo '<script>alert("The side you selected is not available.");</script>';
				}
			}
			else{
				//check under userid
				echo '<script>alert("Invalid Under userid.");</script>';
			}	
		}	
	else{
		//check all fields are fill
		echo '<script>alert("Please fill all the fields.");</script>';
	}
	
	//Now we are heree
	//It means all the information is correct
	//Now we will save all the information
	if($flag==1){
		
        //Insert into User profile
        $status = 'active';
        $role = 'user';                
        $query = mysqli_query($con, "update user set `under_userid`= '$under_userid', `status`= '$status', `role`= '$role', `side`='$side' where id='$id'");
		
		//Insert into Tree
		//So that later on we can view tree.
		$query = mysqli_query($con,"insert into tree(`userid`) values('$email')");
		
		//Insert to side
		$query = mysqli_query($con,"update tree set `$side`='$email' where userid='$under_userid'");
		//This is the main part to join a user\
		//If you will do any mistake here. Then the site will not work.
		
		//Update count and Income.
		$temp_under_userid = $under_userid;
		$temp_side_count = $side.'count'; //firstcount, secondcount, thirdcount, fourthcount, fifthcount or sixthcount
		
		$temp_side = $side;
		$total_count=1;
		$i=1;
		while($total_count>0){
			$i;
			$q = mysqli_query($con,"select * from tree where userid='$temp_under_userid'");
			$r = mysqli_fetch_array($q);
			$current_temp_side_count = $r[$temp_side_count]+1;
			$temp_under_userid;
			$temp_side_count;
			mysqli_query($con,"update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");
			
		// 	//income
			if($temp_under_userid!=""){			
				//change under_userid
				$next_under_userid = getUnderId($temp_under_userid);
				$temp_side = getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side.'count';
				$temp_under_userid = $next_under_userid;	
				
				$i++;
			}
			
		// 	//Check for the last user
			if($temp_under_userid==""){
				$total_count=0;
			}
			
		}//Loop
		
		
		
		
		echo mysqli_error($con);
		
		echo '<script>alert("User activated Successfully");window.location.assign("index.php");</script>';
	}
	
}
?><!--/join user-->
<?php 
//functions

function side_check($email,$side){
	global $con;
	
	$query =mysqli_query($con,"select * from tree where userid='$email'");
	$result = mysqli_fetch_array($query);
	$side_value = $result[$side];
	if($side_value==''){
		return true;
	}
	else{
		return false;
	}
}

function tree($userid){
	global $con;
	$data = array();
	$query = mysqli_query($con,"select * from tree where userid='$userid'");
	$result = mysqli_fetch_array($query);
	$data['first'] = $result['first'];
	$data['second'] = $result['second'];
    $data['third'] = $result['third'];
    $data['fourth'] = $result['fourth'];
	$data['fifth'] = $result['fifth'];
	$data['sixth'] = $result['sixth'];
	$data['firstcount'] = $result['firstcount'];
	$data['secondcount'] = $result['secondcount'];
    $data['thirdcount'] = $result['thirdcount'];
    $data['fourthcount'] = $result['fourthcount'];
	$data['fifthcount'] = $result['fifthcount'];
	$data['sixthcount'] = $result['sixthcount'];
	
	return $data;
}
function getUnderId($userid){
	global $con;
	$query = mysqli_query($con,"select * from user where email='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['under_userid'];
}
function getUnderIdPlace($userid){
	global $con;
	$query = mysqli_query($con,"select * from user where email='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['side'];
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
                	<div class="col-md-offset-3 col-lg-5">
                    	<form method="post">
							<div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $name?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo $email?>"  class="form-control" required>
                            </div>                                             
                            <div class="form-group">
								<label>Under Userid</label>
								<select name="under_userid" class="form-control">
									<option selected disabled required> Select from list of users</option>
									<?php while($alluser = mysqli_fetch_assoc($all)):;?>
										<option value="<?php echo $alluser['email']?>" ><?php echo $alluser['email'];?></option>
									<?php endwhile;?>
								</select>
                                
                            </div>
                            <div class="form-group">
                                <label>Side</label><br>
                                <input type="radio" name="side" value="first"> First
								<input type="radio" name="side" value="second"> Second
                                <input type="radio" name="side" value="third"> Third
                                <input type="radio" name="side" value="fourth"> Fourth
								<input type="radio" name="side" value="fifth"> Fifth
                                <input type="radio" name="side" value="sixth"> Sixth
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
	<script src="../vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Js -->
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Plugin Js -->
	<script src="../vendor/plugin/plugin.min.js"></script>

	<!-- Custom Js -->
	<script src="../dist/js/style.js"></script>>

</body>

</html>
