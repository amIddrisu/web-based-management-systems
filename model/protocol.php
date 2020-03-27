<?php

class Protocol {

    public $id;
    public $scp_number;
    public $pro_number;
    public $dept_id;
    public $section_id;
    public $unit_id;
    public $pro_reference;
    public $pro_question;
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


