<?php

namespace App\Dao;

use App\Util\Connection;
use App\Mapper\EsporteMapper;
use App\Model\Esporte;

use \Exception;

class EsporteDAO {

    private $conn;
    private $esporteMapper;

    public function __construct(){
        $this->conn = Connection::getConnection();
        $this->esporteMapper = new EsporteMapper();
    }

    public function list() {

        $sql = "SELECT * FROM esporte ORDER BY nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
      
        return $this->esporteMapper->mapFromDatabaseArrayToObjectArray($result);
    }


    public function list_this(int $id) {
        //utilizado para o listar no jogador
        $sql = "SELECT * FROM esporte WHERE id  = ?";
        $stm = $this->conn->prepare($sql);
       
        $stm->execute([$id]);
        $result = $stm->fetchAll();
        
        
        
        return $result[0];
    
    }

    
}