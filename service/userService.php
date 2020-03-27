<?php

require '../include/header.php';
require '../model/user.php';
require '../util/uuid.php';

class UserService {

    public $plink;
    public $ERROR_MSG = '';

    //User constructor
    function UserService() {
        global $link;
        $this->plink = $link;
    }

    //returns single User object
    public function getUser($id) {
        //sql to return user object

        $sql = "select * from user where user_id=" . '"' . $id . '"';
        $result = mysqli_query($this->plink, $sql);


        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $user = new User();
        if ($count == 1) {
            $user = $this->user($row);
        }
        return $user;
    }

    //helper method used to build user object
    public static function user($row) {
        if (!empty($row)) {
            $user = new User();
            foreach ($row as $key => $value) {
                $user->$key = $value;
            }
            return $user;
        }
    }

    //returns an array of all user objects in storage
    public function getUsers() {
        //sql to return all user objects
        $sql = "select * from user";
        $users = array();
        $result = mysqli_query($this->plink, $sql);
        while ($rows = mysqli_fetch_assoc($result)) {
            $users[] = $this->user($rows);
        }
        return $users;
    }

    //adds a new user object into database
    public function add($user) {

        $user_id = UUID::v4();
        //$modifiedby_id = $_SESSION["loggedid"];
        $submittedby_id = $_SESSION["loggedid"];
        // $photo = basename($_FILES['photo']['name']);
        $user->password=  md5($user->password);

        if ($_FILES['photo']['size'] == 0) {
            //do nothing on photo file name
            $query = "INSERT INTO user (user_id,username,password,email,address,phone,firstname,lastname,
		submittedby_id,role_id,status)
		VALUES ('$user_id','$user->username','$user->password','$user->email','$user->address','$user->phone','$user->firstname','$user->lastname',
		'$submittedby_id','$user->role_id','$user->status');";
            $result = mysqli_query($this->plink, $query);
            if (!$result) {
                $this->ERROR_MSG = $this->ERROR_MSG . 'Error: ' . mysqli_error($this->plink) . "<br>";
                return $this->ERROR_MSG;
            }
            // close connection
            // mysqli_close();
            $url = "../view/userView.php?id=$user_id";
            redirect($url);
        } else {
            // $image = 'images/' . $photo;
            $uploaddir = '../images/photo/';
            $uploadfile = $uploaddir . $user->photo;
            $query = "INSERT INTO user (user_id,username,password,email,address,phone,firstname,lastname,
		submittedby_id,role_id,photo,status)
		VALUES ('$user_id','$user->username','$user->password','$user->email','$user->address','$user->phone','$user->firstname','$user->lastname',
		'$submittedby_id','$user->role_id','$user->photo','$user->status');";

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                //File is valid, and was successfully uploaded.
                $result = mysqli_query($this->plink, $query);
                if (!$result) {
                    $this->ERROR_MSG = $this->ERROR_MSG . 'Error: ' . mysqli_error($this->plink) . "<br>";
                    return $this->ERROR_MSG;
                }
                createThumbs($uploadfile,$user->photo,100);
                // close connection
                // mysqli_close();

                $url = "../view/userView.php?id=$user_id";
                redirect($url);
            }
        }
    }

    //edits the properties of an existing user object in database
    public function edit($user) {

        //debugout($user);
        $submittedby_id = $_SESSION["loggedid"];
        if(!$this->isValidMd5($user->password)){
           $user->password=  md5($user->password); 
        }

        if ($_FILES['photo']['size'] == 0) {
            //do nothing on photo file name
            $query = "UPDATE user SET firstname='$user->firstname',lastname='$user->lastname',username='$user->username',email='$user->email',password='$user->password',
			address='$user->address',phone='$user->phone',status='$user->status',submittedby_id='$submittedby_id',role_id='$user->role_id'
		WHERE user_id='$user->user_id';";
            $result = mysqli_query($this->plink, $query);
            if (!$result) {
                $this->ERROR_MSG = $this->ERROR_MSG . 'Error: ' . mysqli_error($this->plink) . "<br>";
                return $this->ERROR_MSG;
            }
            // close connection
          //  mysqli_close($this->plink);
            $url = "../view/userView.php?id=$user->user_id";
            redirect($url);
        } else {
            $photo = basename($_FILES['photo']['name']);
            // $image = 'images/' . $photo;
            $uploaddir = '../images/photo/';
            $uploadfile = $uploaddir . $photo;

            $query = "UPDATE user SET firstname='$user->firstname',lastname='$user->lastname',username='$user->username',email='$user->email',password='$user->password',
			address='$user->address',phone='$user->phone',status='$user->status',
			submittedby_id='$submittedby_id',role_id='$user->role_id',photo='$photo'
		WHERE user_id='$user->user_id';";
            // upload file
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                $result = mysqli_query($this->plink, $query);
                if (!$result) {
                    $this->ERROR_MSG = $this->ERROR_MSG . 'Error: ' . mysqli_error($this->plink) . "<br>";
                    return $this->ERROR_MSG;
                }
                createThumbs($uploadfile,$photo,100);
                // close connection
              //  mysqli_close($this->plink);

                $url = "../view/userView.php?id=$user->user_id";
                redirect($url);
            }
        }
    }
    function isValidMd5($md5 ='') {
      return strlen($md5) == 32 && ctype_xdigit($md5);
    }
    //deletes an existing user object from database

    public function getDelete($id, $all = false) {

        if (!is_null($id)) {
            if ($all) {
                $query = "DELETE from user  where user_id in (" . $id . ")";
            } else {

                $query = "DELETE from user  where user_id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
            // close connection
            mysqli_close($this->plink);
        }
    }

    //returns the number of user objects in database having the given ID
    public function getCount($id) {
        $id = mysqli_real_escape_string($this->plink, $id);
        $query = "select * from user  where user_id=" . $id;
        $result = mysqli_query($this->plink, $query);
        return mysqli_num_rows($result);
    }

    //changes the status property of a user object
    public function changeStatus() {
        //TODO filter_input
        $id = $_GET['id'];
        $status = $_GET['sid'];
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $query = "UPDATE user SET status='$status'
		WHERE user_id='$id';";
        mysqli_query($this->plink, $query);
        // close connection
        mysqli_close($this->plink);

        redirect('../view/userList.php');
    }

    //returns the name of a role having the given ID
    public function getRole($id) {

        $sql = "select * from user,roles where user.user_id='" . $id . "' and user.role_id=roles.role_id";
        $role = array();
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($count == 1) {
            $role = $row;
        }
        return $role;
    }

    public function showUserRoleOptions() {

        $sql = "SELECT * from roles";

        $result = mysqli_query($this->plink, $sql);
        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['role_id'] . '">' . $row['name'] . '</option>';
        }
        echo $opt;
    }

}
