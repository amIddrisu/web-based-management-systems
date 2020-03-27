<?php

class Scope {

    public $id;
    public $scp_number;
    public $description;
    public $dept_id;
    public $section_id;
    public $unit_id;
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
