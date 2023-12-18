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


    public function getAllTrainer()
    {
        $sqlQuery = "SELECT DISTINCT (trainer) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function getAllDriver()
    {
        $sqlQuery = "SELECT DISTINCT (driver) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }


    //NOT USED
    public function getGlobalRankByTypes($type, $value)
    {
        $sqlQuery = "SELECT main.trainer, main.number_of_occurrences, main.total_place,
                    main.average_place, AVG(place) AS overall_average_place FROM (SELECT trainer, COUNT(*) 
                    AS number_of_occurrences, AVG(place) AS average_place FROM
                    dev_courses ";

        $endQuery = "GROUP BY trainer) AS main JOIN dev_courses AS all_hippodromes
                    ON main.trainer = all_hippodromes.trainer GROUP BY main.trainer 
                    ORDER BY main.number_of_occurrences DESC, main.total_place DESC LIMIT 10;";
        if (strlen($type) == 3) {
            $sqlQuery .= "WHERE hippodrome = :hippodrome AND trainer = :trainer AND driver = :driver";
            $sqlQuery .= $endQuery;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":driver", $value[0]);
            $stmt->bindParam(":hippodrome", $value[1]);
            $stmt->bindParam(":trainer", $value[2]);
        } else if (strlen($type) == 2) {
            if ($type == "HT") {
                $sqlQuery .= "WHERE hippodrome = :hippodrome AND trainer = :trainer ";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":hippodrome", $value[1]);
                $stmt->bindParam(":trainer", $value[2]);
            } else if ($type == "HD") {
                $sqlQuery .= "WHERE hippodrome = :hippodrome AND driver = :driver";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":driver", $value[0]);
                $stmt->bindParam(":hippodrome", $value[1]);
            } else if ($type == "TD") {
                $sqlQuery .= "WHERE trainer = :trainer AND driver = :driver";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":driver", $value[0]);
                $stmt->bindParam(":trainer", $value[2]);
            }
        } else if (strlen($type) == 1) {
            if ($type == "H") {
                $sqlQuery .= " WHERE hippodrome = :hippodrome ";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":hippodrome", $value[1]);
            } else if ($type == "T") {
                $sqlQuery .= "WHERE trainer = :trainer ";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":trainer", $value[2]);
            } else if ($type == "D") {
                $sqlQuery .= "WHERE driver = :driver ";
                $sqlQuery .= $endQuery;
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":driver", $value[0]);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function getAllStat($stats)
    {
        $sqlQuery = "SELECT main.trainer, main.number_of_occurrences,
                    main.average_place, AVG(place) AS overall_average_place FROM (SELECT trainer, COUNT(*) 
                    AS number_of_occurrences, AVG(place) AS average_place FROM
                    dev_courses ";

        $endQuery = "GROUP BY trainer) AS main JOIN dev_courses AS all_hippodromes
                    ON main.trainer = all_hippodromes.trainer GROUP BY main.trainer 
                    ORDER BY main.number_of_occurrences DESC,  main.average_place DESC LIMIT 10;";
        $index = 0;
        $sqlQuery .= "WHERE ";
        foreach ($stats as $key => $value) {
            $sqlQuery .= $key . " = '" . $value . "' ";
            if ($index != count($stats) - 1) {
                $sqlQuery .= " AND ";
            }
            $index++;
        }
        $sqlQuery .= $endQuery;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllDef()
    {
        $sqlQuery = "SELECT DISTINCT (def) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllHippodrome()
    {
        $sqlQuery = "SELECT DISTINCT (hippodrome) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllLength()
    {
        $sqlQuery = "SELECT DISTINCT (length) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllAge()
    {
        $sqlQuery = "SELECT DISTINCT (age) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllSpe()
    {
        $sqlQuery = "SELECT DISTINCT (spe) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllPenalty()
    {
        $sqlQuery = "SELECT DISTINCT (penalty) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllG()
    {
        $sqlQuery = "SELECT DISTINCT (g) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByTrainer($trainer)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE trainer = :trainer";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByDriver($driver)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByHippodrome($hippodrome)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE hippodrome = :hippodrome";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":hippodrome", $hippodrome);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByLength($length)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE length = :length";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":length", $length);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByAge($age)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE age = :age";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":age", $age);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllBySpe($spe)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE spe = :spe";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":spe", $spe);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByPenalty($penalty)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE penalty = :penalty";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":penalty", $penalty);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByG($g)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE g = :g";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":g", $g);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByDriverAndTrainer($driver, $trainer)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver AND trainer = :trainer";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->execute();
        return $stmt;
    }

    public
    function getAllByDriverAndTrainerAndDefAndHippodrome($driver, $trainer, $def, $hippodrome)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE driver = :driver AND trainer = :trainer AND def = :def AND hippodrome = :hippodrome";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":driver", $driver);
        $stmt->bindParam(":trainer", $trainer);
        $stmt->bindParam(":def", $def);
        $stmt->bindParam(":hippodrome", $hippodrome);
        $stmt->execute();
        return $stmt;
    }


    public
    function getAllLoginId()
    {
        $sqlQuery = "SELECT DISTINCT (login_id) FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
}