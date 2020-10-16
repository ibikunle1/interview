<?php
include('../connect.php');

session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='admin'){
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
$data['totalcount'] = $data['firstcount'] + $data['secondcount']  + $data['thirdcount'] + $data['fourthcount'] + $data['fifthcount']  + $data['sixthcount']; 
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
    <td colspan="4"> <?php echo $name ?> = <?= $data['totalcount']?> downline  </td>
    <td colspan="26"><i class="fa fa-user fa-4x" style="color:#1430B1"></i>
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
        $top_first_user = $data['first'];
        $top_second_user = $data['second'];
        $top_third_user = $data['third'];
        $top_fourth_user = $data['fourth'];
        $top_fifth_user = $data['fifth'];
        $top_sixth_user = $data['sixth'];
        ?>        
        <?php 
            if($top_first_user!=""){
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $top_first_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_first_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_first_user ?></p></td>
            <?php
            }
        ?>
        <?php 
            if($top_second_user!=""){
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $top_second_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_second_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];    
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_second_user ?></p></td>
            <?php
            }
        ?>
        <?php 
            if($top_third_user!=""){
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $top_third_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_third_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];
            
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_third_user ?></p></td>
            <?php
            }
        ?>
        <?php 
            if($top_fourth_user!=""){
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $top_fourth_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_fourth_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_fourth_user ?></p></td>
            <?php
            }
        ?>
        <?php 
            if($top_fifth_user!=""){
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $top_fifth_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_fifth_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];    
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" style="border-right:black solid 1px;"><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_fifth_user ?></p></td>
            <?php
            }
        ?>
        <?php 
            if($top_sixth_user!=""){
            ?>
            <td colspan="6"><a href="tree.php?search-id=<?php echo $top_sixth_user ?>"><i class="fa fa-user fa-4x" style="color:#D520BE"></i>
            <?php 
            $value = mysqli_query($con, "SELECT * from user where email = '$top_sixth_user' ");
            $get = mysqli_fetch_array($value);
            $name = $get['name'];
            
            ?> 
            <p><?php echo $name ?></p></a></td>
            <?php 
            }
            else{
            ?>
            <td colspan="6" ><i class="fa fa-user fa-4x" style="color:#D520BE"></i><p><?php echo $top_sixth_user ?></p></td>
            <?php
            }
        ?>
    </tr>
    <tr height="50">
    <?php 
    //third line first user
    $data_top_first_user = tree_data($top_first_user);
    $first_first_user = $data_top_first_user['first'];
    $first_second_user = $data_top_first_user['second'];
    $first_third_user = $data_top_first_user['third'];
    $first_fourth_user = $data_top_first_user['fourth'];
    $first_fifth_user = $data_top_first_user['fifth'];
    $first_sixth_user = $data_top_first_user['sixth'];
    //third line second user
    $data_top_second_user = tree_data($top_second_user);
    $second_first_user = $data_top_second_user['first'];
    $second_second_user = $data_top_second_user['second'];
    $second_third_user = $data_top_second_user['third'];
    $second_fourth_user = $data_top_second_user['fourth'];
    $second_fifth_user = $data_top_second_user['fifth'];
    $second_sixth_user = $data_top_second_user['sixth'];
    //third line third user
    $data_top_third_user = tree_data($top_third_user);
    $third_first_user = $data_top_third_user['first'];
    $third_second_user = $data_top_third_user['second'];
    $third_third_user = $data_top_third_user['third'];
    $third_fourth_user = $data_top_third_user['fourth'];
    $third_fifth_user = $data_top_third_user['fifth'];
    $third_sixth_user = $data_top_third_user['sixth'];
     //third line fourth user
     $data_top_fourth_user = tree_data($top_fourth_user);
     $fourth_first_user = $data_top_fourth_user['first'];
     $fourth_second_user = $data_top_fourth_user['second'];
     $fourth_third_user = $data_top_fourth_user['third'];
     $fourth_fourth_user = $data_top_fourth_user['fourth'];
     $fourth_fifth_user = $data_top_fourth_user['fifth'];
     $fourth_sixth_user = $data_top_fourth_user['sixth'];
     //third line fifth user
     $data_top_fifth_user = tree_data($top_fifth_user);
     $fifth_first_user = $data_top_fifth_user['first'];
     $fifth_second_user = $data_top_fifth_user['second'];
     $fifth_third_user = $data_top_fifth_user['third'];
     $fifth_fourth_user = $data_top_fifth_user['fourth'];
     $fifth_fifth_user = $data_top_fifth_user['fifth'];
     $fifth_sixth_user = $data_top_fifth_user['sixth'];
     //third line sixth user
     $data_top_sixth_user = tree_data($top_sixth_user);
     $sixth_first_user = $data_top_sixth_user['first'];
     $sixth_second_user = $data_top_sixth_user['second'];
     $sixth_third_user = $data_top_sixth_user['third'];
     $sixth_fourth_user = $data_top_sixth_user['fourth'];
     $sixth_fifth_user = $data_top_sixth_user['fifth'];
     $sixth_sixth_user = $data_top_sixth_user['sixth'];
    ?>
    <!-- first sub-user tree -->    
    <?php 
        if($first_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $first_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($first_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $first_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($first_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $first_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($first_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $first_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($first_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $first_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($first_sixth_user!=""){
        ?>
        <td style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $first_sixth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$first_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td style="border-right:black solid 1px;"><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    
    <!-- second sub-user tree -->
    <?php 
        if($second_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $second_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($second_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $second_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($second_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $second_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($second_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $second_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($second_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $second_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($second_sixth_user!=""){
        ?>
        <td style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $second_sixth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$second_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td style="border-right:black solid 1px;"><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <!-- third sub-user tree -->
    <?php 
        if($third_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $third_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($third_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $third_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($third_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $third_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($third_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $third_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($third_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $third_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($third_sixth_user!=""){
        ?>
        <td style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $third_sixth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$third_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td style="border-right:black solid 1px;"><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <!-- fourth sub-user tree -->
    <?php 
        if($fourth_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fourth_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fourth_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fourth_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fourth_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fourth_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fourth_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fourth_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fourth_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fourth_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fourth_sixth_user!=""){
        ?>
        <td style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $fourth_sixth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fourth_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td style="border-right:black solid 1px;"><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <!-- fifth sub-user tree -->
    <?php 
        if($fifth_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fifth_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fifth_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fifth_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fifth_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fifth_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fifth_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fifth_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fifth_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $fifth_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($fifth_sixth_user!=""){
        ?>
        <td style="border-right:black solid 1px;"><a href="tree.php?search-id=<?php echo $fifth_sixth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$fifth_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td style="border-right:black solid 1px;"><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <!-- sixth sub-user tree -->
    <?php 
        if($sixth_first_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_first_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_first_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($sixth_second_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_second_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_second_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($sixth_third_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_third_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_third_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($sixth_fourth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_fourth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_fourth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($sixth_fifth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_fifth_user ?>"><i class="fa fa-user" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_fifth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user" style="color:#361515"></i></td>
        <?php
        }
    ?>
    <?php 
        if($sixth_sixth_user!=""){
        ?>
        <td><a href="tree.php?search-id=<?php echo $sixth_sixth_user ?>"><i class="fa fa-user fa-1x" style="color:#361515"></i>
        <?php 
        $value = mysqli_query($con, "SELECT * from user where email = '$sixth_sixth_user' ");
        $get = mysqli_fetch_array($value);
        $name = $get['name'];
        ?> 
        <p><?php echo $name ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-user " style="color:#361515"></i></td>
        <?php
        }
    ?>
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
<script src="../vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap Js -->
<script src="../`vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Plugin Js -->
<script src="../vendor/plugin/plugin.min.js"></script>
<!-- Custom Js -->
<script src="../dist/js/style.js"></script>
</body>
</html>