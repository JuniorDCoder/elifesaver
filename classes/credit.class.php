<?php
class Credit
{
    public $credit_id;
    public $bts_number;
    public $donation_number;
    public $credit;
    public $id;
    private $conn;

    public function __construct($bts_number){
        $this->bts_number = $bts_number;
        $this->conn = Database::getInstance()->getConn();
    }

    public function addCredit(){
        // Check if the user already has a credit record
        $stmt = $this->conn->prepare("SELECT * FROM credit WHERE bts_number = ?");
        $stmt->bind_param("s", $this->bts_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        if ($result->num_rows > 0) {
            // User already has a credit record, increment donation_number and add 100 to the credit
            $stmt = $this->conn->prepare("UPDATE credit SET donation_no = donation_no + 1, credit = credit + 100 WHERE bts_number = ?");
            $stmt->bind_param("s", $this->bts_number);
            $stmt->execute();
            $stmt->close();
        } else {
            // User doesn't have a credit record, set donation_number to 1 and credit to 100
            $stmt = $this->conn->prepare("INSERT INTO credit(bts_number, donation_no, credit) VALUES (?, 1, 100)");
            $stmt->bind_param("s", $this->bts_number);
            if ($stmt->execute()) {
                $this->credit_id = $this->conn->insert_id;
            }
            $stmt->close();
        }
    }
    public static function getCredit($bts_number)
    {
        $conn = Database::getInstance()->getConn();

        $stmt = $conn->prepare("SELECT credit FROM credit WHERE bts_number = ?");
        $stmt->bind_param("s", $bts_number);
        $stmt->execute();
        $stmt->bind_result($credit);
        $stmt->fetch();
        $stmt->close();

        return $credit;
    }

    public static function getDonationCount($bts_number)
    {
        $conn = Database::getInstance()->getConn();

        $stmt = $conn->prepare("SELECT donation_no FROM credit WHERE bts_number = ?");
        $stmt->bind_param("s", $bts_number);
        $stmt->execute();
        $stmt->bind_result($donationCount);
        $stmt->fetch();
        $stmt->close();

        return $donationCount;
    }
}
