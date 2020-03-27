<?php

class UserValidation {

    public $ERROR_MSG = '';

    //constructor
    function UserValidation() {
        
    }

    //validation
    function validate($data) {

        $error = false;

        if (empty($data->username)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Username. <br>';
            $error = true;
        }
        if (empty($data->firstname)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter First Name. <br>';
            $error = true;
        }
        if (empty($data->lastname)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Last Name. <br>';
            $error = true;
        }
        if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter valid Email. <br>';
            $error = true;
        }

        if (empty($data->status)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Username. <br>';
            $error = true;
        }
        if (empty($data->password)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Password. <br>';
            $error = true;
        }
        if (empty($data->role_id)) {

            $this->ERROR_MSG = $this->ERROR_MSG . 'Please select Role of User. <br>';
            $error = true;
        }

        //return error state
        if ($error) {
            return false;
        }

        return true;
    }

}
