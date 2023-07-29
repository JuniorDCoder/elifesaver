<?php

class Vaccine{
    
    //Properties
    public $vaccine_id;
    public $vaccine_name;
    private $conn;
    
    //Constructor
    public function __construct($vaccine_name){
        $this->vaccine_name = $vaccine_name;
        $this->conn = Database::getInstance()->getConn();
    }
    
    //Create a new vaccine
    public function createNewVaccine(){
        $stmt = $this->conn->prepare("INSERT into vaccine (vaccine_name) VALUES (?);");
        $stmt->bind_param("s",$this->vaccine_name);
        
        if($stmt->execute()){
            $stmt->close();
            
            return new Vaccine($this->vaccine_name);
        }
        return false;
    }
    
    //Get a particular vaccine based on the vaccine id
    public static function getVaccineById($id){
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM vaccine WHERE vaccine_id = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            $vaccine = $result->fetch_all(MYSQLI_ASSOC);
            return $vaccine;
        }
        return false;
    }
     public static function getVaccineNameById($id){
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT vaccine_name FROM vaccine WHERE vaccine_id = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            $vaccine_name = $result->fetch_assoc();
            return $vaccine_name['vaccine_name'];
        }
        return false;
    }
    
    //Get all vaccines in the database
    public static function getAllVaccines(){
        
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM vaccine");
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            $vaccines = array();
            
            while($row = $result->fetch_assoc()){
                $vaccine = new Vaccine($row['vaccine_name']);
                $vaccine->id = $row['vaccine_id'];
                array_push($vaccines, $vaccine);
            }
            
            $stmt->close();
            return $vaccine;
        }
        return false;
    }
    
    //Delete a particular vaccine
    public static function deleteVaccine($id) {
        $conn = Database::getInstance()->getConn();
        // Execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM vaccine WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
          $stmt->close();
          $conn->close();
          return true;
        } else {
          return false;
        }
  }
}