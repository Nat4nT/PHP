<?php 

namespace App\Util;

class MensagemErro {

    public static function getJSONErro($msg, $detalhes = "", $httpStatus = 500) {
        $erro['mensagem'] = $msg;
        $erro['detalhes'] = $detalhes;
        $erro['status'] = $httpStatus;
        return json_encode($erro);
    }

}