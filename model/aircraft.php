<?php

class aircraft {

    public $id;
    public $modifieddate;
    public $name;
    public $submittedDate;
    public $aircrafttype;
    public $helicopter;
    public $uom;
    public $weight;
    public $submittedby_id;
    public $modifiedby_id;

    //constructor
    public function __construct() {
    }
    function getName() {
       return $this->name;
    }

}
?>

