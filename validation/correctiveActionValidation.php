<?php

class CorrectiveActionValidation {

    public $ERROR_MSG = '';

    function CorrectiveActionValidation() {
        
    }

    function validate($data) {

        $error = false;

        if (empty($data->finding_num)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Finding Number. <br>';
            $error = true;
        }
          if (empty($data->status)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Status. <br>';
            $error = true;
        }
          if (empty($data->description)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Description. <br>';
            $error = true;
        }
           if (empty($data->finding_priority)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Finding Priority. <br>';
            $error = true;
        }
          if (empty($data->start_date)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Start Date. <br>';
            $error = true;
        }
          if (empty($data->finding_priority_date)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Finding Priority Date. <br>';
            $error = true;
        }
        if (empty($data->finish_date)) {
            $this->ERROR_MSG = $this->ERROR_MSG . 'Please Enter Finish Date. <br>';
            $error = true;
        }



        if ($error) {
            return false;
        }
        return true;
    }

    public function valInput($data) {
        //  $data = trim($data);
        // $data = mysqli_real_escape_string($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>

