<?php
include 'db_connect.class.php';
class Result{
    public $results_id;
    public $bts;
    public $hcv;
    public $hbag;
    public $hiv;
    public $syphilis;
    public $weight;
    public $bp_up;
    public $bp_down;
    public $hb;
    public $hcv_elisa;
    public $hbsAg_elisa;
    public $hiv_elisa;
    public $observation;
    public $date;
    private $conn;
    public function __construct($bts, $hcv, $hbag, $hiv, $syphilis, $weight, $bp_up, $bp_down, $hb, $hcv_elisa, $hbsAg_elisa, $hiv_elisa, $observation){
        $this->bts = $bts;
        $this->hcv = $hcv;
        $this->hbag = $hbag;
        $this->hiv = $hiv;
        $this->syphilis = $syphilis;
        $this->weight = $weight;
        $this->bp_up = $bp_up;
        $this->bp_down = $bp_down;
        $this->hb= $hb;
        $this->hcv_elisa = $hcv_elisa;
        $this->hbsAg_elisa = $hbsAg_elisa;
        $this->hiv_elisa = $hiv_elisa;
        $this->observation = $observation;
        $this->conn = Database::getInstance()->getConn();
    }
    public function createNewResult(){
        $stmt = $this->conn->prepare("INSERT INTO results_serology (`bts`, `HCV`, `HBAg`, `HIV`, `syphilis`, `weight`, `bp_up`, `bp_down`, `hb`, `HCV_elisa`, `HBsAg_elisa`, `HIV_elisa`, `observation`)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssss",
        $this->bts, $this->hcv, $this->hbag, $this->hiv, $this->syphilis, $this->weight, $this->bp_up, $this->bp_down, $this->hb, $this->hcv_elisa, $this->hbsAg_elisa, $this->hiv_elisa, $this->observation);
        if ($stmt->execute()){
            $this->results_id = $this->conn->insert_id;
            $stmt->close();

            return new Result($this->bts, $this->hcv, $this->hbag, $this->hiv, $this->syphilis, $this->weight, $this->bp_up, $this->bp_down, $this->hb, $this->hcv_elisa, $this->hbsAg_elisa, $this->hiv_elisa, $this->observation);
        }
        return false;
    }
    public static function getAllResultsForDonor($bts_number){
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("SELECT * FROM results_serology WHERE bts = ?");
        $stmt->bind_param("s", $bts_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    public static function deleteDonorResults($bts_number){
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare("DELETE FROM results_serology WHERE bts = ?");
        $stmt->bind_param("s", $bts_number);

        if($stmt->execute()){
            $stmt->close();
            $conn->close();
            return true;
        }
        return false;
    }
}