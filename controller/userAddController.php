<?php

require '../service/userService.php';
require '../validation/userValidation.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
if (isset($_POST['cancel'])) { redirect('welcome.php');}
$res = new UserValidation();
$user = new User();
 $userService = new UserService();
if (isset($_POST['submit'])) {
      $user->address = $_POST['address'];
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->email = $_POST['email'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->phone = $_POST['phone'];
     $user->role_id = $_POST['role_id'];
     $user->photo=basename($_FILES['photo']['name']);
      $user->status = 0;
        if ($_POST['status'] ) {
            $user->status = 1;
        }
    if ($res->validate($user)) {
        //insert
       
        $res->ERROR_MSG=$res->ERROR_MSG.$userService->add($user);
    }
}

