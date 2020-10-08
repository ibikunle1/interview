<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skyware Test - Login User</title>

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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Name: IBIKUNLE JOHNSON</h3>                        
                    </div>    
                    <div class="panel-heading">
                        <h3 class="panel-title">Mobile: 08102515228</h3>                        
                    </div> 
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail: teejohnson356@gmail.com</h3>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>                                
                                <button type="submit"  class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
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
