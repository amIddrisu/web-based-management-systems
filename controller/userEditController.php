<?php
require '../service/userService.php';
require '../validation/userValidation.php';	

if (isset($_POST['cancel'])) { redirect('welcome.php');}	

 $userService = new UserService();
$res = new UserValidation();
$user = new User();

if (isset($_GET['id'])) {

	$user=$userService->getUser($_GET['id']); 
}	

if (isset($_POST['submit'])) {
   
    $user->user_id = $_POST['user_id'];
    $user->address = $_POST['address'];
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->email = $_POST['email'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
     $user->role_id = $_POST['role_id'];
      $user->phone = $_POST['phone'];
   
    $user->status = 0;
        if ($_POST['status'] ) {
            $user->status = 1;
        }
    if ($res->validate($user)) {
        //update
        $res->ERROR_MSG=$res->ERROR_MSG.$userService->edit($user);
    }
}

