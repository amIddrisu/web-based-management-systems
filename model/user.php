<?php

class User {

    public $user_id;
    public $username;
    public $password;
    public $email;
    public $address;
    public $status;
    public $photo;
    public $phone;
    public $firstname;
    public $lastname;
    public $modifiedDate;
    public $modifiedBy_id;
    public $submittedDate;
    public $submittedBy_id;
    public $lastloggedin;
    public $role_id;
    public $fullName;

    //constructor
    function User() {
       
    }
    function getFullname() {
        $this->fullName =  $this->firstname.' '.$this->lastname;
         return $this->fullName;
    }
}

?>
 	