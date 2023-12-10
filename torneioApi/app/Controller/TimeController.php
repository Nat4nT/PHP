<?php
namespace App\Controller;


use App\Model\Time;
use App\Dao\TimeDao;
use App\Mapper\TimeMapper;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class TimeController {

    private $timeDAO;
    private $timeMapper;


    public function __construct() {
        $this->timeDAO = new TimeDAO();
        $this->timeMapper = new TimeMapper(); 
    }

    public function listar(Request $request, Response $response, array $args): Response {
        $times = $this->timeDAO->list();
        $json = json_encode($times,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($json);

        return $response
        ->withStatus(202)
        ->withHeader("Content-Type", "application/json");
    }
}
?>