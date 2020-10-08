<?php
include('connect.php');

session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='user'){
    $userid = $_SESSION['userid'];
    $query = mysqli_query($con, "SELECT * FROM user where email = '$userid' ");
    $get = mysqli_fetch_array($query);
    $name = $get['name'];
 
    $search = $userid;
}
else{
	echo '<script>alert("Access denied");window.location.assign("index.php");</script>';
}
?>
<?php
function tree_data($userid){
global $con;
$data = array();
$query = mysqli_query($con,"select * from tree where userid='$userid'");
$result = mysqli_fetch_array($query);
$data['left'] = $result['left'];
$data['center'] = $result['center'];
$data['right'] = $result['right'];
$data['leftcount'] = $result['leftcount'];
$data['centercount'] = $result['centercount'];
$data['rightcount'] = $result['rightcount'];
$data['totalcount'] = $data['leftcount'] + $data['centercount']  + $data['rightcount']; 
return $data;
}

?>
<?php 
if(isset($_GET['search-id'])){
$search_id = mysqli_real_escape_string($con,$_GET['search-id']);
if($search_id!=""){
$query_check = mysqli_query($con,"select * from user where email='$search_id'");
$get = mysqli_fetch_array($query_check);
$name = $get['name'];
if(mysqli_num_rows($query_check)>0){
$search = $search_id;
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
}
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Skyware Test - Tree </title>

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
                <li>
                    <a href="tree.php"><i class="fa fa-adjust fa-hub"></i>Tree</a>
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
<h1 class="page-header">Tree</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table" align="center" border="0" style="text-align:center">
    <tr height="150">
    <?php
    $data = tree_data($search);
    ?>
    <td> <?php echo $name ?> = <?= $data['totalcount']?> downline  </td>
    <td colspan="8"><i class="fa fa-user fa-4x" style="color:#1430B1"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$search' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name; ?></p></td>
    <td> &nbsp; </td>
    </tr>
    <tr height="150">
    <?php
    $first_left_user = $data['left'];
    $first_center_user = $data['center'];
    $first_right_user = $data['right'];
    ?>
    <?php 
    if($first_left_user!=""){
    ?>
    <td colspan="3"><a href="tree.php?search-id=<?php echo $first_left_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$first_left_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="3"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $first_left_user ?></p></td>
    <?php
    }
    ?>
    <?php 
    if($first_center_user!=""){
    ?>
    <td colspan="3"><a href="tree.php?search-id=<?php echo $first_center_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$first_center_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];    
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="3"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $first_center_user ?></p></td>
    <?php
    }
    ?>
    <?php 
    if($first_right_user!=""){
    ?>
    <td colspan="3"><a href="tree.php?search-id=<?php echo $first_right_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$first_right_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="3"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $first_right_user ?></p></td>
    <?php
    }
    ?>
    </tr>
    <tr height="150">
    <?php 
    $data_first_left_user = tree_data($first_left_user);
    $second_left_user = $data_first_left_user['left'];
    $second_center_user = $data_first_left_user['center'];
    $second_right_user = $data_first_left_user['right'];

    $data_first_center_user = tree_data($first_center_user);
    $third_left_user = $data_first_center_user['left'];
    $third_center_user = $data_first_center_user['center'];
    $third_right_user = $data_first_center_user['right'];

    $data_first_right_user = tree_data($first_right_user);
    $fourth_left_user = $data_first_right_user['left'];
    $fourth_center_user = $data_first_right_user['center'];
    $fourth_right_user = $data_first_right_user['right'];
    ?>
    <?php 
    if($second_left_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $second_left_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$second_left_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($second_center_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $second_center_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$second_center_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($second_right_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $second_right_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$second_left_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($third_left_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $third_left_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$third_left_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($third_center_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $third_center_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$third_center_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($third_right_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $third_right_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$third_right_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($fourth_left_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $fourth_left_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$fourth_left_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($fourth_center_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $fourth_center_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$fourth_center_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>
    <?php 
    if($fourth_right_user!=""){
    ?>
    <td><a href="tree.php?search-id=<?php echo $fourth_right_user ?>"><i class="fa fa-user fa-4x" style="color:#361515"></i>
    <?php 
    $value = mysqli_query($con, "SELECT * from user where email = '$fourth_right_user' ");
    $get = mysqli_fetch_array($value);
    $name = $get['name'];
    ?> 
    <p><?php echo $name ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-user fa-4x" style="color:#361515"></i></td>
    <?php
    }
    ?>

    </tr>
</table>
</div>

    
</div>
</div>
</div>
<!-- //container-fluid -->
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
<script src="dist/js/style.js"></script>
</body>
</html>