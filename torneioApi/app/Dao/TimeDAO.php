<?php
namespace App\Dao;

use App\Util\Connection;
use App\Mapper\TimeMapper;
use App\Model\Time;
use ArrayObject;
use \Exception;

class TimeDAO {

    private $conn;
    private $timeMapper;

    public function __construct(){
        $this->conn = Connection::getConnection();
        $this->timeMapper = new TimeMapper();
    }

    public function list() {

        $sql = "SELECT * FROM time ORDER BY nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
        
        return $this->timeMapper->mapFromDatabaseArrayToObjectArray($result);
    }

    public function list_this(int $id) {

        $sql = "SELECT * FROM time WHERE id  = ?";
        $stm = $this->conn->prepare($sql);
       
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
        
        // $ArrayObj =  $this->timeMapper->mapFromDatabaseArrayToObjectArray($result);
        
        return $result[0];
    
    }


}