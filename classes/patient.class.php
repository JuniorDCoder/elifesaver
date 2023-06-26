<?php
class Patient{
    public $id;
    public $user_id;
    public $blood_group;
    public $health_facility;
    public $appeal_status;
    public $conn;
    public function __construct($user_id, $blood_group, $health_facility, $appeal_status){
        $this->user_id = $user_id;
        $this->blood_group = $blood_group;
        $this->health_facility = $health_facility;
        $this->appeal_status = $appeal_status;
        $this->conn = Database::getInstance()->getConn();
    }
    public static function getPatientIdFromUserId($user_id) {
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare('SELECT id FROM patients WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }
        return false;
    }
}