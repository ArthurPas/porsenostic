<?php
class RacesInfos
{
    private $conn;
    private $db_table = "dev_courses";
    public $trainer;

    public $driver;

    public $def;
    public $place;
    public $hippodrome;
    public $length;
    public $age;
    public $spe;
    public $penalty;
    public $g;
    public $p;
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getAllTrainer(){
        $sqlQuery = "SELECT DISTINCT (trainer) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllDriver(){
        $sqlQuery = "SELECT DISTINCT (driver) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllDef(){
        $sqlQuery = "SELECT DISTINCT (def) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllHippodrome(){
        $sqlQuery = "SELECT DISTINCT (hippodrome) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllLength(){
        $sqlQuery = "SELECT DISTINCT (length) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllAge(){
        $sqlQuery = "SELECT DISTINCT (age) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllSpe(){
        $sqlQuery = "SELECT DISTINCT (spe) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllPenalty(){
        $sqlQuery = "SELECT DISTINCT (penalty) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getAllG(){
        $sqlQuery = "SELECT DISTINCT (g) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function getAllByTrainer($trainer){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE trainer = :trainer";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByDriver($driver){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByHippodrome($hippodrome){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE hippodrome = :hippodrome";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":hippodrome", $hippodrome);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByLength($length){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE length = :length";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":length", $length);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByAge($age){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE age = :age";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":age", $age);
        $stmt->execute();
        return $stmt;
    }
    public function getAllBySpe($spe){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE spe = :spe";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":spe", $spe);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByPenalty($penalty){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE penalty = :penalty";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":penalty", $penalty);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByG($g){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE g = :g";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":g", $g);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByDriverAndTrainer($driver, $trainer){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver AND trainer = :trainer";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->execute();
        return $stmt;
    }
    public function getAllByDriverAndTrainerAndDefAndHippodrome($driver, $trainer, $def, $hippodrome){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver AND trainer = :trainer AND def = :def AND hippodrome = :hippodrome";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->bindParam(":def", $def);
        $stmt->bindParam(":hippodrome", $hippodrome);
        $stmt->execute();
        return $stmt;
    }


    public function getAllLoginId(){
        $sqlQuery = "SELECT DISTINCT (login_id) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getDailyKcal($loginId)
    {
        $sqlQuery = "SELECT number FROM " . $this->db_table ." WHERE dateRecord = :dateR AND login_id = :login";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":dateR",date("Y-m-d"));
        $stmt->bindParam(":login",$loginId);
        $stmt->execute();
        return $stmt;
    }
    public function postDailyKcal(){
        $sqlQuery = "INSERT INTO ". $this->db_table ." (number, dateRecord,login_id) VALUES (:number, :now, :login)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":number", $this->number);
        $stmt->bindParam(":now",$this->dateRecord);
        $stmt->bindParam(":login",$this->login_id);
        try {
            $stmt->execute();
        }catch (Exception $e){
            return false;
        }
        return true;
    }
    public function getKcalFromDate($dateR, $loginId){
        $sqlQueryFromDate =  "SELECT * FROM ".$this->db_table." WHERE dateRecord >= :paraDate AND login_id = :login";
        $stmtDate = $this->conn->prepare($sqlQueryFromDate);
        $stmtDate ->bindParam(":paraDate", $dateR);
        $stmtDate->bindParam(":login",$loginId);
        $stmtDate->execute();
        return $stmtDate;
    }

}
