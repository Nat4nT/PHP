<?php

namespace App\Mapper;

use App\Model\Esporte;

class EsporteMapper {

    public function mapFromDatabaseArrayToObjectArray($regArray) {
        $arrayObj = array();

        foreach($regArray as $reg) {
            $regObj = $this->mapFromDatabaseToObject($reg);
            array_push($arrayObj, $regObj); 
        }

        return $arrayObj;
    }

    public function mapFromDatabaseToObject($regDatabase) {
        $obj = new Esporte();
        if(isset($regDatabase['id'])) 
            $obj->setId($regDatabase['id']);
        
        if(isset($regDatabase['nome']))
            $obj->setNome($regDatabase['nome']);

        if(isset($regDatabase['descricao']))
            $obj->setDescricao($regDatabase['descricao']);
        
        if(isset($regDatabase['tipo']))
            $obj->setTipo($regDatabase['tipo']);
        
        return $obj;
    }

    public function mapFromJsonToObject($regJson) {
        //Reaproveita o método
        return $this->mapFromDatabaseToObject($regJson);
    }

}