<?php

namespace App\Controller;

use App\Mapper\ClubeMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Dao\EsporteDao;
use App\Mapper\EsporteMapper;
use App\Model\Esporte;

use \PDOException;


class EsporteController {

    private $esporteDAO;
    private $esporteMapper;

    public function __construct() {
        $this->esporteDAO = new EsporteDAO();
        $this->esporteMapper = new ClubeMapper();       
    }

    public function listar(Request $request, Response $response, array $args): Response {
     $clubes = $this->esporteDAO->list();
     $json = json_encode($clubes,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
     $response->getBody()->write($json);
        return $response
            ->withStatus(202)
            ->withHeader("Content-Type", "application/json");
    
    }
}
?>