<?php
require 'include/global.php';

$login_fail = false;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "select * from user where username ='$username' and password='$password' and status ='1'";
    
    

    $result = mysqli_query($link, $query) or mysqli_error();
    
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    
    if ($count == 1) {
        $logggedin_role_id = $row['role_id'];
        
       $sql_acl = "select roles.name as role_name
        
                from roles
                where roles.role_id='".$logggedin_role_id."'";
        
    $result_acl = mysqli_query($link, $sql_acl) or mysqli_error();
      $_SESSION['rolename'] = '';
      
        while ($rows = mysqli_fetch_assoc($result_acl)) {
            
            $_SESSION['rolename']=$rows['role_name'];
        }
        
   
       
         // store user session data
        $_SESSION['loggedin'] = $_POST['username'];
        $_SESSION['loggedid'] = $row['user_id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['photo'] = $row['photo'];
        $_SESSION['email'] = $row['email'];
      // debugout($_SESSION);
        // Get all roles in database
        
//        //sql to return all role objects
//        $sql = "SELECT * from roles";
//        $rolesinDB = array();
//        $result = mysqli_query($link, $sql);
//        while ($row = mysqli_fetch_assoc($result)) {
//            $rolesinDB[] = $row['name'];
//        }
//         $_SESSION['rolesinDB'] = $rolesinDB;
       
        
        //header("Location: ");	
        redirect("view/welcome.php");

        /* echo "<script>window.location='view/welcome.php';</script>"; */
    } else {
        $login_fail = true;
    }
}

if ($login_fail == true) {
    echo"<div class='row'>
	        <div class='col-md-4'>&nbsp;</div>
			<div id='myAlert' class='alert alert-danger col-md-4'>       	 
	       	 	<center><strong>Warning!</strong>&nbsp;Username or Password Incorrect!</center>
    		</div>
			<div class='col-md-4'>&nbsp;</div>
		</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>STAFF MANAGEMENT SYSTEM</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">

            <form class="form-signin" action="" id="loginform" method="post">
                <h3 class="form-signin-heading"><center>STAFF MANAGEMENT SYSTEM</center></h3>
                <input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
                <br>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
                <br>
                <br>
                <input name="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
                <h6 align="center"><script type="text/javascript">
                    copyright = new Date();
                    update = copyright.getFullYear();
                    document.write("Copyright &copy;" + update + " amIddrisu CodeWorld. <br> All rights reserved.");
                    </script>
                </h6>
            </form>
        </div>
    </body>
</html>

