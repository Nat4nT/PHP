<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use App\Controller\EsporteController;
use App\Controller\TimeController;
use App\Controller\JogadorController;
use App\Controller\ClubeController;


require_once(__DIR__ . '/vendor/autoload.php');

//--------Habilita o framework Slim--------
$app = AppFactory::create();
$app->setBasePath("/torneioApi"); //Adicionar o nome da pasta do projeto


//--------Opções do framework Slim--------
$app->addBodyParsingMiddleware(); //Disponibliza o conteúdo recebido no corpo da requisição no objeto Request
$app->addErrorMiddleware(true, true, true); //Retorna um erro do Framework caso não tratado


//--------Rotas disponiblizadas pela API--------

//Rotas de teste
$app->get('/ola', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Olá Mundo");
    return $response;
});

$app->get('/olaNome/{nome}', function (Request $request, Response $response, $args) {
    $nome = $args['nome'];
    $response->getBody()->write("Olá, Seja bem Vindx ".$nome);

    return $response;
});

//Chamar /olaNome2?nome=Daniel
$app->get('/olaNome', function (Request $request, Response $response, $args) {

    $params=$request->getQueryParams();
    $nome="Sem nome";
    if (isset($params['nome'])) {
        $nome = $params['nome'];
    }
    $response->getBody()->write("Seja bem-vindx ". $nome);
    return $response;
});

//Rotas de clubes
//TODO adicionar as rotas
$app->get('/jogador', JogadorController::class . ":listar");
$app->get('/jogador/{id}', JogadorController::class . ":buscarPorId");
$app->delete('/jogador/{id}', JogadorController::class . ":excluirPorId");
$app->post('/jogador', JogadorController::class  . ":inserir");
$app->post('/jogador/{id}', JogadorController::class  . ":alterar");

//--------Executa o framework slim--------
$app->run();