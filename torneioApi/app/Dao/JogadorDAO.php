<?php
namespace App\Dao;
use App\Util\Connection;
use App\Mapper\JogadorMapper;
use App\Model\Jogador;

use \Exception;
class JogadorDAO {

    private $conn;
    private $jogadorMapper;

    public function __construct(){
        $this->conn = Connection::getConnection();
        $this->jogadorMapper = new JogadorMapper();
    }
    
    
    public function list() {
        $sql = "SELECT j.*, t.nome AS time_nome, e.nome AS esporte_nome" . 
               " FROM jogador j" . 
               " JOIN time t ON (t.id = j.time_id)" .
               " JOIN esporte e ON (e.id = j.esporte_id)" . 
               " ORDER BY j.id ASC";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->jogadorMapper->mapFromDatabaseArrayToObjectArray($result);
    }

    public function insert(Jogador $jogador) {

        $sql = "INSERT INTO jogador (nome, genero, data_nascimento, nacionalidade, posicao, time_id, esporte_id)" .
                " VALUES (?, ?, ?, ?, ?, ?, ?)" ;
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            $jogador->getNome(),
            $jogador->getGenero(),
            $jogador->getData_nascimento(),
            $jogador->getNacionalidade(),
            $jogador->getPosicao(),
            $jogador->getTime()->getId(),
            $jogador->getEsporte()->getId()
        ));
        $id = $this->conn->lastInsertId();
        $jogador->setId($id);
        return $jogador;
    }

    public function findByNome(string $nomeJogador) {

        $sql = "SELECT j.*, t.nome AS time_nome, e.nome AS esporte_nome" . 
               " FROM jogador j" . 
               " JOIN time t ON (t.id = j.time_id)" .
               " JOIN esporte e ON (e.id = j.esporte_id)" . 
               " WHERE j.nome = ?" .
               " ORDER BY j.nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array($nomeJogador));
        $result = $stm->fetchAll();
        
        $jogadores = $this->jogadorMapper->mapFromDatabaseArrayToObjectArray($result);
        if($jogadores)
            return $jogadores[0];
        else
            return null;
    }


    public function findById(int $idJogador) {
        $conn = Connection::getConnection();

        $sql = "SELECT j.*, t.nome AS time_nome, e.nome AS esporte_nome" . 
               " FROM jogador j" . 
               " JOIN time t ON (t.id = j.time_id)" .
               " JOIN esporte e ON (e.id = j.esporte_id)" . 
               " WHERE j.id = :id" .
               " ORDER BY j.nome";
        $stm = $conn->prepare($sql);
        $stm->bindValue('id', $idJogador);
        $stm->execute();
        $result = $stm->fetchAll();

        $array = $this->jogadorMapper->mapFromDatabaseArrayToObjectArray($result);
        
        if(count($array) == 0 )
            return null;
        else if (count($array) > 1)
            return new Exception("Mais de um Registro encontado para o ID ". $idJogador);
        else
            return $array[0];
    }
    

    public function update(Jogador $jogador) {
       
        $sql = "UPDATE jogador SET nome = ?, genero = ?," . 
                    " data_nascimento = ?, nacionalidade = ?," .
                    " posicao = ?, time_id = ?, esporte_id = ?" . 
                " WHERE id = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            $jogador->getNome(),
            $jogador->getGenero(),
            $jogador->getData_nascimento(), 
            $jogador->getNacionalidade(), 
            $jogador->getPosicao(), 
            $jogador->getTime()->getId(),
            $jogador->getEsporte()->getId(), 
            $jogador->getId()
        ));

        return $jogador;
    }

    public function deleteById(int $idJogador) {

        $sql = "DELETE FROM jogador WHERE id = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array($idJogador));
    }

   
}
?>