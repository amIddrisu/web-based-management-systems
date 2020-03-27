<?php

class Finding {

    public $id;
    public $finding_num;
    public $pro_number;
    public $audit_ref_num;
    public $description;
    public $recommendation;
    public $evidence;
    public $submitteddate;
    public $submittedby_id;
    public $modifieddate;
    public $modifiedby_id;

    //constructor
    public function __construct() {
    }
    function getName() {
       return $this->name;
    }

}
?>

