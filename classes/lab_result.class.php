<?php
class LabResult{
    public $id;
    public $donor_id;
    public $test_type;
    public $reslt_value;
    public $date;
    private $conn;

    public function __construct($donor_id, $test_type, $reslt_value, $date){
        $this->donor_id = $donor_id;
        $this->test_type = $test_type;
        $this->reslt_value = $reslt_value;
        $this->date = $date;
        $this->conn = Database::getInstance()->getConn();
    }
}