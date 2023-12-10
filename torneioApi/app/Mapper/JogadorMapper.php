<?php

namespace App\Mapper;

use App\Dao\EsporteDAO;
use App\Model\Time;
use App\Model\Jogador;
use App\Model\Esporte;
use App\Dao\TimeDAO;


class JogadorMapper {
    

    public function mapFromDatabaseArrayToObjectArray($regArray) {
        $arrayObj = array();

        foreach($regArray as $reg) {
            $regObj = $this->mapFromDatabaseToObject($reg);
            array_push($arrayObj, $regObj); 
        }

        return $arrayObj;
    }

    public function mapFromDatabaseToObject($regDatabase) {
        $obj = new Jogador();
        if(isset($regDatabase['id'])) 
            $obj->setId($regDatabase['id']);
        
        if(isset($regDatabase['nome']))
            $obj->setNome($regDatabase['nome']);

        if(isset($regDatabase['genero']))
            $obj->setGenero($regDatabase['genero']);
        
        if(isset($regDatabase['data_nascimento']))
            $obj->setData_nascimento($regDatabase['data_nascimento']);

        if(isset($regDatabase['nacionalidade']))
            $obj->setNacionalidade($regDatabase['nacionalidade']);


        if(isset($regDatabase['posicao']))
            $obj->setPosicao($regDatabase['posicao']);


            //mesma explicação do Esporte
        if(isset($regDatabase['time_id'])){
            $timeDAO = new TimeDAO;
            $timeInfo = $timeDAO->list_this(settype($regDatabase['time_id'],"integer"));
            $time = new Time();
            $time->setId($regDatabase['time_id']);
            $time->setNome($timeInfo['nome']);
            $time->setOrigem($timeInfo['origem']);

            $obj->setTime($time);
        }
        
           
        //Aqui ta a gambiarra, o esporte dao procura pelo id que ta vindo por parametro, acha e retorna o resultado e eu seto o nome dele através da pesquisa.
        // nao conseugi fazer para aparecer somente o id
        if(isset($regDatabase['esporte_id']))
            $esporteDAO = new EsporteDAO();
            $esporteInfo = $esporteDAO->list_this(settype($regDatabase['esporte_id'],"integer"));
            $esporte = new Esporte();
            $esporte->setId($regDatabase['esporte_id']);
            $esporte->setNome($esporteInfo['nome']);
            $esporte->setTipo($esporteInfo['tipo']);
            $esporte->setDescricao($esporteInfo['descricao']);
            $obj->setEsporte($esporte);
           
        
        return $obj;
    }

    public function mapFromJsonToObject($regJson) {
        //Reaproveita o método
        return $this->mapFromDatabaseToObject($regJson);
    }

}