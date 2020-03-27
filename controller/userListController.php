<?php
require '../service/userService.php';
if (!('Administrator' === $_SESSION['rolename'])) { session_destroy(); redirect("../index.php");}
if (isset($_POST['cancel'])) { redirect('userList.php');}
$userService = new UserService();

if (isset($_GET['id'])) {
	$userService->changeStatus();    
}

$stds = $userService->getUsers();
?>