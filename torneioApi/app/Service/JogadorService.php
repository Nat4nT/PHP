<?php
namespace App\Service;

use App\Dao\JogadorDAO;
use App\Model\Jogador;

class JogadorService {

    private JogadorDAO $jogadorDAO;

    public function __construct() {
        $this->jogadorDAO = new JogadorDAO();        
    }

    public function validarDados(Jogador $jogador) {
        $erros = array();

        if(! $jogador->getNome())
            array_push($erros, "O nome é um campo obrigatório!");
        else {
            $jogadorRepetido = $this->jogadorDAO->findByNome($jogador->getNome());
            if($jogadorRepetido && $jogadorRepetido->getId() != $jogador->getId())
                array_push($erros, "Um jogador com este nome já foi cadastrado!");
        }

        if(! $jogador->getNacionalidade())
            array_push($erros, "A nacionalidade é um campo obrigatório!");

        if(! $jogador->getGenero())
            array_push($erros, "O gênero é um campo obrigatório!");

        if(! $jogador->getTime())
            array_push($erros, "Informe o time do jogador!");

        if(! $jogador->getEsporte())
            array_push($erros, "Informe o esporte que o jogador pratica!");

        return $erros;
    }

}
?>