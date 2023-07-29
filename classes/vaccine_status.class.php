<?php

class VaccineStatus{
    public $vaccine_status_id;
    public $bts_number;
    public $status;
    public $vaccine_id;
    public $date;
    private $conn;
    
    public function __construct($bts_number, $status, $vaccine_id, $date) {
        $this->bts_number = $bts_number;
        $this->status = $status;
        $this->vaccine_id = $vaccine_id;
        $this->date = $date;
        $this->conn = Database::getInstance()->getConn();
    }
    
    public static function getAllVaccineStatusesByBtsNumber($bts_number) {
        $conn = Database::getInstance()->getConn();
        
        $stmt = $conn->prepare("SELECT * FROM vaccine_status WHERE bts_number = ?");
        $stmt->bind_param("s", $bts_number);
        $stmt->execute();
        $result = $stmt->get_result();

        $vaccine_statuses = array();
        while ($row = $result->fetch_assoc()) {
            $vaccine_status = new VaccineStatus($row['bts_number'], $row['status'], $row['vaccine_id'], $row['date']);
            $vaccine_status->vaccine_status_id = $row['vaccine_status_id'];
            $vaccine_statuses[] = $vaccine_status;
        }

        $stmt->close();
        return $vaccine_statuses;
    }
    public static function getAllVaccineStatusesByVaccineId($vaccine_id) {
        $conn = Database::getInstance()->getConn();
        
        $stmt = $conn->prepare("SELECT * FROM vaccine_status WHERE vaccine_id = ?");
        $stmt->bind_param("i", $vaccine_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $vaccine_statuses = array();
        while ($row = $result->fetch_assoc()) {
            $vaccine_status = new VaccineStatus($row['bts_number'], $row['status'], $row['vaccine_id'], $row['date']);
            $vaccine_status->vaccine_status_id = $row['vaccine_status_id'];
            $vaccine_statuses[] = $vaccine_status;
        }

        $stmt->close();
        return $vaccine_statuses;
    }
}