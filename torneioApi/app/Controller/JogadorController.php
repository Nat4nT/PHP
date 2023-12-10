<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Util\MensagemErro;
use App\Dao\JogadorDAO;
use App\Mapper\JogadorMapper;
use App\Service\JogadorService;
use \PDOException;
class JogadorController {
    private JogadorDAO $jogadorDAO;
    private JogadorMapper $jogadorMapper;
    private JogadorService $jogadorService;

    public function __construct() {
        $this->jogadorDAO = new JogadorDAO();
        $this->jogadorMapper = new JogadorMapper();
        $this->jogadorService = new JogadorService();
    }

    public function listar(Request $request, Response $response, array $args): Response {
        $jogador = $this->jogadorDAO->list();
		$json = json_encode($jogador,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
		$response->getBody()->write($json);
		return $response
				->withStatus(202)
				->withHeader("Content-Type", "application/json");
        
    }

    public function inserir(Request $request , Response $response, array $array): Response {
        $jsonArrayAssoc = $request->getParsedBody();
        $jogador = $this->jogadorMapper->mapFromJsonToObject($jsonArrayAssoc);

        $jogador = $this->jogadorDAO->insert($jogador);

        $json = json_encode($jogador,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($json);
        return $response->withStatus(201)->withHeader("Content-Type","aplication/json");

    }

    public function buscarPorId(Request $request,Response $response, array $args) : Response {
        $idJogador = $args['id'];
        $jogador = $this->jogadorDAO->findById($idJogador);
        if($jogador){
            $json = json_encode($jogador,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
            $response->getBody()->write($json);
            return $response->withStatus(200)->withHeader("Content-Type","aplication/json");
        }
        return $response->withStatus(400);
    }

    public function alterar(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $idJogador=$this->jogadorDAO->findById($id);
        if ($idJogador) {
            $jogadorArrayAssoc = $request->getParsedBody();
            $jogador = $this->jogadorMapper->mapFromJsonToObject($jogadorArrayAssoc);
            $jogador->setId($id);
                try {
                    $jogador = $this->jogadorDAO->update($jogador);
                    $response->getBody()->write(json_encode($jogador,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
                    return $response->withStatus(200)->withHeader("Content-Type","application/json");
                } catch(PDOException $ex) {
                    $jsonErro = MensagemErro::getJSONErro("Erro ao atualizar o clube!", $ex->getMessage());
                    $response->getBody()->write($jsonErro);
                    return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(500);
                }
            }
            return $response->withStatus(404);
    }

    public function excluirPorId(Request $request, Response $response, array $args): Response {
		$id = $args['id'];
		$jogador = $this->jogadorDAO->findById($id);
		
		if($jogador) { 
			try {
				$this->jogadorDAO->deleteById($id);
				return $response->withStatus(200); 
			} catch(PDOException $ex) {
				
				$jsonErro = MensagemErro::getJSONErro("Erro ao deletar o clube!", $ex->getMessage());
				$response->getBody()->write($jsonErro);
				return $response
						->withHeader('Content-Type', 'application/json')
						->withStatus(500); 
			}
		}

		return $response->withStatus(404); 
    }
  
}
?>